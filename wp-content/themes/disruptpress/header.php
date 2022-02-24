<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DisruptPress
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class( disruptpress_default_site_layout( 'class_body' ) ); ?>>
<?php do_action( 'disruptpress_after_body' ); ?>
	
<div class="body-container">
<?php do_action( 'disruptpress_after_body_container' ); ?>
	
	<div class="body-background-2"></div>
	<?php do_action( 'disruptpress_after_body_background_2' ); ?>
	
	<div class="site-container">
	<?php do_action( 'disruptpress_after_site_container' ); ?>
		
			<!-- .nav-responsive -->
        <div class="disruptpress-responsive-menu-wrap">

            <div class="disruptpress-responsive-menu-wrap-title">

                <?php
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' .  get_bloginfo( 'name', 'display' ) . '</a>';
                //echo disruptpress_title_area( 'dp_primary_menu_logo', true );

                ?>
            </div>


            <div class="disruptpress-responsive-menu-wrap-menu-toggle"><a id="disruptpress-responsive-menu-toggle" href="#disruptpress-responsive-menu-toggle"></a></div>
		</div>
		<div id="disruptpress-responsive-menu">
			<a id="disruptpress-responsive-menu-toggle-inside" href="#disruptpress-responsive-menu-toggle"></a>
			<form role="search" method="get" class="responsive-search-form" action="<?PHP echo get_bloginfo( 'url' ); ?>">
				<label>
					<input type="search" class="responsive-search-field" placeholder="Search …" value="" name="s">
				</label>
				<span class="dashicons dashicons-search responsive-search-icon"></span>
			</form>
			 <?php 
				wp_nav_menu( array( 
					'theme_location'  => 'primary',
					'menu_id'         => '',
					'container_class' => '',
					'menu_class'      => 'disruptpress-responsive-menu',
					'fallback_cb'     => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>%3$s</ul>',
				) );




             wp_nav_menu( array(
						'theme_location'  => 'secondary',
						'menu_id'         => '',
						'container_class' => '',
						'menu_class'      => 'disruptpress-responsive-menu',
						'fallback_cb'     => false,
					) );
			?>
		</div>

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'disruptpress' ); ?></a>

		
		<div class="sidebarfullheight-container">
			
		<!-- .site-header -->
		<!-- .nav-primary -->
		
		<?php do_action( 'disruptpress_header' ); ?>

		

				
		<!-- .nav-secondary -->
		<nav class="nav-secondary" itemscope itemtype="http://schema.org/SiteNavigationElement" id="disruptpress-nav-secondary" aria-label="Secondary navigation">
				<?php wp_nav_menu( array( 
					'theme_location'  => 'secondary',
					'menu_id'         => '',
					'container_class' => 'wrap',
					'menu_class'      => 'disruptpress-nav-menu',
					'fallback_cb'     => false,
				) ); ?>
		</nav>




        <?php do_action( 'disruptpress_before_site_inner' ); ?>
		<div class="site-inner">

            <?php do_action( 'disruptpress_before_wrap' ); ?>
			<div class="wrap">
            <?php do_action( 'disruptpress_wrap_entry' ); ?>