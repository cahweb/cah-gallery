<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="content">
					<div class="row">
                        <div class="col-md-12 repeating-banner">
                        </div>
                        <div class="col-md-1"></div>
						<div id="main" class="col-md-8 " role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<div class="page-title" itemprop="headline"><?php the_title(); ?></div>
				                    <h3 class="page-date" itemprop="headline"><?php echo get_the_date(); ?></h3>
                                    
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
							</section>

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

								</footer>

							</article>
						</div>
						<div class="col-md-3 hidden-xs hidden-sm">
								<?php get_sidebar('sidebar1'); ?>
						</div>
					</div>
			</div>
<?php endwhile; endif;?>


<?php get_footer(); ?>
