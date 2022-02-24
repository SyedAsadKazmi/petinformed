<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DisruptPress
 */

get_header(); ?>

	<div class="<?php echo disruptpress_default_site_layout( 'class_wrap' ); ?>-wrap">
		<main id="disruptpress-content" class="content" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="archive-description taxonomy-archive-description taxonomy-description">
				<?php
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
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