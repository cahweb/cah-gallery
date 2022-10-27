<?php
/**
* Template Name: Front Page Carousel Template
*
* Description: A page template that provides a key component of WordPress as a CMS
* by meeting the need for a carefully crafted introductory page. The front page template
* in Twenty Twelve consists of a page content area for adding text, images, video --
* anything you'd like -- followed by front-page-only widgets in one or two columns.
*
*/
?>
<?php get_header(); ?>

<?php

//Flag to display social media buttons in footer.
$hideSocial = true;

$caption = "";
$artist = "";
$medium = "";

$featuredID = "";

$args = array(
    'post_type' => array('exhibit'),
    'showposts' => '1',
    'category_name' => 'featured'
);

$category_posts = new WP_Query($args);

if($category_posts->have_posts()) :
     $category_posts->the_post();

$featuredID = get_the_ID();

$custom = get_post_custom(get_the_ID());
$sdate =    date("M j, Y",strtotime($custom["sdate"][0]));
$edate =    date("M j, Y",strtotime($custom["edate"][0]));
$fcaption = $custom["fcaption"][0];
$fartist =  $custom["fartist"][0];
$fmedium =  $custom["fmedium"][0];
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
$image2 = kd_mfi_get_featured_image_url( 'featured-image-2', 'exhibit' );
$image3 = kd_mfi_get_featured_image_url( 'featured-image-3', 'exhibit' );

$post = get_post(pn_get_attachment_id_from_url($image));
$title1 = get_the_title();


// wp_get_attachment pulls image attachment metadata, in this case the caption
$image_meta = wp_get_attachment(get_post_thumbnail_id());
$caption1 = str_replace("\n", "<br>", $image_meta['caption']);

$post = get_post(pn_get_attachment_id_from_url($image2));
$title2 = get_the_title();
$caption2 = str_replace("\n", "<br>", get_the_excerpt());

$post = get_post(pn_get_attachment_id_from_url($image3));
$title3 = get_the_title();
$caption3 = str_replace("\n", "<br>", get_the_excerpt());

endif;

$category_posts = new WP_Query($args);

if($category_posts->have_posts()) :
     $category_posts->the_post();
?>
    <script>
        var ImageArray = [<?php echo '"'. $image[0] . '",'; if($image2!= "") echo '"'.$image2.'",'; if($image3!= "") echo '"'.$image3.'",'; ?>];
        var captionArray = [<?php echo '"'. $caption1 . '",'; if($image2!= "") echo '"'.$caption2.'",'; if($image3!= "") echo '"'.$caption3.'",'; ?>];
        var titleArray = [<?php echo '"'. $title1 . '",'; if($image2!= "") echo '"'.$title2.'",'; if($image3!= "") echo '"'.$title3.'",'; ?>];
        var curImg = 0;
    </script>
<?php

$date = $sdate . " - " . $edate;
if($edate == $sdate || $edate=='Jan 1, 1970') $date = $sdate;

$permalink = get_the_permalink();
$title = get_the_title();
$excerpt = get_the_excerpt(__('(<br/>read more…)'));
endif;

$firstEventDates = $date;

?>

<div class="header-image" style="background-image: url('<?php echo $image[0]; ?>') ">
    <div class="events-card hidden-xs">

        <a class="title" href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
        <p class="date"><?php echo $date ?></p>
        <p class="content"><?php echo $excerpt; ?></p>
        <hr style="border-color:#666; margin-top:7px; margin-bottom:7px"/>
        <?php

$counter = 0;
$maxEvents = 3;
$args = array(
    'post_type' => array('exhibit','event'),
    'showposts' => $maxEvents+1,
	'meta_key' => 'sdate',
	'meta_query' => array(
				'key' => 'sdate',
				'compare' => '>',
				'value' => date('Y-m-d'),
				'type' => 'DATE'
			),
	'orderby' => 'meta_value',
	'order' => 'ASC',

);

$category_posts = new WP_Query($args);

          while($category_posts->have_posts() && $counter < $maxEvents) :
             $category_posts->the_post();
            if($featuredID == get_the_ID()) continue;
            $counter++;
            $custom = get_post_custom(get_the_ID());
            $sdate =    date("n.j",strtotime($custom["sdate"][0]));
            $edate =    date("n.j",strtotime($custom["edate"][0]));
            $date = $sdate . " - " . $edate;
            if($edate == $sdate || $edate=='Jan 1, 1970') $date = $sdate;
        ?>

        <p class="date-small"><?php echo $date; ?></p>
        <a class="excerpt" href="<?php the_permalink();?>"><?php the_title();?></a> <br/>

        <?php
          endwhile;
                    ?>

    </div>
</div>

<div class="events-card visible-xs" style="position:relative; right:0px;bottom:0px; width:100%">

        <a class="title" href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
        <p class="date"><?php echo $firstEventDates ?></p>
        <p class="content"><?php echo $excerpt; ?></p>
        <hr style="border-color:#666;"/>
        <?php

$counter = 0;
$maxEvents = 3;
$args = array(
    'post_type' => array('exhibit','event'),
    'showposts' => $maxEvents+1,
	'meta_key' => 'sdate',
	'meta_query' => array(
				'key' => 'sdate',
				'compare' => '>',
				'value' => date('Y-m-d'),
				'type' => 'DATE'
			),
	'orderby' => 'meta_value',
	'order' => 'ASC',

);

$category_posts = new WP_Query($args);

          while($category_posts->have_posts() && $counter < $maxEvents) :
             $category_posts->the_post();
            if($featuredID == get_the_ID()) continue;
            $counter++;
            $custom = get_post_custom(get_the_ID());
            $sdate =    date("M j, Y",strtotime($custom["sdate"][0]));
            $edate =    date("M j, Y",strtotime($custom["edate"][0]));
            $date = $sdate . " - " . $edate;
            if($edate == $sdate || $edate=='Jan 1, 1970') $date = $sdate;
        ?>

        <p class="date-small"><?php echo $date; ?></p>
        <a class="excerpt" href="<?php the_permalink();?>"><?php the_title(); ?></a> <br/>

        <?php
          endwhile;
                    ?>

    </div>

<div class="row bottom-info hidden-xs hidden-sm">
	<div class="col-sm-2 border-right text-card">
        <h3><a href="gallery-info" style="color:#666;">VISIT</a></h3>
    </div>
    <div class="col-sm-3 border-right text-card">
        <p>
            Monday&ndash;Friday, 10 a.m. &ndash; 5 p.m.
            <br /><strong>Admission is Free</strong>&nbsp;<a href="gallery-info">&nbsp;&raquo; Plan Your Visit</a>
        </p>
    </div>
    <div class="col-sm-4 text-card" style="padding-top:20px">
        <a href="https://www.facebook.com/ucfgallery"><img src="<?php echo get_stylesheet_uri()?>/../img/fb-icon.png"></a>
        &nbsp;&nbsp;<a href="https://twitter.com/ucfgallery"><img src="<?php echo get_stylesheet_uri()?>/../img/twitter-icon.png"></a>
        &nbsp;&nbsp;<a href="https://www.instagram.com/artsatucf/"><img src="<?php echo get_stylesheet_uri()?>/../img/instagram-icon.png"></a>
        &nbsp;&nbsp;<a href="http://eepurl.com/de6CCD" target="_blank"><img src="<?php echo get_stylesheet_uri()?>/../img/email-icon.png"></a>
    </div>
    <div class="col-sm-3 caption-card">
        <p id="feature-title"><i><?php echo $title1;?></i></p>
        <p id="feature-caption"><?php echo $caption1;?></p>
    </div>
</div>
<div class="row bottom-info visible-xs visible-sm" style="border-top: 1px solid #ccc">
    <div class="text-card" style="width:100%;margin-left:0px;border-bottom: 1px solid #ccc">
        <div class="text-card border-right" style="width:50%;float:left;background-color:#aaaaaa;padding:20px;color:#fff">
        <p id="feature-title"><i><?php echo $title1;?></i></p>
        <p id="feature-caption"><?php echo $caption1;?></p>
    </div>
    <div class="text-card" style="width:50%;float:right;padding-top:20px;padding-left:20px">
        <a href="https://www.facebook.com/ucfgallery"><img src="<?php echo get_stylesheet_uri()?>/../img/fb-icon.png"></a>
        &nbsp;&nbsp;<a href="https://twitter.com/ucfgallery"><img src="<?php echo get_stylesheet_uri()?>/../img/twitter-icon.png"></a>
        &nbsp;&nbsp;<a href="https://www.instagram.com/artsatucf/"><img src="<?php echo get_stylesheet_uri()?>/../img/instagram-icon.png"></a>
        &nbsp;&nbsp;<a href="http://eepurl.com/de6CCD" target="_blank"><img src="<?php echo get_stylesheet_uri()?>/../img/email-icon.png"></a>
    </div>
    </div>
	<div class="text-card border-right" style="width:50%;float:left;">
        <h3><a href="gallery-info" style="color:#666;">VISIT</a></h3>
    </div>
    <div class="text-card" style="width:45%;float:right;">
        <p>
            Monday&ndash;Friday, 10 a.m. &ndash; 5 p.m.
            <br /><strong>Admission is Free</strong>
			<br /><a href="gallery-info">&nbsp;&raquo; Plan Your Visit</a>
        </p>
    </div>


</div>
</div>

<?php get_footer(); ?>
