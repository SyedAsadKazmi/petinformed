<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package DisruptPress
 */

get_header(); ?>

    <div class="<?php echo disruptpress_default_site_layout( 'class_wrap' ); ?>-wrap">
		<main id="disruptpress-content" class="content" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="archive-description taxonomy-archive-description taxonomy-description" style="text-transform: capitalize">
				<h1 class="archive-title"><?php printf( esc_html__( '%s', 'disruptpress' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

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
	</div><!-- #primary -->

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