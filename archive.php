<?php
/**
* Template Name: Recent Posts
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

				<div id="inner-content" >
					<div class="row">
						<div class="col-md-2 hidden-xs hidden-sm">
							<?php get_sidebar('sidebar1'); ?>
						</div>
						<div id="main" class="col-md-8" role="main">
							<h2> Recent Posts </h2>
							<?php get_sidebar('sidebar2'); ?>

						
						</div>

						<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
