<?php
/**
 * Template for 404 pages (not found).
 *
 * @package DisruptPress
 */

get_header(); ?>

	<div class="<?php echo disruptpress_default_site_layout( 'class_wrap' ); ?>-wrap">
		<main id="disruptpress-content" class="content" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Error 404 - Page not found', 'disruptpress' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'The page you were looking for, was not found.', 'disruptpress' ); ?></p>

					<?php
// 						get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
		<?php 
		//Primary Sidebar
		if ( is_active_sidebar( 'sidebar-1' ) AND disruptpress_default_site_layout( 'primary_sidebar' ) === true) {
			
			if ( disruptpress_default_site_layout( 'fullheight' ) === true) {
				
				if ( disruptpress_default_site_layout( 'secondary_sidebar' ) === true ) {
					get_sidebar( '2' );
				}
				
			} elseif ( disruptpress_default_site_layout( 'class_wrap' ) == 'content-sidebar2' || disruptpress_default_site_layout( 'class_wrap' ) == 'sidebar2-content' ) {
				get_sidebar( '2' );

			} else {
				get_sidebar( '1' );
			}
			
		}
		?>
	</div><!-- .$-wrap -->

<?php
	//Seondary Sidebar
	if ( is_active_sidebar( 'sidebar-2' ) AND disruptpress_default_site_layout( 'secondary_sidebar' ) === true AND disruptpress_default_site_layout( 'fullheight' ) === false ) {
		if ( disruptpress_default_site_layout( 'class_wrap' ) == 'content-sidebar2' || disruptpress_default_site_layout( 'class_wrap' ) == 'sidebar2-content' ) {
			get_sidebar( '1' );
		} else {
			get_sidebar( '2' );
		}
	}

get_footer();
