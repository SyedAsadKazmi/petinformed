<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DisruptPress
 */

get_header(); ?>

<?php do_action( 'disruptpress_before_content_wrap' ); ?>
	<div class="<?php echo disruptpress_default_site_layout( 'class_wrap' ); ?>-wrap">

        <?php do_action( 'disruptpress_before_content' ); ?>
		<main id="disruptpress-content" class="content" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

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