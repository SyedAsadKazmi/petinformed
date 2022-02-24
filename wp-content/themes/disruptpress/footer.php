<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DisruptPress
 */

?>
<?php do_action( 'disruptpress_wrap_end' ); ?>
		</div><!-- .wrap -->

		</div><!-- .site-inner -->

		<footer class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
			<div class="wrap">
				
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<aside class="footer-widget-area footer-widget-1">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</aside>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<aside class="footer-widget-area footer-widget-2">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</aside>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<aside class="footer-widget-area footer-widget-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</aside>
				<?php endif; ?>
				
				<div class="site-footer-copyright">

                    <div class="site-footer-copyright-disclaimer">
                        <?php echo do_shortcode( disruptpress_copyright_disclaimer() ); ?>
                    </div>

                    <div class="site-footer-copyright-theme">
                        <?php echo do_shortcode( disruptpress_theme_copyright() ); ?>
                    </div>

				</div>
				
			</div><!-- .wrap -->
		</footer><!-- #colophon -->


	</div><!-- .sidebar-fullheight-container -->
	<?php 
	//Primary Sidebar
	if ( is_active_sidebar( 'sidebar-1' ) AND disruptpress_default_site_layout( 'fullheight' ) === true ) {
			get_sidebar( '1' );
	}
	?>
	</div><!-- .site-container -->
</div><!-- .body-container -->

<?php wp_footer(); ?>

</body>
</html>
