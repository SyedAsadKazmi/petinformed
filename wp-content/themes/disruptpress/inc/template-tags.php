<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package DisruptPress
 */

if ( ! function_exists( 'disruptpress_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function disruptpress_posted_on() {
    global $post;
    $author_id=$post->post_author;

	$time_string = '<time class="entry-time published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-time published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( esc_html_x( '%s', 'post date', 'disruptpress' ), $time_string );

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'disruptpress' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . ' </span>'; // WPCS: XSS OK.
	

	
	echo '<span class="entry-comments-link"><a href="' . get_comments_link() . '">';
	
	printf( // WPCS: XSS OK.
					esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'disruptpress' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
	
	echo '</a></span> ';
	
		edit_post_link(
		esc_html__( '(Edit)', 'disruptpress' ),
		'<span class="edit-link">',
		'</span>'
	);
	
}
endif;

if ( ! function_exists( 'disruptpress_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function disruptpress_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		//$categories_list = get_the_category_list( esc_html__( ', ', 'disruptpress' ) );
		//if ( $categories_list && disruptpress_categorized_blog() ) {
			//printf( '<span class="entry-categories">' . esc_html__( '%1$s', 'disruptpress' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	//	}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'disruptpress' ) );
		if ( $tags_list && is_single() ) {
			printf( '<span class="tags-links">Tags: ' . esc_html__( '%1$s', 'disruptpress' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
	//	comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'disruptpress' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function disruptpress_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'disruptpress_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'disruptpress_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so disruptpress_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so disruptpress_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in disruptpress_categorized_blog.
 */
function disruptpress_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'disruptpress_categories' );
}
add_action( 'edit_category', 'disruptpress_category_transient_flusher' );
add_action( 'save_post',     'disruptpress_category_transient_flusher' );

/**
 * Remove archive title prefix (category, tag, author)
 */
add_filter( 'get_the_archive_title', function ($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}

	return $title;
});




