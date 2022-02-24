<?php

/**
 * Get full rss feed from http://rss.wpautonomous.com
 *
 * @since 1.0.0
 *
 * @param string $url The url of the article or the rss feed.
 * @param string $api API mode, either 'article' or 'feed'.
 * @return json Returns article or feed in JSON format.
 */
function wp_autonomous_rss_call_wpa( $url, $api='article' ) {

	// is cURL installed yet?
	if (!function_exists('curl_init')){
		die('Sorry cURL is not installed!');
	}

	if ( $api == 'extract' ) {
		$url = urlencode( $url );
		$url = 'http://rss.wpautonomous.com/rss/extract.php?url=' . $url;
	} elseif ( $api == 'feed' ) {
		$url = urlencode( $url );
		$url = 'http://rss.wpautonomous.com/rss-feed/makefulltextfeed.php?exc=1&format=json&max=10&url=' . $url;
	} else {
		$url = $url;
	}

	// Create a new cURL resource handle
	$ch = curl_init();

	// Set a referer
	//curl_setopt( $ch, CURLOPT_REFERER, 'http://' . $_SERVER['HTTP_HOST'] );
	curl_setopt( $ch, CURLOPT_REFERER, 'https://www.google.com' );

	// Set a user agent
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');

	// Set URL to download
	curl_setopt($ch, CURLOPT_URL, $url);

	// Include header in result? (0 = yes, 1 = no)
	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Timeout in seconds
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	//$ckfile = "cookie.txt";
	//curl_setopt( $ch, CURLOPT_COOKIESESSION, false );
	//curl_setopt( $ch, CURLOPT_COOKIEJAR, $ckfile );
	//curl_setopt( $ch, CURLOPT_COOKIEFILE, $ckfile );

	// Download the given URL, and return output
	$output = curl_exec($ch);

	// Close the cURL resource, and free system resources
	curl_close($ch);

	return $output;
}


function wp_autonomous_rss_getArticle( $url ) {

	// is cURL installed yet?
	if (!function_exists('curl_init')){
		die('Sorry cURL is not installed!');
	}

	$url = urlencode( $url );
	$url = 'http://rss.wpautonomous.com/rss/makefulltextfeed.php?url=' . $url.'&parser=html5php&format=json';

	// Create a new cURL resource handle
	$ch = curl_init();

	// Set a referer
	//curl_setopt( $ch, CURLOPT_REFERER, 'http://' . $_SERVER['HTTP_HOST'] );
	curl_setopt( $ch, CURLOPT_REFERER, 'https://www.google.com' );

	// Set a user agent
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');

	// Set URL to download
	curl_setopt($ch, CURLOPT_URL, $url);

	// Include header in result? (0 = yes, 1 = no)
	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Timeout in seconds
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	//$ckfile = "cookie.txt";
	//curl_setopt( $ch, CURLOPT_COOKIESESSION, false );
	//curl_setopt( $ch, CURLOPT_COOKIEJAR, $ckfile );
	//curl_setopt( $ch, CURLOPT_COOKIEFILE, $ckfile );

	// Download the given URL, and return output
	$output = curl_exec($ch);

	// Close the cURL resource, and free system resources
	curl_close($ch);

	//$output = json_decode($output, true);
	//$output['rss']['channel']['item'];

	return $output;
}

function wp_autonomous_rss_getFeed0( $url ) {

	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/simplepie/autoloader.php';

	$feed = new SimplePie();
	$feed->set_feed_url( $url );
	$feed->enable_cache(false);
	$feed->init();
	$feed->handle_content_type();

	$output = array();
	$i = 0;
	foreach ($feed->get_items() as $key=>$item) {

		$output[$key]['link'] = $item->get_permalink();
		$output[$key]['title'] = $item->get_title();
		$output[$key]['summary'] = $item->get_content();
		$output[$key]['date'] = $item->get_date('Y-m-d H:i:s');

		if ( $enclosure = $item->get_enclosure() ) {

			$output[$key]['image'] = $enclosure->get_thumbnail();
		}

		$cat = array();

		if( $item->get_categories() ) {
			foreach( $item->get_categories() as $category ) {
				$cat[] = $category->get_term();
			}
		}

		$output[$key]['categories'] = $cat;

		$i++;
		if($i == 10) break;
	}

	return $output;
}

//var_dump(wp_autonomous_rss_getFeed('https://news.xbox.com/en-us/feed/'));


function wp_autonomous_rss_getFeed( $url ) {

	// is cURL installed yet?
	if (!function_exists('curl_init')){
		die('Sorry cURL is not installed!');
	}

	$url = urlencode( $url );
	$url = 'http://rss.wpautonomous.com/rss-feed/makefulltextfeed.php?exc=1&format=json&max=10&summary=1&url=' . $url;


	// Create a new cURL resource handle
	$ch = curl_init();

	// Set a referer
	//curl_setopt( $ch, CURLOPT_REFERER, 'http://' . $_SERVER['HTTP_HOST'] );
	curl_setopt( $ch, CURLOPT_REFERER, 'https://www.google.com' );

	// Set a user agent
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');

	// Set URL to download
	curl_setopt($ch, CURLOPT_URL, $url);

	// Include header in result? (0 = yes, 1 = no)
	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Timeout in seconds
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	// Download the given URL, and return output
	$feed = curl_exec($ch);

	// Close the cURL resource, and free system resources
	curl_close($ch);


	$output = array();

	$i = 0;

	$json = json_decode( $feed, true );
	$items = $json['rss']['channel']['item'];

	foreach ($items as $key=>$item) {

		$output[$key]['link'] = $item['link'];
		$output[$key]['title'] = $item['title'];
		$output[$key]['summary'] = $item['description'];
		//$output[$key]['date'] = $item['pubDate'];
		$output[$key]['image'] = $item['og_image'];


		$pubDate = $item['pubDate'];
		$pubDate = strftime("%Y-%m-%d %H:%i:%s", strtotime($pubDate));
		$output[$key]['date'] = $pubDate;

		$cat = array();

		if( isset( $item['category'] ) ){
			$cat = $item['category'];
		}

		$output[$key]['categories'] = $cat;

		$i++;
		if($i == 10) break;
	}

	return $output;
}


/**
 * Download Featured Image
 *
 * @since 1.0.0
 *
 * @param string $image_url The image URL including http:// or https://
 * @param string $post_id The post ID
 */
function wp_autonomous_rss_download_image( $image_url, $post_id ){

	//$image_name       = basename($image_url);

	if ( strpos( $image_url, '?' ) !== false) {

		$image_name = explode( "?", $image_url );
		$image_name = basename( $image_name[0] );

	} else {
		$image_name = basename($image_url);
	}

	$upload_dir       = wp_upload_dir(); // Set upload folder
	$image_data       = file_get_contents($image_url); // Get image data
	$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
	$filename         = basename( $unique_file_name ); // Create image file name

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => sanitize_file_name( $filename ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $attach_id;

}