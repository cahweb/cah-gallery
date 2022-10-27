<?php

function gallery_load_theme_css() {
    wp_enqueue_style( 'gallery-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'gallery_load_theme_css', 10, 0 );

if ( function_exists('register_sidebar') ) {
    //About Sidebar
    register_sidebar(array(
    'name' => 'About Sidebar',
    'id' => 'about-sidebar',
    'description' => 'Appears as the sidebar on the custom about page',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
    //Support The Gallery
    register_sidebar(array(
    'name' => 'Support Sidebar',
    'id' => 'support-sidebar',
    'description' => 'Appears as the sidebar on the giving and volunteer pages',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
}

if( class_exists( 'kdMultipleFeaturedImages' ) ) {

        $args = array(
                'id' => 'artist-image',
                'post_type' => 'exhibit',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Artist Image',
                    'set'       => 'Set featured artist image',
                    'remove'    => 'Remove featured artist image',
                    'use'       => 'Use as featured artist image',
                )
        );

        new kdMultipleFeaturedImages( $args );
    
        $args = array(
                'id' => 'artist-image',
                'post_type' => 'event',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Artist Image',
                    'set'       => 'Set featured artist image',
                    'remove'    => 'Remove featured artist image',
                    'use'       => 'Use as featured artist image',
                )
        );

        new kdMultipleFeaturedImages( $args ); 
		
		
		$args = array(
                'id' => 'artist-image',
                'post_type' => 'communityevent',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Artist Image',
                    'set'       => 'Set featured artist image',
                    'remove'    => 'Remove featured artist image',
                    'use'       => 'Use as featured artist image',
                )
        );

        new kdMultipleFeaturedImages( $args );
    
    //Multiple Features for front page posts
    $args = array(
                'id' => 'featured-image-2',
                'post_type' => array('exhibit','event'),     // Set this to post or page
                'labels' => array(
                    'name'      => 'Featured Image Thumbnail',
                    'set'       => 'Set featured image as thumbnail',
                    'remove'    => 'Remove featured image as thumbnail',
                    'use'       => 'Use as featured image as thumbnail',
                )
        );

        new kdMultipleFeaturedImages( $args );
    $args = array(
                'id' => 'featured-image-3',
                'post_type' => 'exhibit',      // Set this to post or page
                'labels' => array(
                    'name'      => 'Featured Image Header',
                    'set'       => 'Set featured image for header',
                    'remove'    => 'Remove featured image for header',
                    'use'       => 'Use as featured image for header',
                )
        );

        new kdMultipleFeaturedImages( $args );
}

function pn_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image

	if ( false !== strpos( $attachment_url[0], $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

//Custom Post-Type : Exhibits
add_action('init', 'exhibit_create');
 
function exhibit_create() {
    $args = array(
        'label' => 'Exhibits',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'exhibit'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'revisions',
            'thumbnail'),
        'taxonomies' => array('category')
        );

 
    register_post_type( 'exhibit' , $args );
    $args = array(
      'label' => 'Events',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'event'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'revisions',
            'thumbnail',
            'tags'),
        'taxonomies'   => array( 'event',  'post_tag' )
        );

 
    register_post_type( 'event' , $args );
    register_taxonomy_for_object_type('tags', 'event');
	
	
	$args = array(
      'label' => 'External Events',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'communityevent'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'revisions',
            'thumbnail',
            'tags')
        );

 
    register_post_type( 'communityevent' , $args );
    flush_rewrite_rules();
}

add_action("admin_init", "admin_init");
add_action('save_post', 'save_exhibit');

function admin_init(){
    add_meta_box("exhibitInfo-meta", "Exhibit Options", "exhibit_meta_options", "exhibit", "normal", "low");
    add_meta_box("eventInfo-meta", "Event Options", "event_meta_options", "event", "normal", "low");
    add_meta_box("subtitleInfo-meta", "Subtitle", "subtitle_meta_options", "event", "normal", "high");
    add_meta_box("subtitleInfo-meta", "Subtitle", "subtitle_meta_options", "exhibit", "normal", "high");
	add_meta_box("community-eventInfo-meta", "Event Options", "event_meta_options", "communityevent", "normal", "low");
    add_meta_box("community-subtitleInfo-meta", "Subtitle", "subtitle_meta_options", "communityevent", "normal", "high");
}


function exhibit_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $location = $custom["location"][0];
    $loclink =  $custom["loclink"][0];
    $sdate =    $custom["sdate"][0];
    $edate =    $custom["edate"][0];
    $virtual =  $custom["virtual"][0];
    $fcaption = $custom["fcaption"][0];
    $fartist =  $custom["fartist"][0];
    $fyear =    $custom["fyear"][0];
    $fmedium =  $custom["fmedium"][0];
    $aname =    $custom["aname"][0];
    $adesc =    $custom["adesc"][0];
    $awebsite = $custom["awebsite"][0];
    
    if($location == "") $location = "UCF Art Gallery";
    if($loclink == "") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";
    if($loclink == "http://devgallery.cah.ucf.edu/gallery-info/") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";

?>
<p>Please fill out as many of these fields as possible in order to make the pages look their best. Ommitted fields will be left blank on the pages.</p>
<h3 class="hndle ui-sortable-handle"><span>General</span></h3>
<br/>
<table>
    <tr>
        <td style="text-align:center"><label>Location: </label></td>
        <td><input type="text" name="location" value="<?php echo $location; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Link to Location: </label></td>
        <td><input type="text" name="loclink" value="<?php echo $loclink; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Start Date: </label></td>
        <td><input type="date" name="sdate" value="<?php echo $sdate; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>End Date: </label></td>
        <td><input type="date" name="edate" value="<?php echo $edate; ?>"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Virtual: </label></td>
        <td><input name="virtual" value="yes" type="radio" <?php echo (($virtual=="yes") ? "checked" : "");?>>Yes <input name="virtual" value="no" type="radio" <?php echo (($virtual=="yes") ? "" : "checked");?>> No</td>
    </tr>
</table><br/>

<div style="display:none">
<h3 class="hndle ui-sortable-handle"><span>Banner Image</span></h3>
<p>Make sure to set The Featured image to a large Image. It will be used as the main image for the front page when this exhibit is the newest, and it will be the banner of the exhibit's page.</p>
<table>
    <tr>
        <td style="text-align:center"><label>Caption: </label></td>
        <td><input name="fcaption" value="<?php echo $fcaption; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Artist: </label></td>
        <td><input name="fartist" value="<?php echo $fartist; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Year: </label></td>
        <td><input name="fyear" value="<?php echo $fyear; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Medium: </label></td>
        <td><input name="fmedium" value="<?php echo $fmedium; ?>" type="text" size="50"/></td>
    </tr>
</table>
    <br/> </div>
<h3 class="hndle ui-sortable-handle"><span>Artist</span></h3>
<p>Make sure to set The Artist image on the right. It will be displayed on the left column of the exhibit page.</p>
<table>
    <tr>
        <td style="text-align:center"><label>Name(s): </label></td>
        <td><input name="aname" value="<?php echo $aname; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center" valign="top"><label>Description: </label></td>
        <td><textarea name="adesc" cols="50" rows="4"><?php echo $adesc; ?></textarea></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Website: </label></td>
        <td><input name="awebsite" value="<?php echo $awebsite; ?>" type="text" size="50"/></td>
    </tr>

</table>
<?php
}


function save_exhibit(){
    global $post;
    update_post_meta($post->ID, "location", $_POST["location"]);
    update_post_meta($post->ID, "loclink", $_POST["loclink"]);
    update_post_meta($post->ID, "sdate", $_POST["sdate"]);
    update_post_meta($post->ID, "edate", $_POST["edate"]);
    update_post_meta($post->ID, "virtual", $_POST["virtual"]);
    update_post_meta($post->ID, "fcaption", $_POST["fcaption"]);
    update_post_meta($post->ID, "fartist", $_POST["fartist"]);
    update_post_meta($post->ID, "fyear", $_POST["fyear"]);
    update_post_meta($post->ID, "fmedium", $_POST["fmedium"]);
    update_post_meta($post->ID, "aname", $_POST["aname"]);
    update_post_meta($post->ID, "adesc", $_POST["adesc"]);
    update_post_meta($post->ID, "awebsite", $_POST["awebsite"]);
    update_post_meta($post->ID, "subtitle", $_POST["subtitle"]);
	update_post_meta($post->ID, "stime", $_POST["stime"]);
	update_post_meta($post->ID, "etime", $_POST["etime"]);
}

function event_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $location = $custom["location"][0];
    $loclink =  $custom["loclink"][0];
    $sdate =    $custom["sdate"][0];
    $edate =    $custom["edate"][0];
    $fcaption = $custom["fcaption"][0];
    $fartist =  $custom["fartist"][0];
    $fmedium =  $custom["fmedium"][0];
    $aname =    $custom["aname"][0];
    $adesc =    $custom["adesc"][0];
    $awebsite = $custom["awebsite"][0];
    $etime = 	$custom["etime"][0];
    $stime = 	$custom["stime"][0];

    if($location == "") $location = "UCF Art Gallery";
    if($loclink == "") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";
    if($loclink == "http://devgallery.cah.ucf.edu/gallery-info/") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";

?>
<p>Please fill out as many of these fields as possible in order to make the pages look their best. Ommitted fields will be left blank on the pages.</p>
<h3 class="hndle ui-sortable-handle"><span>General</span></h3>
<br/>
<table>
    <tr>
        <td style="text-align:center"><label>Location: </label></td>
        <td><input type="text" name="location" value="<?php echo $location; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Link to Location: </label></td>
        <td><input type="text" name="loclink" value="<?php echo $loclink; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Start Date: </label></td>
        <td><input type="date" name="sdate" value="<?php echo $sdate; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>End Date: </label></td>
        <td><input type="date" name="edate" value="<?php echo $edate; ?>" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Start Time: </label></td>
        <td><input type="time" name="stime" value="<?php echo $stime; ?>"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>End Time: </label></td>
        <td><input type="time" name="etime" value="<?php echo $etime; ?>"/></td>
    </tr>
</table><br/>

<h3 class="hndle ui-sortable-handle"><span>Banner Image</span></h3>
<p>Make sure to set The Featured image to a large Image. It will be used as the main image for the front page when this exhibit is the newest, and it will be the banner of the exhibit's page.</p>
<table>
    <tr>
        <td style="text-align:center"><label>Caption: </label></td>
        <td><input name="fcaption" value="<?php echo $fcaption; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Artist: </label></td>
        <td><input name="fartist" value="<?php echo $fartist; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Medium: </label></td>
        <td><input name="fmedium" value="<?php echo $fmedium; ?>" type="text" size="50"/></td>
    </tr>
</table>
<br/> 
<h3 class="hndle ui-sortable-handle"><span>Artist</span></h3>
<p>Make sure to set The Artist image on the right. It will be displayed on the left column of the exhibit page.</p>
<table>
    <tr>
        <td style="text-align:center"><label>Name(s): </label></td>
        <td><input name="aname" value="<?php echo $aname; ?>" type="text" size="50"/></td>
    </tr>
    <tr>
        <td style="text-align:center" valign="top"><label>Description: </label></td>
        <td><textarea name="adesc" cols="50" rows="4"><?php echo $adesc; ?></textarea></td>
    </tr>
    <tr>
        <td style="text-align:center"><label>Website: </label></td>
        <td><input name="awebsite" value="<?php echo $awebsite; ?>" type="text" size="50"/></td>
    </tr>

</table>
<?php
}

function save_event(){
    global $post;
    update_post_meta($post->ID, "location", $_POST["location"]);
    update_post_meta($post->ID, "loclink", $_POST["loclink"]);
    update_post_meta($post->ID, "sdate", $_POST["sdate"]);
    update_post_meta($post->ID, "edate", $_POST["edate"]);
    update_post_meta($post->ID, "fcaption", $_POST["fcaption"]);
    update_post_meta($post->ID, "fartist", $_POST["fartist"]);
    update_post_meta($post->ID, "fmedium", $_POST["fmedium"]);
    update_post_meta($post->ID, "aname", $_POST["aname"]);
    update_post_meta($post->ID, "adesc", $_POST["adesc"]);
    update_post_meta($post->ID, "awebsite", $_POST["awebsite"]);
    update_post_meta($post->ID, "subtitle", $_POST["subtitle"]);
}


function subtitle_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $subtitle =     $custom["subtitle"][0];
?>
<textarea name="subtitle" cols="75" rows="1"><?php echo $subtitle; ?></textarea>

<?php
}

// This is a comment. You use them when you want future developers to understand your code.
// Lets you get image metadata to use in templates (caption, alt, title, etc)
function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}


// Load AdRoll script
add_action(
    'wp_enqueue_scripts',
    function() {
        wp_enqueue_script(
            'adroll-script',                                        // script handle
            get_stylesheet_directory_uri() . "/adroll.js",          // script URI
            [],                                                     // dependencies
            filemtime( get_stylesheet_directory() . "/adroll.js" ), // version # (using UNIX timestamp of last modification to avoid caching issues)
            true                                                // whether to load in <body>
        );
        
        wp_enqueue_script(
            'adroll-script-2',
            get_stylesheet_directory_uri() . "/adroll-2.js",
            [],
            filemtime( get_stylesheet_directory() . "/adroll-2.js" ),
            true
        );
    },
    15,  // priority
    0   // # of expected arguments for indicated Callable
);

function cah_gallery_load_utility_scripts() {
    $uri = get_stylesheet_directory_uri() . "/js";
    $path = get_stylesheet_directory() . "/js";
    
    // Load Bootstrap JS (previously in footer.php)
    wp_enqueue_script(
        'bootstrap-tbone',
        get_template_directory_uri() . "/library/js/libs/bootstrap.js",
        [],
        get_template_directory() . "/library/js/libs/bootstrap.js",
        true
    );
    
    // Load banner scroll script conditionally (previously in footer.php)
    $hideSocial = ["/", "/front-page/"];
    if (in_array($_SERVER['REQUEST_URI'], $hideSocial)) {
        wp_enqueue_script(
            'banner-scroll',
            "$uri/banner-scroll.js",
            ['jquery'],
            "$path/banner-scroll.js",
            true
        );
    }
    
    // Load Google Analytics (previously in footer.php)
    wp_enqueue_script(
        'google-analytics',
        "$uri/google-analytics.js",
        [],
        "$path/google-analytics.js",
        true
    );

    // Load custom JS on communityevents page template
    if (is_page_template('page-communityevents.php')
        || is_page_template('page-news.php')
        || is_page_template('page-news2.php')
    ) {
        wp_enqueue_script(
            'community-events',
            "$uri/community-events.js",
            ['jquery'],
            "$path/community-events.js",
            true
        );
    } elseif (is_page_template('page-events.php')) {
        wp_enqueue_script(
            'event-hide',
            "$uri/event-hide.js",
            ['jquery'],
            "$path/event-hide.js",
            true
        );
    } elseif (is_page_template('page-exhibitions.php')) {
        wp_enqueue_script(
            'exhibit-hide',
            "$uri/exhibit-hide.js",
            ['jquery'],
            "$path/exhibit-hide.js",
            true
        );
    } elseif (is_page_template('page-frontcarousel.php')) {
        wp_enqueue_script(
            'front-carousel',
            "$uri/front-carousel.js",
            ['jquery'],
            "$path/front-carousel.js",
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'cah_gallery_load_utility_scripts', 10, 0);
