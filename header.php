<!DOCTYPE html>
	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php

					$title = "UCF " . get_bloginfo('name');

					if (!is_front_page()) {
						global $post;
						$postId = $post->ID;

						$title = get_the_title($postId) . " | " . $title;
					}

					echo $title;

				?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php
			if(wp_get_attachment_image_src( get_post_thumbnail_id($post->ID))){
				echo "<!-- Social media thumbnail sharing images -->\n";
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));
				// $thumbnail = get_the_post_thumbnail_url();
				echo "\t<link rel=\"image_src\" href=\"".$thumbnail[0]."\"/>\n";
				echo "\t<meta property=\"og:image\" content=\"".$thumbnail[0]."\"/>";
			}
		?>

		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="https://www.ucf.edu/img/pegasus-icon.png" type="image/png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<script type="text/javascript" id="ucfhb-script" src="//universityheader.ucf.edu/bar/js/university-header.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>


	</head>

	<body>

		<?php $styleuri = get_stylesheet_directory_uri(); ?>
		<div class="banner" style="z-index:101">
			<div class="container header-container">
				<div class="row">
                    <div class="logo"><a href="https://gallery.cah.ucf.edu"><img src="<?php echo $styleuri?>/img/top.png"></a></div>
                    <div class="container container-nav" >
                    <nav class="navbar navbar-default" role="navigation">
                         <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>

                            <?php
                                wp_nav_menu( array(
                                    'link_after'        => '<div class="delimiter hidden-xs hidden-sm">|</div>',
                                    'menu'              => 'primary',
                                    'theme_location'    => 'primary',
                                    'depth'             => 2,
                                    'container'         => 'div',
                                    'container_class'   => 'collapse navbar-collapse',
                                    'container_id'      => 'bs-example-navbar-collapse-1',
                                    'menu_class'        => 'nav navbar-nav',
                                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                    'walker'            => new wp_bootstrap_navwalker())
                                           );
                            ?>
                    </nav>
                </div>
            	</div>
			</div>
		</div>

		<div class="container main-page">
		<!--
		<div style="padding: 1.25rem; font-size: 1em; line-height: 1.65; background-color: #dcf3f8; color: #000;text-align:center;"><p style="margin-bottom: 0;">We're closed for the holiday break. Join us for the Flying Horse Editions Exhibition opening Jan. 13 at 5 p.m.!</p></div>
		-->