<?php
/**
* Template Name: Interior Splash Page
*/
?>
<?php get_header(); ?>


			<div id="content">

	
                    <div class="row" style="margin-left:0%;margin-right:0px;">
                        <div class="col-md-12" style="padding:0px;margin-bottom:25px;">
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0];
?>
                            <div class="header-image-small hidden-xs" style="background-image:url('<?php echo $image; ?>')">
                            </div>
                        </div>
                    </div>
					<div class="row about-main">
					
						<div id="main" class="col-md-8 border-right" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article style="padding-left:10px;" id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
								
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
                                    
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
						</div><!--/#main-->
                        
						<div class="col-md-3" style="margin-top:15px;padding-right:0;">
								<?php get_sidebar('support'); ?>
						</div><!--/.col-md-3-->
						
					</div> <!--/.about-main-->                  

			</div>

<?php get_footer(); ?>
