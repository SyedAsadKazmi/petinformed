(function( $ ) {
	'use strict';

    jQuery(document).ready(function( $ ) {


        $('#wp_autonomous_rss_content_extraction').change(function() {
            if(this.checked) {
                $('#wp_autonomous_rss_playlist').css( 'display', 'inline-block' );
                $('#wp_autonomous_rss_playlist_description').css( 'display', 'inline-block' );
            } else {
                $('#wp_autonomous_rss_playlist').css( 'display', 'none' );
                $('#wp_autonomous_rss_playlist_description').css( 'display', 'none' );
            }
        });






        if( $('#wp_autonomous_rss_channel_toggle').is(':checked') ) {
            $('#wp_autonomous_rss_channel').css( 'display', 'inline-block' );
            $('#wp_autonomous_rss_channel_description').css( 'display', 'inline-block' );
        }

        $('#wp_autonomous_rss_channel_toggle').change(function() {
            if(this.checked) {
                $('#wp_autonomous_rss_channel').css( 'display', 'inline-block' );
                $('#wp_autonomous_rss_channel_description').css( 'display', 'inline-block' );
            } else {
                $('#wp_autonomous_rss_channel').css( 'display', 'none' );
                $('#wp_autonomous_rss_channel_description').css( 'display', 'none' );
            }
        });


        if( $('#wp_autonomous_rss_playlist_toggle').is(':checked') ) {
            $('#wp_autonomous_rss_playlist').css( 'display', 'inline-block' );
            $('#wp_autonomous_rss_playlist_description').css( 'display', 'inline-block' );
        }

        $('#wp_autonomous_rss_playlist_toggle').change(function() {
            if(this.checked) {
                $('#wp_autonomous_rss_playlist').css( 'display', 'inline-block' );
                $('#wp_autonomous_rss_playlist_description').css( 'display', 'inline-block' );
            } else {
                $('#wp_autonomous_rss_playlist').css( 'display', 'none' );
                $('#wp_autonomous_rss_playlist_description').css( 'display', 'none' );
            }
        });


        if( $('#wp_autonomous_rss_banned_keywords_toggle').is(':checked') ) {
            $('#wp_autonomous_rss_banned_keywords').css( 'display', 'inline-block' );
            $('#wp_autonomous_rss_banned_keywords_description').css( 'display', 'inline-block' );
        }

        $('#wp_autonomous_rss_banned_keywords_toggle').change(function() {
            if(this.checked) {
                $('#wp_autonomous_rss_banned_keywords').css( 'display', 'inline-block' );
                $('#wp_autonomous_rss_banned_keywords_description').css( 'display', 'inline-block' );
            } else {
                $('#wp_autonomous_rss_banned_keywords').css( 'display', 'none' );
                $('#wp_autonomous_rss_banned_keywords_description').css( 'display', 'none' );
            }
        });

    });

})( jQuery );
