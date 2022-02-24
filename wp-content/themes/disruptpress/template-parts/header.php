<?php


function disruptpress_do_header() {

?>
<header class="site-header" itemscope itemtype="http://schema.org/WPHeader">
	<div class="wrap">
		
		<?php echo disruptpress_title_area( 'dp_header_logo', false ); ?>
		
		<?php
		global $disruptpress_theme_options; 
		
		if ( is_active_sidebar( 'header-1' ) OR ( $disruptpress_theme_options['ad-inside-header'] != "" AND dp_check_ad_disabled() ) ) : ?>
				<aside class="header-widget-area widget-area">
					<?php do_action( 'disruptpress_header_widget' ); ?>
                    <?php dynamic_sidebar( 'header-1' ); ?>
				</aside>
		<?php endif; ?>

	</div>
</header>
<?php
}

function disruptpress_do_header_wp_loaded() {
	$position = array_search( 'header', dp_theme_mod( 'dp_sort_header_arrangement' ) );

	if ( $position !== false ) {
 		add_action( 'disruptpress_header', 'disruptpress_do_header', $position );
	}

}
add_action( 'wp_loaded', 'disruptpress_do_header_wp_loaded' );










