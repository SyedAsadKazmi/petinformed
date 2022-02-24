<?php


function dp_ad_inside_header() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-inside-header'] != "" AND dp_check_ad_disabled() ) {
			echo '<div class="ad-inside-header">';
			echo do_shortcode( $disruptpress_theme_options['ad-inside-header'] );
			echo '</div>';
		}
	//}

}
add_action( 'disruptpress_header_widget', 'dp_ad_inside_header' );


function dp_ad_below_primary_menu() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-below-primary-menu'] != "" AND dp_check_ad_disabled() ) {
			echo '<div class="dp-ad-below-primary-menu" style="text-align: center; line-height: 1; margin: 20px 0 20px 0;">';
			echo do_shortcode( $disruptpress_theme_options['ad-below-primary-menu'] );
			echo '</div>';
		}
	//}


}
add_action( 'disruptpress_wrap_entry', 'dp_ad_below_primary_menu' );


//function ad_below_front_page_grid() {
//    global $disruptpress_theme_options;
//
//    if ( $disruptpress_theme_options['ad-below-front-page-grid'] != "" AND !is_page( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
//        echo '<div class="ad-below-front-page-grid" style="text-align: center; line-height: 1; margin: 20px 0 30px 0;">';
//        echo $disruptpress_theme_options['ad-below-front-page-grid'];
//        echo '</div>';
//    }
//}
//add_action( 'dp_below_grid_posts', 'ad_below_front_page_grid' );

function ad_above_page_title() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-above-page-title'] != "" AND ( is_single() OR is_page() ) AND dp_check_ad_disabled() ) {
			echo '<div class="ad-above-page-title" style="text-align: center; line-height: 1; margin: 20px 0 30px 0;">';
			echo do_shortcode( $disruptpress_theme_options['ad-above-page-title'] );
			echo '</div>';
		}
	//}

}
add_action( 'disruptpress_before_entry', 'ad_above_page_title' );

function ad_above_page_content() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-above-page-content'] != "" AND ( is_single() OR is_page() ) AND dp_check_ad_disabled() ) {
			echo '<div class="ad-above-page-content" style="text-align: center; line-height: 1; margin: 20px 0 30px 0;">';
			echo do_shortcode( $disruptpress_theme_options['ad-above-page-content'] );
			echo '</div>';
		}
	//}
}
add_action( 'disruptpress_before_the_content', 'ad_above_page_content' );


function ad_below_page_content() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-below-page-content'] != "" AND ( is_single() OR is_page() ) AND dp_check_ad_disabled() ) {
			echo '<div class="ad-below-page-content" style="text-align: center; line-height: 1; margin: 20px 0 30px 0;">';
			echo do_shortcode( $disruptpress_theme_options['ad-below-page-content'] );
			echo '</div>';
		}
	//}
}
add_action( 'disruptpress_after_entry_content', 'ad_below_page_content' );

function ad_below_site_content() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-below-site-content'] != "" AND dp_check_ad_disabled() ) {
			echo '<div class="ad-below-site-content" style="text-align: center; line-height: 1; margin: 20px 0 30px 0; clear: both;">';
			echo do_shortcode( $disruptpress_theme_options['ad-below-site-content'] );
			echo '</div>';
		}
	//}

}
add_action( 'disruptpress_wrap_end', 'ad_below_site_content' );

function ad_page_level_ads() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['ad-page-level'] != "" AND dp_check_ad_disabled() ) {
			echo do_shortcode( $disruptpress_theme_options['ad-page-level'] );
		}
	//}

}
add_action( 'wp_head', 'ad_page_level_ads' );

class disruptpress_theme_options_widget_1 extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_theme_options_widget_1',
            'description' => 'Ad Manager Widget #1',
        );
        parent::__construct( 'disruptpress_theme_options_widget_1', 'Ad Manager Widget #1', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        global $post;

	    //if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		    if ( $disruptpress_theme_options['ad-widget-1'] != "" AND dp_check_ad_disabled() ) {
			    echo '<div class="dp-ad-widget-1 dp-ad-widget">';
			    echo do_shortcode( $disruptpress_theme_options['ad-widget-1'] );
			    echo '</div>';
		    }
	    //}
    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_theme_options_widget_1' );
});

class disruptpress_theme_options_widget_2 extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_theme_options_widget_2',
            'description' => 'Ad Manager Widget #2',
        );
        parent::__construct( 'disruptpress_theme_options_widget_2', 'Ad Manager Widget #2', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        global $post;

	    //if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		    if ( $disruptpress_theme_options['ad-widget-2'] != "" AND dp_check_ad_disabled() ) {
			    echo '<div class="dp-ad-widget-2 dp-ad-widget">';
			    echo do_shortcode( $disruptpress_theme_options['ad-widget-2'] );
			    echo '</div>';
		    }
	    //}

    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_theme_options_widget_2' );
});

class disruptpress_theme_options_widget_3 extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_theme_options_widget_3',
            'description' => 'Ad Manager Widget #3',
        );
        parent::__construct( 'disruptpress_theme_options_widget_3', 'Ad Manager Widget #3', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        global $post;

	    //if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		    if ( $disruptpress_theme_options['ad-widget-3'] != "" AND dp_check_ad_disabled() ) {
			    echo '<div class="dp-ad-widget-3 dp-ad-widget">';
			    echo do_shortcode( $disruptpress_theme_options['ad-widget-3'] );
			    echo '</div>';
		    }
	   // }

    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_theme_options_widget_3' );
});

// Social Media Follow Widget
add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_theme_options_widget_2' );
});

class disruptpress_social_media_follow extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_social_media_follow',
            'description' => 'Social Media Pages',
        );
        parent::__construct( 'disruptpress_social_media_follow', 'Social Media Pages', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        echo '<div class="dp-social-media-follow-wrap">';

        $fb_link = $disruptpress_theme_options['dp-fb-link'];
        $twitter_link = $disruptpress_theme_options['dp-twitter-link'];
        //$google_link = $disruptpress_theme_options['dp-google-link'];
        $linkdin_link = $disruptpress_theme_options['dp-linkedin-link'];
        $pinterest_link = $disruptpress_theme_options['dp-pinterest-link'];
        $instagram_link = $disruptpress_theme_options['dp-instagram-link'];
        $youtube_link = $disruptpress_theme_options['dp-youtube-link'];

        if ( $fb_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-facebook"><a href="' . $fb_link . '" target="_blank">Follow us on <i class="fa fa-facebook" aria-hidden="true""></i><span class="dp-social-media-follow-text">Facebook</span></a></div>';
        }

        if ( $twitter_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-twitter"><a href="' . $twitter_link . '" target="_blank">Follow us on <i class="fa fa-twitter" aria-hidden="true"></i><span class="dp-social-media-follow-text">Twitter</span></a></div>';
        }

        // if ( $google_link != '' ) {
        //     echo '<div class="dp-social-media-follow-button dp-social-media-follow-google"><a href="' . $google_link . '" target="_blank">Follow us on <i class="fa fa-google-plus" aria-hidden="true"></i><span class="dp-social-media-follow-text">Google+</span></a></div>';
        // }

        if ( $linkdin_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-linkedin"><a href="' . $linkdin_link . '" target="_blank"">Follow us on <i class="fa fa-linkedin" aria-hidden="true"></i><span class="dp-social-media-follow-text">LinkedIn</span></a></div>';
        }

        if ( $pinterest_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-pinterest"><a href="' . $pinterest_link . '" target="_blank">Follow us on <i class="fa fa-pinterest" aria-hidden="true"></i><span class="dp-social-media-follow-text">Pinterest</span></a></div>';
        }
      
        if ( $instagram_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-instagram"><a href="' . $instagram_link . '" target="_blank">Follow us on <i class="fa fa-instagram" aria-hidden="true"></i><span class="dp-social-media-follow-text">Instagram</span></a></div>';
        }

        if ( $youtube_link != '' ) {
            echo '<div class="dp-social-media-follow-button dp-social-media-follow-youtube"><a href="' . $youtube_link . '" target="_blank">Follow us on <i class="fa fa-youtube" aria-hidden="true"></i><span class="dp-social-media-follow-text">YouTube</span></a></div>';
        }
        echo ' </div>';
    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_social_media_follow' );
});


// Facebook Page Like Widget
class disruptpress_facebook_like_box extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_facebook_like_box',
            'description' => 'Facebook Like Box',
        );
        parent::__construct( 'disruptpress_facebook_like_box', 'Facebook Like Box', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        $fb_url = $disruptpress_theme_options['dp-fb-link'];

        if ( $fb_url != "" ) {
            echo '<div class="dp-custom-widget">';
            echo '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=788436921255815";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';

            echo '<div class="fb-page" data-href="' . $fb_url . '" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="' . $fb_url . '" class="fb-xfbml-parse-ignore"><a href="' . $fb_url . '">' . get_bloginfo( 'name' ) . '</a></blockquote></div>';

            echo '</div>';
        }
    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_facebook_like_box' );
});



//Amazon Ad Widget 1
class disruptpress_amazon_ad_widget_1 extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_amazon_ad_widget_1',
            'description' => 'Amazon Ad #1',
        );
        parent::__construct( 'disruptpress_amazon_ad_widget_1', 'Amazon Ad #1', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        global $post;

	   // if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		    if ( dp_check_ad_disabled() ) {

// 			    echo '<script type="text/javascript">
// amzn_assoc_placement = "adunit0";
// amzn_assoc_search_bar = "false";
// amzn_assoc_tracking_id = "' . $disruptpress_theme_options['dp-amazon-id'] . '";
// amzn_assoc_ad_mode = "search";
// amzn_assoc_ad_type = "smart";
// amzn_assoc_marketplace = "amazon";
// amzn_assoc_region = "US";
// amzn_assoc_title = "";
// amzn_assoc_default_search_phrase = "' . $disruptpress_theme_options['dp-amazon-ad-widget-1-search-term'] . '";
// amzn_assoc_default_category = "All";
// amzn_assoc_rows = "' . $disruptpress_theme_options['dp-amazon-ad-widget-1-rows'] . '";
// amzn_assoc_search_bar_position = "top";
// </script>
// <script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>';

echo '<div id="dp_amazon_ads3" class="dp_amazon_ads dp_amazon_ads_widget"></div>
<div id="dp_amazon_ads_disclaimer3" class="dp_amazon_ads_disclaimer"><a href="https://affiliate-program.amazon.com/" target="_blank">Ads by Amazon</a></div>';

		    }
	    //}

    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_amazon_ad_widget_1' );
});


//Amazon Ad Widget 2
class disruptpress_amazon_ad_widget_2 extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'disruptpress_amazon_ad_widget_2',
            'description' => 'Amazon Ad #1',
        );
        parent::__construct( 'disruptpress_amazon_ad_widget_2', 'Amazon Ad #2', $widget_ops );
    }

    public function widget( $args, $instance ) {
        global $disruptpress_theme_options;
        global $post;

	    //if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		    if ( dp_check_ad_disabled() ) {

// 			    echo '<script type="text/javascript">
// amzn_assoc_placement = "adunit0";
// amzn_assoc_search_bar = "false";
// amzn_assoc_tracking_id = "' . $disruptpress_theme_options['dp-amazon-id'] . '";
// amzn_assoc_ad_mode = "search";
// amzn_assoc_ad_type = "smart";
// amzn_assoc_marketplace = "amazon";
// amzn_assoc_region = "US";
// amzn_assoc_title = "";
// amzn_assoc_default_search_phrase = "' . $disruptpress_theme_options['dp-amazon-ad-widget-2-search-term'] . '";
// amzn_assoc_default_category = "All";
// amzn_assoc_rows = "' . $disruptpress_theme_options['dp-amazon-ad-widget-2-rows'] . '";
// amzn_assoc_search_bar_position = "top";
// </script>
// <script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>';

echo '<div id="dp_amazon_ads4" class="dp_amazon_ads dp_amazon_ads_widget"></div>
<div id="dp_amazon_ads_disclaimer4" class="dp_amazon_ads_disclaimer"><a href="https://affiliate-program.amazon.com/" target="_blank">Ads by Amazon</a></div>';
		    }
	    //}

    }

}

add_action( 'widgets_init', function(){
    register_widget( 'disruptpress_amazon_ad_widget_2' );
});

/**
 * Disable Toolbar
 */
function dp_disable_toolbar() {
    global $disruptpress_theme_options;
    if ( $disruptpress_theme_options['dp-disable-toolbar'] ) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action( 'wp_loaded', 'dp_disable_toolbar' );

/**
 * Enable Automatic Theme Update
 */
function dp_enable_auto_theme_update() {
    global $disruptpress_theme_options;
    if ( $disruptpress_theme_options['dp-auto-update-themes'] ) {
        add_filter( 'auto_update_theme', '__return_true' );
    }
}
add_action( 'init', 'dp_enable_auto_theme_update' );


/**
 * Enable Automatic Plugin Update
 */
function dp_enable_auto_plugin_update() {
    global $disruptpress_theme_options;
    if ( $disruptpress_theme_options['dp-auto-update-plugins'] ) {
        add_filter( 'auto_update_plugin', '__return_true' );
    }
}
add_action( 'init', 'dp_enable_auto_plugin_update' );


/**
 * Enable Automatic WordPress Update
 */
function dp_enable_auto_wordpress_update() {
    global $disruptpress_theme_options;
    if ( $disruptpress_theme_options['dp-auto-update-wordpress'] ) {
        add_filter( 'auto_update_core', '__return_true' );
    }
}
add_action( 'init', 'dp_enable_auto_wordpress_update' );


