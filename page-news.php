<?php
/**
* Template Name: News Page
*
* Description: A page template that provides a key component of WordPress as a CMS
* by meeting the need for a carefully crafted introductory page. The front page template
* in Twenty Twelve consists of a page content area for adding text, images, video --
* anything you'd like -- followed by front-page-only widgets in one or two columns.
*
*/
?>

<?php get_header(); ?>

			<div id="content">

					<div class="row">
						<div class="col-md-12 repeating-banner">
                        </div>
                        <div class="col-md-1"></div>
						<div id="main" class="col-md-8 " role="main">
                            
                        <?php
                               $posts = 7;
                               if(isset($_GET['posts'])) {
                                  if(is_numeric($_GET['posts'])) {
                                    $posts = stripslashes(htmlspecialchars($_GET['posts']));   
                                  }
                               }
                               $args = array(
                                   'post_type' => array('event','post'),
                                   'showposts' => $posts,
                                   'order' => 'desc'

                                );
                                
                                $numPosts = 0;
                               $category_posts = new WP_Query($args);

                               if($category_posts->have_posts()) : 
                                  while($category_posts->have_posts()) : 
                                    $numPosts++;
                                    $category_posts->the_post();
                                    $custom = get_post_custom(get_the_ID());
                                        $sdate =    date("M j, Y",strtotime($custom["sdate"][0]));
                                        $edate =    date("M j, Y",strtotime($custom["edate"][0]));
                                        $date = $sdate . " - " . $edate;
                                        if($edate == $sdate) $date = $sdate;
                                        if($sdate == "Jan 1, 1970" || $edate == "Jan 1, 1970") $date = get_the_date();

$image = kd_mfi_get_featured_image_url('featured-image-2', 'event', 'full', get_the_ID());

if($image == "") 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )["0"];

                            ?>
							<article id="post-<?php the_ID(); ?>" role="article" class="news-article-stub">
                                <?php if($image != "") { ?>
    
    <div style="background-image:url(<?php echo $image;?>); background-size:cover; background-position:center; width:150px; height:150px;  float:left; margin-right:15px;margin-bottom:0px;"></div>
                                 <!--- <img src="<?php //echo $image; ?>" style="float:left; margin-right:15px;margin-bottom:0px;" width="115" height="115"> ---> <?php } ?>
								<header class="article-header">

									<a class="page-title" itemprop="headline" href="<?php the_permalink()?>"><?php the_title(); ?></a>
				                    <h3 class="page-date" itemprop="headline"><?php echo $date; ?></h3>

                                </header>

								<section class="entry-content clearfix" itemprop="articleBody">
                                    <p><?php echo get_excerpt(500, 'content'); ?></p>
							    </section>
								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>
								</footer>
								<?php //comments_template(); ?>

							</article>

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
                            <?php  if($numPosts == $posts)  { ?> <a class="more-button" href="?posts=<?php echo $posts+5;?>">View 5 more posts...</a><?php } ?>
						</div>
						<div class="col-md-3 hidden-sm hidden-xs">
								<h4>Around Central Florida</h4>
								<a href="/community-events/" class="exhibit-prev-link extevent">&raquo; View more art events</a>
								<?php get_sidebar('sidebar1'); ?>
							
						</div>
					</div>


			</div>

<?php get_footer(); ?>
