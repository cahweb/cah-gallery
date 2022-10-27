            <footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix" style="margin:15px auto;">

					<nav role="navigation">
							<?php bones_footer_links(); ?>
					</nav>

                    <p class="source-org copyright">
                        <?php if(!in_array($_SERVER['REQUEST_URI'], $hideSocial)){ ?> <a href="gallery-info">Plan Your Visit</a> &nbsp;|&nbsp; <?php } ?>

                        &copy; <?php echo date('Y'); ?> <a href="http://www.ucf.edu/">University of Central Florida</a> &nbsp;|&nbsp; Operated by the <a href="http://svad.cah.ucf.edu/">UCF School of Visual Arts &amp; Design</a> <?php if(!in_array($_SERVER['REQUEST_URI'], $hideSocial)){ ?>
                        <br/><br/><a href="https://www.facebook.com/ucfgallery"><img width="28" height="28" src="<?php echo get_stylesheet_uri()?>/../img/fb-icon.png"></a>
        &nbsp;&nbsp;&nbsp;<a href="https://twitter.com/ucfgallery"><img width="28" height="28" src="<?php echo get_stylesheet_uri()?>/../img/twitter-icon.png"></a>
        &nbsp;&nbsp;&nbsp;<a href="https://www.instagram.com/artsatucf/"><img width="28" height="28" src="<?php echo get_stylesheet_uri()?>/../img/instagram-icon.png"></a>
        &nbsp;&nbsp; <a href="http://eepurl.com/de6CCD" target="_blank"> <img width="28" height="28" src="<?php echo get_stylesheet_uri()?>/../img/email-icon.png"></a>
                        <?php }?></p>

				</div>

			</footer>

		</div>

		<?php wp_footer(); ?>
	</body>
</html>
