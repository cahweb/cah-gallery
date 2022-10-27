<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<?php 
    $custom = get_post_custom(get_the_ID());
    $sdate =    date("M j, Y",strtotime($custom["sdate"][0]));
    $edate =    date("M j, Y",strtotime($custom["edate"][0]));
    $subtitle =     $custom["subtitle"][0];
    $location = $custom["location"][0];
    $loclink =  $custom["loclink"][0];
    $aname =    $custom["aname"][0];
    $adesc =    $custom["adesc"][0];
    $awebsite = $custom["awebsite"][0];
	$stime = date("g:i a", strtotime($custom["stime"][0]));
	$etime = date("g:i a", strtotime($custom["etime"][0]));

    $artistImg = kd_mfi_get_featured_image_url( 'artist-image', 'communityevent' );


    if($location == "") $location = "UCF Art Gallery";
    if($loclink == "") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";
    if($loclink == "http://devgallery.cah.ucf.edu/gallery-info/") $loclink = "http://gallery.cah.ucf.edu/gallery-info/";

    $date = $sdate . " - " . $edate;
    if($edate == $sdate) {
		$date = $sdate;
		if($stime == "12:00 am" && $etime == "12:00 am"){}
		else $date .= "; {$stime} to {$etime}";
	}
?>
			<div id="content">
					<div class="row">
                        <div class="col-md-12 repeating-banner">
                        </div>
                        <div class="col-md-1 hidden-xs hidden-sm"></div>
                        <div class="col-md-2 artist-sidebar hidden-xs">
                            <?php if($artistImg != "") { ?>
                            <img src="<?php echo $artistImg; ?>" width="100%" height="auto">
                            <?php } if($aname != "") { ?>
                            <h3 class="artist-name"><?php echo strtoupper($aname); ?></h3>
                            <?php } if($adesc != "") { ?>
                            <p class="artist-bio"><?php echo $adesc; ?></p>
                            <?php } if($awebsite != "") { ?>
                            <h4 class="artist-website text">WEBSITE:</h4><a class="artist-website link" href="http://<?php echo $awebsite; ?>"><?php echo $awebsite ?></a></p>
                            <?php } ?>
						</div>
						<div id="main" class="col-md-6 " role="main">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
				                    <h3 itemprop="headline" style="margin-top:0px;padding-bottom:10px;"><?php echo $subtitle; ?></h3>
                                    <h3 class="page-date" itemprop="headline"><?php echo $date; ?></h3>
                                    
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
                                    <p><b>Location: </b> <a href= "<?php echo $loclink; ?>"> <?php echo $location ?> </a> </p>
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
						<div class="col-md-2 hidden-xs hidden-sm">
								<?php get_sidebar('sidebar1'); ?>
						</div>
					</div>
			</div>
<?php endwhile; endif;?>


<?php get_footer(); ?>
