<?php
/**
 * The main template file.
 *
 * @package DisruptPress
 */

get_header(); ?>



	<div class="<?php echo disruptpress_default_site_layout( 'class_wrap' ); ?>-wrap">
		
		<?php do_action('dp_content_sidebar_wrap_top'); ?>
		
		<main id="disruptpress-content" class="content" role="main">
			
		<?php do_action('dp_main_content_top'); ?>
			
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			//the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
            <?php disruptpress_posts_nav(); ?>
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