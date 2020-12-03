<?php
/**
 * The template for displaying the footer.
 *
 * @package YIKES Starter
 */

?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<h2 class="screen-reader-text">Footer</h2>
	<div class="container">
		<div class="row footer-widgets">
			<div class="col-sm-3 footer-col first">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>

			<div class="col-sm-3 footer-col">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>

			<div class="col-sm-3 footer-col">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>

			<div class="col-sm-3 footer-col last">
				<?php dynamic_sidebar( 'footer-4' ); ?>

				<!-- If using the social menu, remember to add classes to menu items in custom menus -->
				<div id="social-navigation" class="social-nav" role="presentation">
					<h3 id="social-media" class="screen-reader-text">Social Media</h3>
					<?php
					wp_nav_menu(
						array(
							'menu'           => 'social_menu',
							'theme_location' => 'social_menu',
							'depth'          => 1,
							'container'      => false,
							'menu_class'     => 'yikes-social-menu',
							'fallback_cb'    => 'false',
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => ', opens in new tab</span>',
						)
					);
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 credits">
				<h3 id="copyright-information" class="screen-reader-text">Copyright Information</h3>
				Copyright &#169; 
				<?php echo esc_html( gmdate( 'Y' ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
