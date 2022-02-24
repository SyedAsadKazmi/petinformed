<?php

function disruptpress_do_nav_primary() {
	?><div class="nav-primary-height-fix"><div class="nav-primary-scroll-wrap">
	<nav class="nav-primary" itemscope itemtype="http://schema.org/SiteNavigationElement" id="disruptpress-nav-primary" aria-label="Main navigation">

			<?php wp_nav_menu( array( 
					'theme_location'  => 'primary',
					'menu_id'         => '',
					'container_class' => 'wrap',
					'menu_class'      => 'disruptpress-nav-menu',
					'fallback_cb'     => false,
				) ); ?>
	</nav>
</div>
</div>
<?php
}

function disruptpress_do_nav_primary_wp_loaded() {
	$position = array_search( 'nav_primary', dp_theme_mod( 'dp_sort_header_arrangement' ) );

	if ( $position !== false ) {
		add_action( 'disruptpress_header', 'disruptpress_do_nav_primary', $position );
	}

}
add_action( 'wp_loaded', 'disruptpress_do_nav_primary_wp_loaded' );