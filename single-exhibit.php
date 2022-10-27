<?php get_header(); ?>

<?php 
if (have_posts()) : while (have_posts()) : the_post(); ?>


<?php 
    $custom = get_post_custom(get_the_ID());
    $sdate =    date("F j, Y",strtotime($custom["sdate"][0]));
    $edate =    date("F j, Y",strtotime($custom["edate"][0]));
    $subtitle = $custom["subtitle"][0];
    $location = $custom["location"][0];
    $loclink =  $custom["loclink"][0];
    $virtual =  $custom["virtual"][0];

    // Pull the image meta data caption and set it to a variable to use later
    $image_meta = wp_get_attachment(get_post_thumbnail_id());
    $fcaption = str_replace("\n", "<br>", $image_meta['caption']);

    //$fartist =  $custom["fartist"][0];
    //$fyear =    $custom["fyear"][0];
    $fmedium =  $custom["fmedium"][0];
    $aname =    $custom["aname"][0];
    $adesc =    $custom["adesc"][0];
    $awebsite = $custom["awebsite"][0];

    $title = get_the_title();

    if($location == "") $location = "UCF Art Gallery";
    if($loclink == "") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";
    if($loclink == "http://devgallery.cah.ucf.edu/gallery-info/") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";

$image = kd_mfi_get_featured_image_url('featured-image-3', 'exhibit', 'full', get_post_thumbnail_id($post->ID));
if($image=="")
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0];

    $ftitle = get_post(pn_get_attachment_id_from_url($image))->the_title;
    $artistImg = kd_mfi_get_featured_image_url( 'artist-image', 'exhibit' );

$date = $sdate . " - " . $edate;
if($edate == $sdate) $date = $sdate;
?>
			<div id="content">
					<div class="row">  
                                                <?php if($image != "") { ?>
                            <div class="col-md-12 exhibit-banner" style="background-image: url('<?php echo $image; ?>'); background-position: center; background-size: cover;">
                                <?php /* if($fcaption != "" || $fartist != "" || $fyear != "" || $fmedium != "") { ?><div class="caption-card-event"><p><?php echo $fcaption; ?></p><p><?php echo $fartist; if($fartist != "" && $fyear != "") {?>, <?php } echo $fyear; ?></p><p><?php echo $fmedium; ?></div><?php }*/ ?>
                                <?php // Dear God ?>

                                <?php if($ftitle != "" || $fcaption != "") { ?>

                                    <div class="caption-card-event">

                                    <?php if( $ftitle != "") { ?>
                                        <p><?php echo $ftitle; ?></p>
                                    <?php } 

                                    if ($fcaption != "") { ?>
                                        <p><?php echo $fcaption; ?></p>
                                    <?php } ?>

                                    </div> <!-- end caption-card-event -->
                                <?php } // endif ?>

                            </div>
                        <?php } else { ?>
                            <div class="col-md-12 repeating-banner" style="margin-bottom:20px">
                            </div>
                        <?php } ?>
                        <?php

                            global $post;

                            if( '2019-faculty-exhibition' === $post->post_name ) {
                                    ?>
                                <!-- Hurricane Dorian Announcement 
		                        <div class="container bg-danger" style="padding: 40px 40px; margin: 0; width: 100%; background-color: tomato;">
			                    <p class="text-dark pr-2 pl-2" style="text-align: center; font-weight: bold; width: 75%; margin: auto;">&nbsp;<br>In anticipation of Hurricane Dorian’s expected impact on Central Florida, UCF is now closed. Due to the current path and timeline and the likelihood of severe weather into Wednesday, UCF will remain closed on Thursday, Sept. 5.</p><br /><p style="width: 8%; margin: auto;"><a class="btn btn-dark" href="https://www.ucf.edu/alert/" style="background-color: black; color: white; margin: auto;">More Info</a></p>
		                        </div>-->
                                <?php
                            }
                        ?>
                        <div class="col-md-2 hidden-xs hidden-sm"></div>
                        <div class="col-md-2 artist-sidebar hidden-xs hidden-sm">
                            <?php if($artistImg != "") { ?>
                            <img src="<?php echo $artistImg; ?>" style="width: 100%; height: auto; object-position: center; object-fit: contain;">
                            <?php } if($aname != "") { ?>
                            <h3 class="artist-name"><?php echo strtoupper($aname); ?></h3>
                            <?php } if($adesc != "") { ?>
                            <p class="artist-bio"><?php echo $adesc; ?></p>
                            <?php } if($awebsite != "") { ?>
                            <h4 class="artist-website text">WEBSITE:</h4><a class="artist-website link" href="<?php echo $awebsite; ?>"><?php echo $awebsite ?></a></p>
                            <?php } ?>
						</div>
						<div id="exhibit" class="col-md-6 " role="main">
                            <div class="virtual-exhibit <?php echo (($virtual=="yes") ? "" : "hidden");?>">VIRTUAL EXHIBIT</div>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php echo $title; ?></h1>
                                    <h3 class="page-subtitle" itemprop="headline"><?php echo $subtitle; ?></h3>
                                    <h3 class="page-date" itemprop="headline"><?php echo $date; ?></h3>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
                                    <?php if($virtual!="yes"){ ?> <p><b>Location: </b> <a href= "<?php echo $loclink; ?>"> <?php echo $location ?> </a> </p> <?php } ?>
									<?php the_content(); ?>
							     </section>

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

								</footer>

							</article>
						</div>
                <div class="col-md-2 artist-sidebar visible-xs">
                            <?php if($aname != "") { ?>
                            <h3 class="artist-name"><?php echo strtoupper($aname); ?></h3>
                            <?php } if($adesc != "") { ?>
                            <p class="artist-bio"><?php echo $adesc; ?></p>
                            <?php } if($awebsite != "") { ?>
                            <h4 class="artist-website text">WEBSITE:</h4><a class="artist-website link" href="http://<?php echo $awebsite; ?>"><?php echo $awebsite ?></a></p>
                            <?php } ?>
						</div>
                        <div class="col-md-2"></div>

					</div>
			</div>
<?php endwhile; endif;?>


<?php get_footer(); ?>
