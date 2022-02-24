<?php
// Originally created by  Nelio Software https://neliosoftware.com/
/* =========================================================================*/
/* =========================================================================*/
/*             SOME USEFUL FUNCTIONS                                        */
/* =========================================================================*/
/* =========================================================================*/

/**
 * This function returns Nelio EFI's post meta key. The key can be changed
 * using the filter `disruptpress_efi_post_meta_key'
 */
function _disruptpress_efi_url() {
    return apply_filters( 'disruptpress_efi_post_meta_key', '_nelioefi_url' );
}


/**
 * This function returns whether the post whose id is $id uses an external
 * featured image or not
 */
function uses_disruptpress_efi( $id ) {
    $image_url = disruptpress_efi_get_thumbnail_src( $id );
    if ( $image_url === false )
        return false;
    else
        return true;
}


/**
 * This function returns the URL of the external featured image (if any), or
 * false otherwise.
 */
function disruptpress_efi_get_thumbnail_src( $id, $called_on_save = false ) {

    // Remove filter temporarily, because uses_disruptpress_efi checks if a regular
    // feat. image is used.
    disruptpress_efi_unhook_thumbnail_id();
    $regular_feat_image = get_post_meta( $id, '_thumbnail_id', true );
    disruptpress_efi_hook_thumbnail_id();

    if ( isset( $regular_feat_image ) && $regular_feat_image > 0 ) {
        return false;
    }//end if

    $image_url = get_post_meta( $id, _disruptpress_efi_url(), true );

    if ( strpos( $image_url, '/resources/r/' ) !== false AND strpos( $image_url, 'reutersmedia.net' ) === false) {

      //if ( $size == 'full') {
        $image_url = str_replace("w=400", "w=800", $image_url);
      //}

      $image_url = str_replace("/resources/", "https://www.reuters.com/resources/", $image_url);

    }
  
    if ( ! $image_url || strlen( $image_url ) === 0 ) {

        $is_frontend = ! is_admin() || $called_on_save;

        if ( apply_filters( 'disruptpress_efi_use_first_image', true ) && $is_frontend ) {

            $first_feat_image = get_post_meta( $id, '_disruptpress_efi_first_image', true );

            if(!$first_feat_image) {
                $first_feat_image = [];
            }
//             if ( empty( $first_feat_image ) ) {

//                 $image_url = '""';

//                 $matches = array();
//                 $post = get_post( $id );
//                 if ( ! is_wp_error( $post ) && $post ) {

//                     preg_match(
//                         '/<img [^>]*src=("[^"]*"|\'[^\']*\')/i',
//                         $post->post_content,
//                         $matches
//                     );

//                     if ( count( $matches ) > 1 ) {
//                         $image_url = $matches[1];
//                     }//end if

//                 }//end if

//                 $image_url = substr( $image_url, 1, strlen( $image_url ) - 2 );
//                 $first_feat_image = array( $image_url );
//                 delete_post_meta( $id, '_disruptpress_efi_first_image' );
//                 update_post_meta( $id, '_disruptpress_efi_first_image', $first_feat_image );
//             }//end if

            if ( count( $first_feat_image ) > 0 && strlen( $first_feat_image[0] ) > 0 ) {
                return $first_feat_image[0];
            }//end if

        }//end if

        return false;
    }//end if

  

  
    return $image_url;
}

add_filter( 'save_post', 'disruptpress_efi_fix_first_image' );
function disruptpress_efi_fix_first_image( $post_id ) {
    if ( wp_is_post_revision( $post_id) || wp_is_post_autosave( $post_id ) ) {
        return;
    }//end if
    delete_post_meta( $post_id, '_disruptpress_efi_first_image' );
    disruptpress_efi_get_thumbnail_src( $post_id, true );
}//end disruptpress_efi_fix_first_image()


/**
 * This function prints an image tag with the external featured image (if any).
 * This tag, in fact, has a 1x1 px transparent gif image as its src, and
 * includes the external featured image via inline CSS styling.
 */
function disruptpress_efi_the_html_thumbnail( $id, $size = false, $attr = array() ) {
    if ( uses_disruptpress_efi( $id ) )
        echo disruptpress_efi_get_html_thumbnail( $id );
}


/**
 * This function returns the image tag with the external featured image (if
 * any). This tag, in fact, has a 1x1 px transparent gif image as its src,
 * and includes the external featured image via inline CSS styling.
 */
function disruptpress_efi_get_html_thumbnail( $id, $size = false, $attr = array() ) {
    if ( uses_disruptpress_efi( $id ) === false )
        return false;

    $image_url = disruptpress_efi_get_thumbnail_src( $id );

    $width = false;
    $height = false;
    $additional_classes = '';

    global $_wp_additional_image_sizes;
    if ( is_array( $size ) ) {
        $width = $size[0];
        $height = $size[1];
    }
    else if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
        $width = $_wp_additional_image_sizes[ $size ]['width'];
        $height = $_wp_additional_image_sizes[ $size ]['height'];
        $additional_classes = 'attachment-' . $size . ' ';
    }

    if ( $width && $width > 0 ) $width = "width:${width}px;";
    else $width = '';

    if ( $height && $height > 0 ) $height = "height:${height}px;";
    else $height = '';

    if ( isset( $attr['class'] ) )
        $additional_classes .= $attr['class'];

    $alt = get_post_meta( $id, '_disruptpress_efi_alt', true );
    if ( isset( $attr['alt'] ) )
        $alt = $attr['alt'];
    if ( !$alt )
        $alt = '';

    if ( is_feed() ) {
        $style = '';
        if ( isset( $attr['style'] ) )
            $style = 'style="' . $attr['style'] . '" ';
        $html = sprintf(
            '<img src="%s" %s' .
            'class="%s wp-post-image disruptpress_efi" '.
            'alt="%s" />',
            $image_url, $style, $additional_classes, $alt );
    }
    else {
        /*$html = sprintf(
            '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" ' .
            'style="background:url(\'%s\') no-repeat center center;' .
            '-webkit-background-size:cover;' .
            '-moz-background-size:cover;' .
            '-o-background-size:cover;' .
            'background-size:cover;' .
            '%s%s" class="%s wp-post-image disruptpress_efi" '.
            'alt="%s" />',
            $image_url, $width, $height, $additional_classes, $alt );*/

        $html = '<img src="'.$image_url.'" class="'.$additional_classes.' wp-post-image disruptpress_efi" alt="'.$alt.'" />';
    }

    return $html;
}


/* =========================================================================*/
/* =========================================================================*/
/*             ALL HOOKS START HERE                                         */
/* =========================================================================*/
/* =========================================================================*/

// Overriding post thumbnail when necessary
add_filter( 'genesis_pre_get_image', 'disruptpress_efi_genesis_thumbnail', 10, 3 );
function disruptpress_efi_genesis_thumbnail( $unknown_param, $args, $post ) {
    $image_url = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

    if ( !$image_url || strlen( $image_url ) == 0 ) {
        return false;
    }

    if ( $args['format'] == 'html' ) {
        $html = disruptpress_efi_replace_thumbnail( '', $post->ID, 0, $args['size'], $args['attr'] );
        $html = str_replace( 'style="', 'style="min-width:150px;min-height:150px;', $html );
        return $html;
    }
    else {
        return $image_url;
    }
}


// Overriding post thumbnail when necessary
add_filter( 'post_thumbnail_html', 'disruptpress_efi_replace_thumbnail', 10, 5 );
function disruptpress_efi_replace_thumbnail( $html, $post_id, $post_image_id, $size, $attr ) {
    if ( uses_disruptpress_efi( $post_id ) )
        $html = disruptpress_efi_get_html_thumbnail( $post_id, $size, $attr );
    return $html;
}


add_action( 'init', 'disruptpress_efi_add_hooks_for_faking_featured_image_if_necessary' );
function disruptpress_efi_add_hooks_for_faking_featured_image_if_necessary(){

    disruptpress_efi_hook_thumbnail_id();

}//end disruptpress_efi_add_hooks_for_faking_featured_image_if_necessary();

function disruptpress_efi_fake_featured_image_if_necessary( $null, $object_id, $meta_key ) {

    $result = null;
    if ( '_thumbnail_id' === $meta_key ) {

        if ( uses_disruptpress_efi( $object_id ) ) {
            $result = -1;
        }//end if

    }//end if

    return $result;

}//end disruptpress_efi_fake_featured_image_if_necessary()

function disruptpress_efi_hook_thumbnail_id() {
    foreach ( get_post_types() as $post_type ) {
        add_filter( "get_${post_type}_metadata", 'disruptpress_efi_fake_featured_image_if_necessary', 10, 3 );
    }//end foreach
}//end disruptpress_efi_hook_thumbnail_id()

function disruptpress_efi_unhook_thumbnail_id() {
    foreach ( get_post_types() as $post_type ) {
        remove_filter( "get_${post_type}_metadata", 'disruptpress_efi_fake_featured_image_if_necessary', 10, 3 );
    }//end foreach
}//end disruptpress_efi_unhook_thumbnail_id()



// ADMIN STUFF
if ( is_admin() ) {
    // Creating box
    add_action( 'add_meta_boxes', 'disruptpress_efi_add_url_metabox' );
    function disruptpress_efi_add_url_metabox() {

        $excluded_post_types = array(
            'attachment', 'revision', 'nav_menu_item', 'wpcf7_contact_form',
        );

        foreach ( get_post_types( '', 'names' ) as $post_type ) {
            if ( in_array( $post_type, $excluded_post_types ) )
                continue;
            add_meta_box(
                'disruptpress_efi_url_metabox',
                'External Featured Image',
                'disruptpress_efi_url_metabox',
                $post_type,
                'side',
                'default'
            );
        }

    }

    function disruptpress_efi_url_metabox( $post ) {
        $disruptpress_efi_url = get_post_meta( $post->ID, _disruptpress_efi_url(), true );
        $disruptpress_efi_alt = get_post_meta( $post->ID, '_disruptpress_efi_alt', true );
        $has_img = strlen( $disruptpress_efi_url ) > 0;
        if ( $has_img ) {
            $hide_if_img = 'display:none;';
            $show_if_img = '';
        }
        else {
            $hide_if_img = '';
            $show_if_img = 'display:none;';
        }
        ?>
        <input type="text" placeholder="ALT attribute" style="width:100%;margin-top:10px;<?php echo $show_if_img; ?>"
               id="disruptpress_efi_alt" name="disruptpress_efi_alt"
               value="<?php echo esc_attr( $disruptpress_efi_alt ); ?>" /><?php
        if ( $has_img ) { ?>
            <div id="disruptpress_efi_preview_block"><?php
        } else { ?>
            <div id="disruptpress_efi_preview_block" style="display:none;"><?php
        } ?>
        <div id="disruptpress_efi_image_wrapper" style="<?php
        echo (
            'width:100%;' .
            'max-width:300px;' .
            'height:200px;' .
            'margin-top:10px;' .
            'background:url(' . $disruptpress_efi_url . ') no-repeat center center; ' .
            '-webkit-background-size:cover;' .
            '-moz-background-size:cover;' .
            '-o-background-size:cover;' .
            'background-size:cover;' );
        ?>">
        </div>

        <a id="disruptpress_efi_remove_button" href="#" onClick="javascript:disruptpress_efiRemoveFeaturedImage();" style="<?php echo $show_if_img; ?>">Remove featured image</a>
        <script>
            function disruptpress_efiRemoveFeaturedImage() {
                jQuery("#disruptpress_efi_preview_block").hide();
                jQuery("#disruptpress_efi_image_wrapper").hide();
                jQuery("#disruptpress_efi_remove_button").hide();
                jQuery("#disruptpress_efi_alt").hide();
                jQuery("#disruptpress_efi_alt").val('');
                jQuery("#disruptpress_efi_url").val('');
                jQuery("#disruptpress_efi_url").show();
                jQuery("#disruptpress_efi_preview_button").parent().show();
            }
            function disruptpress_efiPreview() {
                jQuery("#disruptpress_efi_preview_block").show();
                jQuery("#disruptpress_efi_image_wrapper").css('background-image', "url('" + jQuery("#disruptpress_efi_url").val() + "')" );
                jQuery("#disruptpress_efi_image_wrapper").show();
                jQuery("#disruptpress_efi_remove_button").show();
                jQuery("#disruptpress_efi_alt").show();
                jQuery("#disruptpress_efi_url").hide();
                jQuery("#disruptpress_efi_preview_button").parent().hide();
            }
        </script>
        </div>
        <input type="text" placeholder="Image URL" style="width:100%;margin-top:10px;<?php echo $hide_if_img; ?>"
               id="disruptpress_efi_url" name="disruptpress_efi_url"
               value="<?php echo esc_attr( $disruptpress_efi_url ); ?>" />
        <div style="text-align:right;margin-top:10px;<?php echo $hide_if_img; ?>">
            <a class="button" id="disruptpress_efi_preview_button" onClick="javascript:disruptpress_efiPreview();">Preview</a>
        </div>
        <?php
    }

    add_action( 'save_post', 'disruptpress_efi_save_url' );
    function disruptpress_efi_save_url( $post_ID ) {
        if ( isset( $_POST['disruptpress_efi_url'] ) ) {
            $url = strip_tags( $_POST['disruptpress_efi_url'] );
            update_post_meta( $post_ID, _disruptpress_efi_url(), $url );
        }

        if ( isset( $_POST['disruptpress_efi_alt'] ) )
            update_post_meta( $post_ID, '_disruptpress_efi_alt', strip_tags( $_POST['disruptpress_efi_alt'] ) );
    }
}//end if
