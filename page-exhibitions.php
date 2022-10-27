<?php
/**
* Template Name: Exhibitions Page
*
* Description: A page template that provides a key component of WordPress as a CMS
* by meeting the need for a carefully crafted introductory page. The front page template
* in Twenty Twelve consists of a page content area for adding text, images, video --
* anything you'd like -- followed by front-page-only widgets in one or two columns.
*
*/
?>

<?php get_header(); 
//Place Holder Image for Exhibits that dont have a featured image OR artist Image.
$placeHolderImage = get_stylesheet_uri() . "/../img/placeholder.jpg";
?>
			<div id="content">

					<div class="row">
						<div class="col-md-12 repeating-banner">
                        </div>
                        <div class="col-md-1 hidden-xs hidden-sm"></div>
						<div id="main" class="col-md-8" role="main" style="z-index:100">

                        <?php
                               $args = array(
								'post_type' => array('exhibit'),
								'showposts' => '-1',
                                );

                                $years = array();

                               $category_posts = new WP_Query($args);
							   

                               if($category_posts->have_posts()) : 
                                  while($category_posts->have_posts()) : 
                                     $category_posts->the_post();
                                    $custom = get_post_custom(get_the_ID());
                                    $sdate = date("M j, Y",strtotime($custom["sdate"][0]));
                                    $edate = date("M j, Y",strtotime($custom["edate"][0]));
                                    if($sdate == "" || $edate == "") $date = get_the_date();

$image = kd_mfi_get_featured_image_url('featured-image-2', 'exhibit', 'full', get_post_thumbnail_id($post->ID));

									if($image == "") 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0];

echo $image;

                                    if($image == "") $image = $placeHolderImage;
                                    $year = date("Y",strtotime($custom["edate"][0]));
                                    array_push($years, $year);
                                    $date = $sdate . " - " . $edate;
                                    if($edate == $sdate) $date = $sdate;
                            ?>
                            <a href="<?php the_permalink(); ?>" id="<?php echo count($years); ?>" class="<?php echo $year; ?> exhibit-prev hidden" startdate="<?php echo $sdate; ?>" enddate="<?php echo $edate; ?>">
                                <div class="exhibit-stub" style="float:left;width:32%;text-align:center;min-width:225px;">
                                    <div id="image-preview" style="background-image:url(<?php echo $image;?>); background-size:cover; background-position:center; width:200px; height:200px;margin:0 auto;"></div>
                                    <h4><?php the_title(); ?></h4>
                                    <h5><?php echo $date; ?></h5>
                                </div>
                            </a>

                
							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
                        <div class="col-md-2">
                            <a href="#" id="select-0" onclick="filter(0)" class="exhibit-prev-link">Upcoming Exhibits</a><br/>
                            <?php $years = array_unique($years); 
                                foreach($years as $year) {
                                    echo '<a href="#" id="select-'.$year.'" onclick="filter('.$year.')" class="exhibit-prev-link">'.$year.'</a><br/>';   
                                }
                            ?>
                        </div>
                        <div class="col-md-1 hidden-xs hidden-sm"></div>
					</div>
			</div>

<?php get_footer(); ?>
