<?php
/**
* Template Name: About Page
*/
?>
<?php get_header(); ?>


			<div id="content">


                    <div class="row hidden-xs hidden-s" style="margin-left:0%;margin-right:0px;">
                        <div class="col-md-12" style="padding:0px;margin-bottom:25px;">
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0]; ?>
                            <div class="header-image-small" style="background-image:url('<?php echo $image; ?>')">
                            </div>
                        </div>
                    </div>
					<div class="row about-main">

						<div class="col-md-4" style="margin-top:15px;padding-left:0;">

								<?php get_sidebar('about'); ?>

						</div>
						<div id="main" class="col-md-6 left-border" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article style="padding-left:10px;" id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h1 class="page-title-about" itemprop="headline"><?php the_title(); ?></h1>

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
						</div>

					</div>
                <div class="row about-main">

						<div class="col-md-12" style="margin-top:15px;padding-left:10px">
							<div id="staff-sidebar">
                                <hr>
                                <h2>STAFF</h2>
                                
                                <div class="staff-info">
                                    <img src="../../wp-content/themes/cah-gallery/img/slindsey.jpg" style="width: 240px; height: 187px; background-color: lightgrey;" alt="Shannon Lindsey">
                                    <h4>Shannon Lindsey</h4>
                                        Gallery Director<br/>
                                        <a href="mailto:Shannon.Lindsey@ucf.edu">Shannon.Lindsey@ucf.edu</a>
                                    </p>
                                </div>
                                <div class="staff-info">
                                    <img src="../../wp-content/themes/cah-gallery/img/lcooper.jpg" style="width: 240px; height: 187px; background-color: lightgrey;" alt="Larry Cooper">
                                    <h4>Larry Cooper</h4>
                                        Assistant Director<br/>
                                        <a href="mailto:Larry.Cooper@ucf.edu">Larry.Cooper@ucf.edu</a>
                                    </p>
                                </div>
                            </div>

						</div>
                </div>



			</div>

<?php get_footer(); ?>
