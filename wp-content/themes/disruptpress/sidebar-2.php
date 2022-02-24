<?php
/**
 * The sidebar containing the secondary sidebar widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DisruptPress
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside class="sidebar sidebar-secondary widget-area" role="complementary" aria-label="Secondary Sidebar" itemscope="" itemtype="http://schema.org/WPSideBar" id="sidebar-secondary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->
