<?php

/**
 * Register meta box.
 */
function wp_autonomous_rss_register_meta_box() {
	add_meta_box( 'wp_autonomous_rss_meta_box_manual', 'Manual Posting', 'wp_autonomous_rss_meta_box_manual_posting', 'wpa_rss', 'normal', 'high' );
	add_meta_box( 'wp_autonomous_rss_meta_box_options', 'Campaign Options', 'wp_autonomous_rss_meta_box_option_fields', 'wpa_rss', 'normal', 'high' );
	add_meta_box( 'wp_autonomous_rss_meta_box_options_advanced', 'Advanced Campaign Options', 'wp_autonomous_rss_meta_box_advanced_option_fields', 'wpa_rss', 'normal', 'high' );
	add_meta_box( 'wp_autonomous_rss_meta_box_stats', 'Statistics', 'wp_autonomous_rss_meta_box_stats_fields', 'wpa_rss', 'side', 'default' );
	add_meta_box( 'wp_autonomous_rss_meta_box_posts', 'Latest Posts', 'wp_autonomous_rss_meta_box_posts_fields', 'wpa_rss', 'side', 'default' );
	add_meta_box( 'wp_autonomous_rss_meta_box_delete', 'Delete All Posts', 'wp_autonomous_rss_meta_box_delete_fields', 'wpa_rss', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'wp_autonomous_rss_register_meta_box' );

/**
 * HTML for meta box manual posting
 */
function wp_autonomous_rss_meta_box_manual_posting( $post ) {
	?>
	<div>
		<p id="wp_autonomous_rss_manual_description">Manually Post Now</p>
		<div>
			<label style="margin-right:20px">Amount of intervals to trigger now:</label>
			<select name="wp_autonomous_rss_manual_count" id="wp_autonomous_rss_manual_count">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
			</select>

			<input id="wp_autonomous_rss_manual_submit" type="button" value="Post Now" class="button button-primary button-large wp-autonomous-rss-button-red">
            <div id="wp_autonomous_rss_manual_change_notice">Settings have changed, you should save them first.</div>

		</div>
		<div id="wp_autonomous_rss_manual_ajax_content">
			<ol></ol>
		</div>
	</div>
	<?php
}

/**
 * Meta Box Option Fields
 */
function wp_autonomous_rss_meta_box_option_fields( $post ) {

	wp_nonce_field(basename(__FILE__), 'wp_autonomous_rss_meta_box_option_fields_nonce');
	$meta = get_post_meta($post->ID);
	?>

    <div class="wp-autonomous-rss-metabox">

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label>Posting Interval</label>
                <br>
                <p class="description">
                    Select how often this campaign should run.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">Every
                <select name="wp_autonomous_rss_interval_number" id="wp_autonomous_rss_interval_number">
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php selected($meta['wp_autonomous_rss_interval_number'][0], $i); ?>><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                <select name="wp_autonomous_rss_interval_unit" id="wp_autonomous_rss_interval_unit">
                    <option value="3600" <?php selected($meta['wp_autonomous_rss_interval_unit'][0], '3600'); ?>>
                        Hours
                    </option>
                    <option value="86400" <?php selected($meta['wp_autonomous_rss_interval_unit'][0], '86400'); ?>>
                        Days
                    </option>
                </select>
            </div>
        </div>




        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_feed">RSS Feed(s)</label>
                <p class="description">
                    Enter the full URL to the RSS feed.<br>
                    Example: https://wpautonomous.com/feed/
                    <br><br>You can also enter multiple feeds,<br>separated by new line
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2" style="width: calc(100% - 350px); min-width: 320px;">
                <textarea rows="8" cols="60" name="wp_autonomous_rss_feed" id="wp_autonomous_rss_feed"><?php if (isset ($meta['wp_autonomous_rss_feed'])) echo $meta['wp_autonomous_rss_feed'][0]; ?></textarea>


            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_featured_image_status" style="vertical-align: top;">Featured Image</label>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <div class="wp-autonomous-rss-metabox-grouped">

                    <div class="wp-autonomous-rss-metabox-radio">
                        <input type="radio" name="wp_autonomous_rss_featured_image_status"
                               id="wp_autonomous_rss_featured_image_status_download"
                               value="download" <?php if (isset ($meta['wp_autonomous_rss_featured_image_status'])) checked($meta['wp_autonomous_rss_featured_image_status'][0], 'download'); ?>>
                        <label for="wp_autonomous_rss_featured_image_status_download">Download Image And Add As Featured
                            Image</label><br>
                    </div>

                    <div class="wp-autonomous-rss-metabox-radio">
                        <input type="radio" name="wp_autonomous_rss_featured_image_status"
                               id="wp_autonomous_rss_featured_image_status_external"
                               value="external" <?php if (isset ($meta['wp_autonomous_rss_featured_image_status'])) checked($meta['wp_autonomous_rss_featured_image_status'][0], 'external'); ?>>
                        <label for="wp_autonomous_rss_featured_image_status_external">Keep Image External And Add As Featured
                            Image</label>
                    </div>

                    <div class="wp-autonomous-rss-metabox-radio">
                        <input type="radio" name="wp_autonomous_rss_featured_image_status"
                               id="wp_autonomous_rss_featured_image_status_no"
                               value="no" <?php if (!isset ($meta['wp_autonomous_rss_featured_image_status']) OR $meta['wp_autonomous_rss_featured_image_status'][0] == 'no') echo 'checked'; ?> >
                        <label for="wp_autonomous_rss_featured_image_status_no">Don't Set Any Image As Featured Image</label><br>
                    </div>

                </div>
            </div>
        </div>


    </div>


	<?php
}

/**
 * Meta Box Option Fields
 */
function wp_autonomous_rss_meta_box_advanced_option_fields( $post ) {

	wp_nonce_field(basename(__FILE__), 'wp_autonomous_rss_meta_box_advanced_option_fields_nonce');
	$meta = get_post_meta($post->ID);
	?>



    <div class="wp-autonomous-rss-metabox">



        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_title_snr">Title Search & Replace</label>
                <br>
                <p class="description">
                    Replace or remove words in the title.<br>
                    Leave replace field empty to remove a word.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <div class="wp-autonomous-rss-clone-wrap">
                    <?php

                    if( isset( $meta['wp_autonomous_rss_title_snr'] ) ) {
	                    $wp_autonomous_rss_title_snr = unserialize( $meta['wp_autonomous_rss_title_snr'][0] );
	                    $wp_autonomous_rss_title_snr_count = count( $wp_autonomous_rss_title_snr['search'] );
                    } else {
	                    $wp_autonomous_rss_title_snr = '';
	                    $wp_autonomous_rss_title_snr_count = 1;
                    }

                    for ($i = 0; $i != $wp_autonomous_rss_title_snr_count; $i++) {

	                    if( isset( $meta['wp_autonomous_rss_title_snr'] ) ) {
		                    $title_search = $wp_autonomous_rss_title_snr['search'][$i];
		                    $title_replace = $wp_autonomous_rss_title_snr['replace'][$i];
	                    } else {
		                    $title_search = '';
		                    $title_replace = '';
	                    }
                        ?>

	                    <div class="wp-autonomous-rss-title-snr wp-autonomous-rss-snr">
                            <div style="display:inline-block">
                                <input type="text" placeholder="Search for..." name="wp_autonomous_rss_title_snr[search][]" value="<?php echo $title_search; ?>"/>
                            </div>
                            <div style="display:inline-block">
                                <input type="text" placeholder="Replace with..." name="wp_autonomous_rss_title_snr[replace][]" value="<?php echo $title_replace; ?>"/>
                                <input type="button" value="Remove" class="button button-primary button-small wp-autonomous-rss-button-red wp-autonomous-rss-button-remove">
                            </div>
                        </div>

                        <?php
                    }

                    ?>
                    <br>
                    <input itype="button" value="Add More" class="button button-primary button-small wp-autonomous-rss-button-add">

                </div>

            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row wp-autonomous-rss-metabox-row-empty"></div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_content_extraction">Content Extraction</label>
                <br>
                <p class="description">
                    Select where the content should get extracted from.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <select class="wp-autonomous-rss-manual-col-3" name="wp_autonomous_rss_content_extraction" id="wp_autonomous_rss_content_extraction">
                    <option value="full" <?php selected($meta['wp_autonomous_rss_content_extraction'][0], 'full'); ?>>
                        Full Content
                    </option>
                    <option value="summary" <?php selected($meta['wp_autonomous_rss_content_extraction'][0], 'summary'); ?>>
                        Summary
                    </option>
                </select>
            </div>

        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_content_snr">Content Search & Replace</label>
                <br>
                <p class="description">
                    Replace or remove words in the content.<br>
                    Leave replace field empty to remove a word.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <div class="wp-autonomous-rss-clone-wrap">
				    <?php

				    if( isset( $meta['wp_autonomous_rss_content_snr'] ) ) {
					    $wp_autonomous_rss_content_snr = unserialize( $meta['wp_autonomous_rss_content_snr'][0] );
					    $wp_autonomous_rss_content_snr_count = count( $wp_autonomous_rss_content_snr['search'] );
				    } else {
					    $wp_autonomous_rss_content_snr = '';
					    $wp_autonomous_rss_content_snr_count = 1;
				    }

				    for ($i = 0; $i != $wp_autonomous_rss_content_snr_count; $i++) {

					    if( isset( $meta['wp_autonomous_rss_content_snr'] ) ) {
						    $content_search = $wp_autonomous_rss_content_snr['search'][$i];
						    $content_replace = $wp_autonomous_rss_content_snr['replace'][$i];
					    } else {
						    $content_search = '';
						    $content_replace = '';
					    }
					    ?>

                        <div class="wp-autonomous-rss-content-snr wp-autonomous-rss-snr">
                            <div style="display:inline-block">
                                <input type="text" placeholder="Search for..." name="wp_autonomous_rss_content_snr[search][]" value="<?php echo $content_search; ?>"/>
                            </div>
                            <div style="display:inline-block">
                                <input type="text" placeholder="Replace with..." name="wp_autonomous_rss_content_snr[replace][]" value="<?php echo $content_replace; ?>"/>
                                <input type="button" value="Remove" class="button button-primary button-small wp-autonomous-rss-button-red wp-autonomous-rss-button-remove">
                            </div>
                        </div>

					    <?php
				    }

				    ?>
                    <br>
                    <input itype="button" value="Add More" class="button button-primary button-small wp-autonomous-rss-button-add">

                </div>

            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_content_remove_sections_toggle">Content Remove Sections</label>
                <p class="description">
                    Strip sections from content using ID or CSS class.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input class="wp-autonomous-rss-toggle-col-3" type="checkbox" name="wp_autonomous_rss_content_remove_sections_toggle" id="wp_autonomous_rss_content_remove_sections_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_content_remove_sections_toggle'])) checked($meta['wp_autonomous_rss_content_remove_sections_toggle'][0], 'yes'); ?> />
            </div>
            <div class="wp-autonomous-rss-metabox-col-3">
                <textarea rows="4" cols="50" name="wp_autonomous_rss_content_remove_sections" id="wp_autonomous_rss_content_remove_sections"><?php if (isset ($meta['wp_autonomous_rss_content_remove_sections'])) echo $meta['wp_autonomous_rss_content_remove_sections'][0]; ?></textarea>
                <br>
                <p class="description">
                    Remove multiple sections by creating several rules separated by new line.<br>
                    Enter ID or CSS class (Example: #elementID or .css-class)
                </p>
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_content_remove_links">Content Remove Links</label>
                <p class="description">
                    Remove all links from the content.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_content_remove_links" id="wp_autonomous_rss_content_remove_links" value="yes" <?php if (isset ($meta['wp_autonomous_rss_content_remove_links'])) checked($meta['wp_autonomous_rss_content_remove_links'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_content_remove_copyright">Remove Copyright Notice</label>
                <p class="description">
                    By default a copyright notice with a link<br> to the original source will be displayed.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_content_remove_copyright" id="wp_autonomous_rss_content_remove_copyright" value="yes" <?php if (isset ($meta['wp_autonomous_rss_content_remove_copyright'])) checked($meta['wp_autonomous_rss_content_remove_copyright'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row wp-autonomous-rss-metabox-row-empty"></div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_featured_image_extraction">Featured Image Extraction</label>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <select name="wp_autonomous_rss_featured_image_extraction" id="wp_autonomous_rss_featured_image_extraction">
                    <option value="ogimage" <?php selected($meta['wp_autonomous_rss_featured_image_extraction'][0], 'ogimage'); ?>>
                        From og:image
                    </option>
                    <option value="first" <?php selected($meta['wp_autonomous_rss_featured_image_extraction'][0], 'first'); ?>>
						First image in content
					</option>
					<option value="feed" <?php selected($meta['wp_autonomous_rss_featured_image_extraction'][0], 'feed'); ?>>
						Feed Thumbnail
					</option>
                </select>
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_featured_image_snr">Featured Image Search & Replace</label>
                <br>
                <p class="description">
                    Replace/remove words in the url of the featured image.<br>
                    Leave replace field empty to remove a word.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <div class="wp-autonomous-rss-clone-wrap">
				    <?php

				    if( isset( $meta['wp_autonomous_rss_featured_image_snr'] ) ) {
					    $wp_autonomous_rss_featured_image_snr = unserialize( $meta['wp_autonomous_rss_featured_image_snr'][0] );
					    $wp_autonomous_rss_featured_image_snr_count = count( $wp_autonomous_rss_featured_image_snr['search'] );
				    } else {
					    $wp_autonomous_rss_featured_image_snr = '';
					    $wp_autonomous_rss_featured_image_snr_count = 1;
				    }

				    for ($i = 0; $i != $wp_autonomous_rss_featured_image_snr_count; $i++) {

					    if( isset( $meta['wp_autonomous_rss_featured_image_snr'] ) ) {
						    $featured_image_search = $wp_autonomous_rss_featured_image_snr['search'][$i];
						    $featured_image_replace = $wp_autonomous_rss_featured_image_snr['replace'][$i];
					    } else {
						    $featured_image_search = '';
						    $featured_image_replace = '';
					    }
					    ?>

                        <div class="wp-autonomous-rss-featured-image-snr wp-autonomous-rss-snr">
                            <div style="display:inline-block">
                                <input type="text" placeholder="Search for..." name="wp_autonomous_rss_featured_image_snr[search][]" value="<?php echo $featured_image_search; ?>"/>
                            </div>
                            <div style="display:inline-block">
                                <input type="text" placeholder="Replace with..." name="wp_autonomous_rss_featured_image_snr[replace][]" value="<?php echo $featured_image_replace; ?>"/>
                                <input type="button" value="Remove" class="button button-primary button-small wp-autonomous-rss-button-red wp-autonomous-rss-button-remove">
                            </div>
                        </div>

					    <?php
				    }

				    ?>
                    <br>
                    <input itype="button" value="Add More" class="button button-primary button-small wp-autonomous-rss-button-add">

                </div>

            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_featured_image_remove_duplicate">Keep Featured Image In Content</label>
                <p class="description">
                    By default, if the featured image is also inside<br> the content, it is removed from the article content,<br> to avoid duplicate images.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_featured_image_remove_duplicate" id="wp_autonomous_rss_featured_image_remove_duplicate"
                       value="yes" <?php if (isset ($meta['wp_autonomous_rss_featured_image_remove_duplicate'])) checked($meta['wp_autonomous_rss_featured_image_remove_duplicate'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_download_images">Content Image Download</label>
                <p class="description">
                    Download all images from the article, to this server.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_download_images" id="wp_autonomous_rss_download_images"
                       value="yes" <?php if (isset ($meta['wp_autonomous_rss_download_images'])) checked($meta['wp_autonomous_rss_download_images'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_lazy_image_toggle">Content Image Lazy Loading Attribute</label>
                <p class="description">
                    Enter the attribute of images that use lazy loading.<br>
                    Default: data-src
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" class="wp-autonomous-rss-toggle-col-3" name="wp_autonomous_rss_lazy_image_toggle" id="wp_autonomous_rss_lazy_image_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_lazy_image_toggle'])) checked($meta['wp_autonomous_rss_lazy_image_toggle'][0], 'yes'); ?> />
            </div>

            <div class="wp-autonomous-rss-metabox-col-3">
                <input type="text" name="wp_autonomous_rss_lazy_image" id="wp_autonomous_rss_lazy_image" value="<?php
                if (isset ($meta['wp_autonomous_rss_lazy_image'])) {
	                echo $meta['wp_autonomous_rss_lazy_image'][0];
                } else {
                    echo 'data-src';
                }
                ?>"/>
            </div>
        </div>

		<div class="wp-autonomous-rss-metabox-row">
			<div class="wp-autonomous-rss-metabox-col-1">
				<label for="wp_autonomous_rss_skip_image_url_toggle">Remove Image Based On File Name</label>
				<p class="description">
					Remove an image if it contains a certain <br>url or file name.
					<br><br>This applies to the feature image <br>and all content images.
				</p>
			</div>
			<div class="wp-autonomous-rss-metabox-col-2">
				<input class="wp-autonomous-rss-toggle-col-3" type="checkbox" name="wp_autonomous_rss_skip_image_url_toggle" id="wp_autonomous_rss_skip_image_url_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_skip_image_url_toggle'])) checked($meta['wp_autonomous_rss_skip_image_url_toggle'][0], 'yes'); ?> />
			</div>
			<div class="wp-autonomous-rss-metabox-col-3">
				<textarea rows="4" cols="50" name="wp_autonomous_rss_skip_image_url" id="wp_autonomous_rss_skip_image_url"><?php if (isset ($meta['wp_autonomous_rss_skip_image_url'])) echo $meta['wp_autonomous_rss_skip_image_url'][0]; ?></textarea>
				<br>
				<p class="description">
					Enter either the full image url or a partial match, such as the file name.<br>
					Use multiple urls/file names, separated by new lines.
				</p>
			</div>
		</div>

        <div class="wp-autonomous-rss-metabox-row wp-autonomous-rss-metabox-row-empty"></div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label>Posts Per Interval</label>
                <br>
                <p class="description">
                    The amount of posts that will be created<br>per interval per feed.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <select name="wp_autonomous_rss_posts_per_interval" id="wp_autonomous_rss_posts_per_interval">
				    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php selected($meta['wp_autonomous_rss_posts_per_interval'][0], $i); ?>><?php echo $i; ?></option>
				    <?php } ?>
                    <option value="all" <?php selected($meta['wp_autonomous_rss_posts_per_interval'][0], 'all'); ?>>All Available</option>
                </select>

            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_rotate">Rotate Feeds</label>
                <br>
                <p class="description">
                    When using multiple feeds,<br>
                    rotate feeds or use all feeds each interval.
                </p>
            </div>

            <div class="wp-autonomous-rss-metabox-col-2">
                <select name="wp_autonomous_rss_rotate" id="wp_autonomous_rss_rotate">
                    <option value="on" <?php selected($meta['wp_autonomous_rss_rotate'][0], 'on'); ?>>
                        Rotate feeds to post from a different feed each interval
                    </option>
                    <option value="off" <?php selected($meta['wp_autonomous_rss_rotate'][0], 'off'); ?>>
                        Post from all feeds each interval
                    </option>
                </select>
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row wp-autonomous-rss-metabox-row-empty"></div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_post_time">Date & Time</label>
                <p class="description">
                    Date & Time used for the article.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <select name="wp_autonomous_rss_post_time" id="wp_autonomous_rss_post_time">
                    <option value="original" <?php selected($meta['wp_autonomous_rss_post_time'][0], 'original'); ?>>Use original time</option>
                    <option value="current" <?php selected($meta['wp_autonomous_rss_post_time'][0], 'current'); ?>>Use current time</option>
                </select>
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_categories_original">Use Original Categories</label>
                <p class="description">
                    If categories are found in the feed,<br>
                    they will be assigned to the article.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_categories_original" id="wp_autonomous_rss_categories_original" value="yes" <?php if (isset ($meta['wp_autonomous_rss_categories_original'])) checked($meta['wp_autonomous_rss_categories_original'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row wp-autonomous-rss-metabox-row-empty"></div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_skip_images">Skip Posts Without Images</label>
                <p class="description">
                    Skip posts if no image is found in the feed,<br>
                    og:image tag or content.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input type="checkbox" name="wp_autonomous_rss_skip_images" id="wp_autonomous_rss_skip_images" value="yes" <?php if (isset ($meta['wp_autonomous_rss_skip_images'])) checked($meta['wp_autonomous_rss_skip_images'][0], 'yes'); ?> />
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_skip_title_toggle">Skip Posts If Title Contains Specific Words</label>
                <p class="description">

                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input class="wp-autonomous-rss-toggle-col-3" type="checkbox" name="wp_autonomous_rss_skip_title_toggle" id="wp_autonomous_rss_skip_title_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_skip_title_toggle'])) checked($meta['wp_autonomous_rss_skip_title_toggle'][0], 'yes'); ?> />
            </div>
            <div class="wp-autonomous-rss-metabox-col-3">
                <textarea rows="4" cols="50" name="wp_autonomous_rss_skip_title" id="wp_autonomous_rss_skip_title"><?php if (isset ($meta['wp_autonomous_rss_skip_title'])) echo $meta['wp_autonomous_rss_skip_title'][0]; ?></textarea>
                <br>
                <p class="description">
                    Enter multiple words, separated by new line.
                </p>
            </div>
        </div>

        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_skip_content_toggle">Skip Posts If Content Contains Specific Words</label>
                <p class="description">

                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input class="wp-autonomous-rss-toggle-col-3" type="checkbox" name="wp_autonomous_rss_skip_content_toggle" id="wp_autonomous_rss_skip_content_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_skip_content_toggle'])) checked($meta['wp_autonomous_rss_skip_content_toggle'][0], 'yes'); ?> />
            </div>
            <div class="wp-autonomous-rss-metabox-col-3">
                <textarea rows="4" cols="50" name="wp_autonomous_rss_skip_content" id="wp_autonomous_rss_skip_content"><?php if (isset ($meta['wp_autonomous_rss_skip_content'])) echo $meta['wp_autonomous_rss_skip_content'][0]; ?></textarea>
                <br>
                <p class="description">
                    Enter multiple words, separated by new line.
                </p>
            </div>
        </div>


        <div class="wp-autonomous-rss-metabox-row">
            <div class="wp-autonomous-rss-metabox-col-1">
                <label for="wp_autonomous_rss_skip_length_toggle">Skip Posts Based on Length</label>
                <p class="description">
                    Skip posts if they are shorter than<br>
                    a specific amount of words.
                </p>
            </div>
            <div class="wp-autonomous-rss-metabox-col-2">
                <input class="wp-autonomous-rss-toggle-col-3" type="checkbox" name="wp_autonomous_rss_skip_length_toggle" id="wp_autonomous_rss_skip_length_toggle" value="yes" <?php if (isset ($meta['wp_autonomous_rss_skip_length_toggle'])) checked($meta['wp_autonomous_rss_skip_length_toggle'][0], 'yes'); ?> />
            </div>
            <div class="wp-autonomous-rss-metabox-col-3">




                <div style="margin:0 20px;width:150px;display:inline-block;" id="wp_autonomous_rss_skip_length_value_slider"></div>
                <input type="text" name="wp_autonomous_rss_skip_length_value" id="wp_autonomous_rss_skip_length_value" readonly style="display:inline-block;border:0;width:50px" value="<?php
                if ( isset ($meta['wp_autonomous_rss_skip_length_value']) ) {
                    echo $meta['wp_autonomous_rss_skip_length_value'][0];
                } else {
	                echo '0';
                }
                ?>"> Words
            </div>

        </div>


    </div>

    <?php
}
/**
 * Meta Box Delete Posts
 */
function wp_autonomous_rss_meta_box_delete_fields( $post ) {
	?>
	<div class="wp-autonomous-rss-metabox-delete">
		<p>Delete All Posts Created By This Campaign. This cannot be undone.</p>
        <label for="wp_autonomous_rss_delete_posts_confirm">Confirm delete &nbsp;</label>
        <input type="checkbox" name="wp_autonomous_rss_delete_posts_confirm" id="wp_autonomous_rss_delete_posts_confirm" value="yes" />
<br><br>
        <input id="wp_autonomous_rss_delete_posts_submit" type="button" value="Delete All Posts" class="button button-primary button-large wp-autonomous-rss-button-red">
		<div id="wp_autonomous_rss_delete_posts_response"></div>
	</div>
	<?php
}


/**
 * Meta Box Latest Posts
 */
function wp_autonomous_rss_meta_box_posts_fields( $post ) {

	//$meta = get_post_meta( $post->ID );

	$campaign_id = $post->ID;
	echo '<div class="wp-autonomous-rss-metabox-latest-posts">';

	$args = array(
		'numberposts' => 10,
		//'posts_per_page'=> 10,
		'post_type'   => 'post',
		'meta_key'   => 'wpa_rss_campaign_id',
		'meta_value' => $campaign_id
		//'post_status' => 'publish'
	);

	//$query = new WP_Query( $args );
	$posts_array = get_posts( $args );
	echo '<ul>';
	if ( $posts_array ) {


		//while ( $posts_array->have_posts() ) {
		foreach ( $posts_array as $item ) {

			//$posts_array->the_post();
			//$campaign_id = get_the_ID();
			//$meta = get_post_meta( $campaign_id );
			//$interval_number = $meta['wp_autonomous_rss_interval_number'][0];

			$item_id = $item->ID;
			//$post_id = $post->ID;
			$permalink = get_permalink($item_id);
			$title = get_the_title($item_id);

			echo '<li><a href="' . $permalink . '" target="_blank">' . $title . '</a> <a href="' . get_edit_post_link($item_id) . '" target="_blank">[Edit]</a></li>';
		}

		/* Restore original Post Data */
		wp_reset_postdata();

	} else {
		echo '<li class="wp-autonomous-rss-metabox-latest-posts-empty">No posts yet</li>';
	}
	//wp_reset_query();
	echo '</ul>';

	echo '</div>';

}


/**
 * Meta Box Stats
 */
function wp_autonomous_rss_meta_box_stats_fields( $post ) {

	$meta = get_post_meta( $post->ID );
	if ( isset ( $meta['wp_autonomous_rss_stats_last_run'] ) ) {
		//$last_run = date("j M Y - H:i", $meta['wp_autonomous_rss_stats_last_run'][0]);
		$last_run = wp_autonomous_rss_time_elapsed( '@' . $meta['wp_autonomous_rss_stats_last_run'][0] );
	} else {
		$last_run = 'Never';
	}

	$query = get_posts(array(
		'numberposts' => -1,
		'meta_key'   => 'wpa_rss_campaign_id',
		'meta_value' => $post->ID
	));

	?>
	<div class="wp-autonomous-rss-metabox-stats">
		<p id="wp_autonomous_rss_stats_last_run">Last Automatic Run: <?php echo $last_run; ?></p>
		<p id="wp_autonomous_rss_stats_posts_created">Total Posts Created: <span id="wp_autonomous_rss_stats_posts_created_count"><?php echo count($query); ?></span></p>
	</div>
	<?php
}

/**
 * Save Meta Box Option Fields
 */
function wp_autonomous_rss_save_meta_box( $post_id ) {
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'wp_autonomous_rss_meta_box_option_fields_nonce' ] ) && wp_verify_nonce( $_POST[ 'wp_autonomous_rss_meta_box_option_fields_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	if ( get_post_type( $post_id ) != 'wpa_rss' ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'wp_autonomous_rss_interval_number' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_interval_number', sanitize_text_field( $_POST[ 'wp_autonomous_rss_interval_number' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_interval_unit' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_interval_unit', sanitize_text_field( $_POST[ 'wp_autonomous_rss_interval_unit' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_feed' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_feed', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_feed' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_featured_image_status' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_featured_image_status', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_featured_image_status' ] ) );
	}

}
add_action( 'save_post', 'wp_autonomous_rss_save_meta_box' );

/**
 * Save Meta Box Advanced Option Fields
 */
function wp_autonomous_rss_save_meta_box_advanced( $post_id ) {
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'wp_autonomous_rss_meta_box_advanced_option_fields_nonce' ] ) && wp_verify_nonce( $_POST[ 'wp_autonomous_rss_meta_box_advanced_option_fields_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	if ( get_post_type( $post_id ) != 'wpa_rss' ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
//	if( isset( $_POST[ 'wp_autonomous_rss_title_extraction' ] ) ) {
//		update_post_meta( $post_id, 'wp_autonomous_rss_title_extraction', sanitize_text_field( $_POST[ 'wp_autonomous_rss_title_extraction' ] ) );
//	}

//	if( isset( $_POST[ 'wp_autonomous_rss_title_extraction_manual' ] ) ) {
//		update_post_meta( $post_id, 'wp_autonomous_rss_title_extraction_manual', sanitize_text_field( $_POST[ 'wp_autonomous_rss_title_extraction_manual' ] ) );
//	}

    if( isset( $_POST[ 'wp_autonomous_rss_title_snr' ] ) ) {
	    update_post_meta( $post_id, 'wp_autonomous_rss_title_snr', $_POST[ 'wp_autonomous_rss_title_snr' ] );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_extraction' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_extraction', sanitize_text_field( $_POST[ 'wp_autonomous_rss_content_extraction' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_snr' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_snr', $_POST[ 'wp_autonomous_rss_content_snr' ] );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_remove_sections_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_sections_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_content_remove_sections_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_sections_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_remove_sections' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_sections', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_content_remove_sections' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_remove_links' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_links', sanitize_text_field( $_POST[ 'wp_autonomous_rss_content_remove_links' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_links', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_content_remove_copyright' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_copyright', sanitize_text_field( $_POST[ 'wp_autonomous_rss_content_remove_copyright' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_content_remove_copyright', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_featured_image_extraction' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_featured_image_extraction', sanitize_text_field( $_POST[ 'wp_autonomous_rss_featured_image_extraction' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_featured_image_snr' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_featured_image_snr', $_POST[ 'wp_autonomous_rss_featured_image_snr' ] );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_featured_image_remove_duplicate' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_featured_image_remove_duplicate', sanitize_text_field( $_POST[ 'wp_autonomous_rss_featured_image_remove_duplicate' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_featured_image_remove_duplicate', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_download_images' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_download_images', sanitize_text_field( $_POST[ 'wp_autonomous_rss_download_images' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_download_images', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_lazy_image_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_lazy_image_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_lazy_image_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_lazy_image_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_lazy_image' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_lazy_image', sanitize_text_field( $_POST[ 'wp_autonomous_rss_lazy_image' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_image_url_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_image_url_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_image_url_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_image_url_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_image_url' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_image_url', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_skip_image_url' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_posts_per_interval' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_posts_per_interval', sanitize_text_field( $_POST[ 'wp_autonomous_rss_posts_per_interval' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_rotate' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_rotate', sanitize_text_field( $_POST[ 'wp_autonomous_rss_rotate' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_post_time' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_post_time', sanitize_text_field( $_POST[ 'wp_autonomous_rss_post_time' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_categories_original' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_categories_original', sanitize_text_field( $_POST[ 'wp_autonomous_rss_categories_original' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_categories_original', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_images' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_images', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_images' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_images', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_title_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_title_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_title_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_title_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_title' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_title', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_skip_title' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_content_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_content_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_content_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_content_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_content' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_content', sanitize_textarea_field( $_POST[ 'wp_autonomous_rss_skip_content' ] ) );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_length_toggle' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_length_toggle', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_length_toggle' ] ) );
	} else {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_length_toggle', '' );
	}

	if( isset( $_POST[ 'wp_autonomous_rss_skip_length_value' ] ) ) {
		update_post_meta( $post_id, 'wp_autonomous_rss_skip_length_value', sanitize_text_field( $_POST[ 'wp_autonomous_rss_skip_length_value' ] ) );
	}

}
add_action( 'save_post', 'wp_autonomous_rss_save_meta_box_advanced' );

// code from: https://pageconfig.com/post/checking-multidimensional-arrays-in-php
function wp_autonomous_rss_is_multi_array( $arr ) {
	rsort( $arr );
	return isset( $arr[0] ) && is_array( $arr[0] );
}

function wp_autonomous_rss_get_rss_list( $is_cron = false, $feed ) {

//	if( ! $is_cron ) {
//		$campaign_id = intval( $_POST['campaign_id'] );
//	}
//
//	$meta = get_post_meta( $campaign_id );

//	$feeds = $meta['wp_autonomous_rss_feed'][0];
//	$feed_array = preg_split('/\n|\r/', $feeds, -1, PREG_SPLIT_NO_EMPTY);
//	$feed_rotate_queue = $meta['wp_autonomous_rss_feed_rotate_queue'][0];
//
//	if( ! isset ( $meta['wp_autonomous_rss_feed_rotate_queue'] ) ) {
//		update_post_meta( $campaign_id, 'wp_autonomous_rss_feed_rotate_queue', '0' );
//		$feed_rotate_queue = '0';
//	}
//
//	if( $feed_rotate_queue > (count( $feed_array ) - 1) ) {
//		update_post_meta( $campaign_id, 'wp_autonomous_rss_feed_rotate_queue', '0' );
//		$feed_rotate_queue = '0';
//	}
//
//	$feed = $feed_array[$feed_rotate_queue];

	//if ( get_post_status( $campaign_id ) == 'publish' ) {

		$json = json_decode( wp_autonomous_rss_call_wpa( $feed, $api='feed' ), true );
		$items = $json['rss']['channel']['item'];

		//echo $item['guid'];
		//var_dump($items);
		$output = '';

		if( $items ) {

			// If RSS feed returns 1 item, it will not be in an array. Add item to array to be able to run it through 'foreach'.
			//if( count($items) == count($items, COUNT_RECURSIVE) ) {
			//if( !wp_autonomous_rss_is_multi_array($items) ) {
			if( $items['title'] ) {
				//echo 'is not multidimensional. ';
                $items = array($items);
			}

			//$items = array($items);
			//var_dump($items);
			//foreach( $items as $item ) {
			//	$output[]['guid'] = $item['guid'];
                //echo $item['guid'].'<br>';
			//}

            $output = $items;

		}

//	} else {
//
//		$output = 'Error adding article: Campaign has not yet been published. Please publish the campaign and then try again.';
//
//	}

	if( ! $is_cron ) {

		wp_send_json( $output );

	} else {

		return $output;

	}

}
//add_action( 'wp_ajax_wp_autonomous_rss_get_rss_list', 'wp_autonomous_rss_get_rss_list' );


/**
 * Add article from RSS feed
 */
function wp_autonomous_rss_add_article( $campaign_id, $feeds, $is_cron = false ) {

	global $wpdb;

	if ( ! is_admin() ) {
		require_once( ABSPATH . 'wp-admin/includes/post.php' );
		require_once( ABSPATH . 'wp-admin/includes/taxonomy.php');
	}

	//spl_autoload_register('autoload');
	//require_once plugin_dir_path( dirname( __FILE__ ) ) .'lib/html5php/autoloader.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/html5php/autoloader.php';


	$output = '';

	if( isset( $_POST['campaign_id'] ) ) {
		$campaign_id = intval( $_POST['campaign_id'] );
    }

    if( isset ( $_POST['$feeds'] ) ) {
	    $feeds = $_POST['$feeds'];
    }

	$meta = get_post_meta( $campaign_id );
	//$interval_number = $meta['wp_autonomous_rss_interval_number'][0];
	//$interval_unit = $meta['wp_autonomous_rss_interval_unit'][0];
	//$feed = $meta['wp_autonomous_rss_feed'][0];
	$featured_image_status = $meta['wp_autonomous_rss_featured_image_status'][0];
	//$title_extraction = $meta['wp_autonomous_rss_title_extraction'][0];
	//$title_extraction_manual = $meta['wp_autonomous_rss_title_extraction_manual'][0];
	$title_snr = $meta['wp_autonomous_rss_title_snr'][0];
	$content_extraction = $meta['wp_autonomous_rss_content_extraction'][0];
	//$content_extraction_manual = $meta['wp_autonomous_rss_content_extraction_manual'][0];
	$content_snr = $meta['wp_autonomous_rss_content_snr'][0];
	//$content_remove_sections = $meta['wp_autonomous_rss_content_remove_sections'][0];
	//$content_remove_scripts = $meta['wp_autonomous_rss_content_remove_scripts'][0];
	$content_remove_links = $meta['wp_autonomous_rss_content_remove_links'][0];
	$featured_image_extraction = $meta['wp_autonomous_rss_featured_image_extraction'][0];
	$featured_image_remove_duplicate = $meta['wp_autonomous_rss_featured_image_remove_duplicate'][0];
	$featured_image_snr = $meta['wp_autonomous_rss_featured_image_snr'][0];
	$download_images = $meta['wp_autonomous_rss_download_images'][0];
	$lazy_image_toggle = $meta['wp_autonomous_rss_lazy_image_toggle'][0];
	$lazy_image = $meta['wp_autonomous_rss_lazy_image'][0];
	$skip_image_url_toggle = $meta['wp_autonomous_rss_skip_image_url_toggle'][0];
	$skip_image_url = $meta['wp_autonomous_rss_skip_image_url'][0];
	$posts_per_interval = $meta['wp_autonomous_rss_posts_per_interval'][0];
	$rotate = $meta['wp_autonomous_rss_rotate'][0];
	//$post_time = $meta['wp_autonomous_rss_post_time'][0];
	$categories_original = $meta['wp_autonomous_rss_categories_original'][0];
	$skip_images = $meta['wp_autonomous_rss_skip_images'][0];
	$skip_title_toggle = $meta['wp_autonomous_rss_skip_title_toggle'][0];
	$skip_title = $meta['wp_autonomous_rss_skip_title'][0];
	$skip_content_toggle = $meta['wp_autonomous_rss_skip_content_toggle'][0];
	$skip_content = $meta['wp_autonomous_rss_skip_content'][0];
	$skip_length_toggle = $meta['wp_autonomous_rss_skip_length_toggle'][0];
	$skip_length_value = $meta['wp_autonomous_rss_skip_length_value'][0];
	//$skip_length_unit = $meta['wp_autonomous_rss_skip_length_unit'][0];

	$title_snr = unserialize( $title_snr );
	$title_search = $title_snr['search'];
	$title_replace = $title_snr['replace'];

	$featured_image_snr = unserialize( $featured_image_snr );
	$featured_image_search = $featured_image_snr['search'];
	$featured_image_replace = $featured_image_snr['replace'];

	$content_snr = unserialize( $content_snr );
	$content_search = $content_snr['search'];
	$content_replace = $content_snr['replace'];

    $x = 0;

   // print_r($feeds);
    foreach( $feeds as $feed ) {

    	//echo $feed['link'];
	    $results = $wpdb->get_results( "select * from $wpdb->postmeta where meta_key = 'wpa_rss_article_link' AND meta_value = '" . $feed['link'] . "'" );

	    if ( empty( $results ) ) {

	        //echo 'good';
		    //$article = json_decode( wp_autonomous_rss_get_wpa_article( $feed ), true);

		    if ( $feed['title'] != "" ) {



                $article = json_decode( wp_autonomous_rss_getArticle( $feed['link'] ), true );
				$article = $article['rss']['channel']['item'];

			    // Get title
				//$title = $feed['title'];
                $title = strip_tags( $feed['title'] );
                $title = html_entity_decode( $title, ENT_QUOTES | ENT_HTML5 );
                $title = str_replace( '&apos;', "'", $title );

                if( post_exists( $title ) ) {
                	continue;
				}

			    // Title Search & Replace
			    $title = str_replace( $title_search, $title_replace, $title );

			    // Get content
			    if( $content_extraction == 'full' ) {
				    $content = $article['description'];
			    } else {
				    $content = $feed['summary'];
				}
				
			
			    // Skip post if content is empty
                if ( $content == '' ) {
	                continue;
                }

			    // Content Search & Replace
			    $content = str_replace( $content_search, $content_replace, $content );
				
			    // Skip post if short than specific length
                if( $skip_length_toggle == 'yes' && str_word_count( strip_tags($content) ) < $skip_length_value ) {
	                continue;
                }

                // Skip post if title contains specific words
                if( $skip_title_toggle == 'yes' ) {

                    $skip_title_array = preg_split('/\n|\r/', $skip_title, -1, PREG_SPLIT_NO_EMPTY);

	                if ( wpa_rss_strposa( $title, $skip_title_array ) !== false) {
		                continue;
	                }
                }

			    // Skip post if content contains specific words
			    if( $skip_content_toggle == 'yes' ) {

				    $skip_content_array = preg_split('/\n|\r/', $skip_content, -1, PREG_SPLIT_NO_EMPTY);

				    if ( wpa_rss_strposa( $content, $skip_content_array ) !== false) {
					    continue;
				    }
			    }

			    // Lazy Image replacement
                if( $lazy_image_toggle == 'yes' && !empty( $lazy_image ) && $content_extraction == 'full' ) {


	                $html5 = new Masterminds\HTML5(array('disable_html_ns' => true));
	                //$dom = $html5->loadHTML($content);
	                $dom = $html5->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

	                $img_found = $dom->getElementsByTagName( 'img' );

	                if( $img_found ) {
		                foreach ( $img_found as $img ) {

			                $lazy_manual = $img->getAttribute( $lazy_image );

			                if( $lazy_manual ){
				                $img->setAttribute( 'src', $lazy_manual );
				                utf8_decode( $dom->saveHTML( $dom->documentElement ) );
			                }
		                }
		                //$content = utf8_decode( $dom->saveHTML( $dom->documentElement ) );
		                $content = $dom->saveHTML( $dom->documentElement );

		                //removing html and body tags that were set by the html5 parser
		                $content = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $content);
					}

                }
				//echo 'Test: ' . $content;
			    // Get Skip image urls/file names
			    $skip_image_url_array = preg_split('/\n|\r/', $skip_image_url, -1, PREG_SPLIT_NO_EMPTY);

                if( $skip_image_url_toggle == 'yes' ) {
	                // Get all IMG urls in $all_content_images[1]
	                preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $all_content_images);

	                // Remove 'Skip Images' From Content
	                foreach( $all_content_images[1] as $image_single_item ){

		                if( wp_autonomous_rss_find ( $image_single_item, $skip_image_url_array) ) {
			                $content = preg_replace("/<img[^>]+src=\"" . preg_quote( $image_single_item, '/' ) . "\"[^>]*\>/i", "", $content );
		                }

		                if( wp_autonomous_rss_find ( html_entity_decode( $image_single_item ), $skip_image_url_array) ) {
			                $content = preg_replace("/<img[^>]+src=\"" . preg_quote( $image_single_item, '/') . "\"[^>]*\>/i", "", $content );
		                }

	                }
				}


				// get og:image and compare with "remove image" array
			    if( isset( $article['og_image'] ) ) {

			    	if( wp_autonomous_rss_find( $article['og_image'], $skip_image_url_array ) ) {
					    $og_image = false;
					} else {
					    $og_image = $article['og_image'];
					}

				} else {
			    	$og_image = false;
				}

			    // get feed thumbnail and compare with "remove image" array
			    if( isset( $feed['image'] ) ) {

				    if( wp_autonomous_rss_find( $feed['image'], $skip_image_url_array ) ) {
					    $feed_image = false;
				    } else {
					    $feed_image = $feed['image'];
				    }

			    } else {
				    $feed_image = false;
			    }


			    // Find first image in content. No need to compare with "remove image" array, as it was already removed previously/
			    $find_first_image_found = preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $first_image_found);
			    if( $find_first_image_found == '1') {
				    $first_image = $first_image_found[1];
				} else {
				    $first_image = false;
				}


				// Set featured image
			    if( $featured_image_extraction == 'ogimage' ) {

					if( $og_image ) {
						$featured_image_url = $og_image;
					} elseif( $first_image ) {
						$featured_image_url = $first_image;
					} elseif( $feed_image ) {
						$featured_image_url = $feed_image;
					} else {
						$featured_image_url = false;
					}


				} elseif( $featured_image_extraction == 'first' ) {

				    if( $first_image ) {
					    $featured_image_url = $first_image;
				    } elseif( $og_image ) {
					    $featured_image_url = $og_image;
				    } elseif( $feed_image ) {
					    $featured_image_url = $feed_image;
				    } else {
					    $featured_image_url = false;
				    }

				} elseif( $featured_image_extraction == 'feed' ) {

					if( $feed_image ) {
						$featured_image_url = $feed_image;
					} elseif( $first_image ) {
					    $featured_image_url = $first_image;
				    } elseif( $og_image ) {
					    $featured_image_url = $og_image;
				    } else {
					    $featured_image_url = false;
				    }

			    } else {
				    $featured_image_url = false;

				}


                // Featured image search & replace
                if( !empty( $featured_image_url ) ) {
	                $featured_image_url = str_replace( $featured_image_search, $featured_image_replace, $featured_image_url );
                }


			    // Featured image status (if is set download featured image, function is below, after adding the post to get PostID)
			    if ( $featured_image_status == 'external' && !empty( $featured_image_url ) ) {
				    $featured_image_use = 'yes';
				    $featured_image_url_nelio = $featured_image_url;

			    } else {
				    $featured_image_use = 'no';
				    $featured_image_url_nelio = false;
			    }



			    // Remove Featured Image From Content
			    if ( $featured_image_remove_duplicate != 'yes' && $featured_image_url == true ) {
				    $content = preg_replace("/<img[^>]+src=\"" . preg_quote( $featured_image_url, '/' ) . "\"[^>]*\>/i", "", $content );
				    $content = preg_replace("/<img[^>]+src=\"" . preg_quote( htmlentities($featured_image_url ), '/') . "\"[^>]*\>/i", "", $content );
			    }


			    // Content strip links
                if ( $content_remove_links == 'yes' ) {
                    $content = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
                }


			    // Skip if no image is found
			    if( $skip_images == 'yes' && !preg_match('/<img/', $content) && !$featured_image_url ) {
				    continue;
			    }

			    // Download all images to server
			    if( $download_images == 'yes' ) {

				    preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $image_external_urls);

				    $local_image_url = array();

				    foreach( $image_external_urls[1] as $img_dl_src ) {
					    $image_attachment_id = wp_autonomous_rss_download_image( $img_dl_src, 0 );
					    $local_image_url[] = wp_get_attachment_url( $image_attachment_id );
				    }

				    $content = str_replace( $image_external_urls[1], $local_image_url, $content );
			    }

                // Get post time
                if ( $meta['wp_autonomous_rss_post_time'][0] == 'original' AND $feed['date'] != false ){
                    //$post_time = date( 'Y-m-d H:i:s', strtotime( $feed['pubDate'] ) );
                    $post_time = $feed['date'];
                } else {
                    $post_time = date( 'Y-m-d H:i:s' );
                }

                // Use original categories
                if( $categories_original == 'yes' ) {

	                $cat_id = array();
	                $categories = $feed['categories'];

	                foreach( $categories as $cat_name ) {

	                    if( $cat_name != 'Uncategorized' ) {
		                    $cat_id[] = wp_create_category( $cat_name, 0);
                        }

                    }

	                $category_array = array_merge( $cat_id, wp_get_post_categories( $campaign_id ) );

                } else {
	                $category_array = wp_get_post_categories( $campaign_id );
                }

                $meta_input = array(
                    'wpa_rss_article_link' => $feed['link'],
                    'wpa_rss_campaign_id' => $campaign_id,
                    'external_featured_image' => $featured_image_url,
                    'use_external_featured_image' => $featured_image_use,
                    '_nelioefi_url' => $featured_image_url_nelio,
                );

                $new_post = array(
                    'post_title' => $title,
                    'post_content' => $content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_type' => 'post',
                    'post_date' => $post_time,
                    'post_category' => $category_array,
                    'meta_input' => $meta_input,
                );

                if ($is_cron) {
                    remove_filter('content_save_pre', 'wp_filter_post_kses');
                }
			    //remove_filter('content_save_pre', 'wp_filter_post_kses');
                $new_post_id = wp_insert_post( $new_post );
			   // add_filter('content_save_pre', 'wp_filter_post_kses');

                if ($is_cron) {
                    add_filter('content_save_pre', 'wp_filter_post_kses');
                }

                $permalink = get_permalink( $new_post_id );

			    if ( $featured_image_status == 'download' && !empty( $featured_image_url ) ) {
				    $attach_id = wp_autonomous_rss_download_image( $featured_image_url, $new_post_id );
				    set_post_thumbnail( $new_post_id, $attach_id );
                }




                $output .= '<li><a href="' . $permalink . '" target="_blank">' . $title . '</a> <a href="' . get_edit_post_link($new_post_id) . '" target="_blank">[Edit]</a></li>';

			    $x++;
                if( $x == 1 ) {
                    break;
                }

		    } // end if ( $article[content] != "" )

	    } // end if ( empty( $results ) )

    } // end foreach( $xml->channel->item as $item )

    if( ! $is_cron ){

	    if( $output == '') {
		    $output = 'No new articles found.';
	    }

	    return $output;

	   // wp_die(); // this is required to terminate immediately and return a proper response

    }

}
add_action( 'wp_ajax_wp_autonomous_rss_add_article', 'wp_autonomous_rss_add_article' );

/**
 * Meta Box Manual Posting JavaScript
 */
function wp_autonomous_rss_add_article_manual_ajax() {

    global $pagenow;
	global $post;

	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {
//echo 'lol';
		if ( 'wpa_rss' === $post->post_type ) { ?>

            <script type="text/javascript" >

                jQuery(document).ready(function($) {


                    $( "#wp_autonomous_rss_skip_length_value_slider" ).slider({
                        range: "max",
                        min: 0,
                        max: 2000,
                        step: 10,
                        value: $( "#wp_autonomous_rss_skip_length_value" ).val(),
                        slide: function( event, ui ) {
                            $( "#wp_autonomous_rss_skip_length_value" ).val( ui.value );
                        }
                    });
                    $( "#wp_autonomous_rss_skip_length_value" ).val( $( "#wp_autonomous_rss_skip_length_value_slider" ).slider( "value" ) );

                    $(".wp-autonomous-rss-button-add").click(function(){
                        $(this).siblings( '.wp-autonomous-rss-snr' ).first().clone(true).find("input:text").val("").end().insertAfter( $(this).siblings( '.wp-autonomous-rss-snr' ).last() );
                    });

                    $(".wp-autonomous-rss-button-remove").click(function(){
                        $( this ).parent().parent().remove();
                    });

                    $('.wp-autonomous-rss-manual-col-3').change(function() {
                        if( this.value == 'manual') {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'inline-block' );
                        } else {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'none' );
                        }
                    });

                    $('.wp-autonomous-rss-manual-col-3').each(function() {
                        if( this.value == 'manual') {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'inline-block' );
                        } else {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'none' );
                        }
                    });

                    $('.wp-autonomous-rss-toggle-col-3').each(function(){
                        if(this.checked) {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'inline-block' );
                        } else {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'none' );
                        }
                    });

                    $('.wp-autonomous-rss-toggle-col-3').change(function() {
                        if(this.checked) {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'inline-block' );
                        } else {
                            $(this).parent().next('.wp-autonomous-rss-metabox-col-3').css( 'display', 'none' );
                        }
                    });


                    $('form .wp-autonomous-rss-metabox').on('keyup change', 'input, select, textarea', function(){

                        if( $("#wp_autonomous_rss_manual_change_notice").css('visibility') == 'hidden' ) {

                            $('#wp_autonomous_rss_manual_change_notice').css( {'visibility': 'visible', 'opacity': '1'} );
                        }

                    });


                    //var vid_count = 0;

                    $("#wp_autonomous_rss_manual_submit").click( function(){

                        //console.log('hey');
                        manual_count = $('#wp_autonomous_rss_manual_count').val();
                        success_loop = 0;

                        //declare your function to run AJAX requests
                        function do_ajax() {

                            //check to make sure there are more requests to make
                            if (success_loop < manual_count) {

                                $.ajax( {
                                    url : ajaxurl,
                                    type : 'POST',

                                    data : {
                                        'action': 'wp_autonomous_rss_add_article_trigger',
                                        'campaign_id': <?php echo get_the_ID(); ?>,
                                    },

                                    beforeSend: function() {
                                        if( success_loop == '0' ) {
                                            $('#wp_autonomous_rss_manual_ajax_content').append('<div id="wp_autonomous_rss_manual_ajax_spinner" class="lds-css ng-scope" style="width: 200px; height: 200px;"><div class="lds-spinner" style="100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
                                            $('#wp_autonomous_rss_manual_submit').prop('disabled', true);
                                        }

                                    },

                                    success: function(response) {

                                        // console.log('loop inside: ' + vid_count);
                                        // console.log('response: ' + response);
                                        //vid_count++;

                                        if(response !== 'No new articles found.') {
                                            $('#wp_autonomous_rss_manual_ajax_content ol').append(response);
                                            success_loop++;

                                            var current_count = $('#wp_autonomous_rss_stats_posts_created_count').html();
                                            $('#wp_autonomous_rss_stats_posts_created_count').html( parseInt(current_count) + 1);
                                            $('.wp-autonomous-rss-metabox-latest-posts-empty').remove();
                                            $('.wp-autonomous-rss-metabox-latest-posts ul').append(response);

                                            do_ajax();
                                        } else {
                                            $('#wp_autonomous_rss_manual_ajax_content ol').append('<li>No new articles found.</li>');

                                            $('#wp_autonomous_rss_manual_ajax_spinner').remove();
                                            $('#wp_autonomous_rss_manual_submit').prop('disabled', false);
                                        }

                                        if(success_loop == manual_count) {
                                            $('#wp_autonomous_rss_manual_ajax_spinner').remove();
                                            $('#wp_autonomous_rss_manual_submit').prop('disabled', false);
                                        }

                                    },
                                    error: function() {
                                        $('#wp_autonomous_rss_manual_ajax_content').append('error');
                                        $('#wp_autonomous_rss_manual_ajax_spinner').remove();
                                        $('#wp_autonomous_rss_manual_submit').prop('disabled', false);
                                    }

                                });
                            }
                        }

                        //run the AJAX function for the first time once `document.ready` fires
                        do_ajax();

                    });

                });
            </script>

            <script type="text/javascript" >
                jQuery(document).ready(function($) {

                    $("#wp_autonomous_rss_delete_posts_submit").click( function(){

                        if( $('#wp_autonomous_rss_delete_posts_confirm').is(':checked') ) {
                            $.ajax( {
                                url : ajaxurl,
                                type : 'POST',

                                data : {
                                    'action': 'wp_autonomous_rss_delete_posts',
                                    'postid': <?php echo get_the_ID(); ?>
                                },

                                beforeSend: function() {
                                    $('#wp_autonomous_rss_delete_posts_response').append('<div id="wp_autonomous_rss_delete_posts_ajax_spinner" class="lds-css ng-scope" style="width: 200px; height: 200px;"><div class="lds-spinner" style="100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
                                    $('#wp_autonomous_rss_delete_posts_submit').prop('disabled', true);
                                },
                                success: function(response) {
                                    $('#wp_autonomous_rss_delete_posts_response').append(response);
                                    $('#wp_autonomous_rss_delete_posts_ajax_spinner').remove();
                                    $('#wp_autonomous_rss_delete_posts_submit').prop('disabled', false);
                                    $('#wp_autonomous_rss_stats_posts_created_count').html('0');
                                    $('.wp-autonomous-rss-metabox-latest-posts ul li').remove();
                                    $('.wp-autonomous-rss-metabox-latest-posts ul').append('<li class="wp-autonomous-rss-metabox-latest-posts-empty">No posts yet</li>');

                                },
                                error: function() {
                                    $('#wp_autonomous_rss_delete_posts_response').append('error');
                                    $('#wp_autonomous_rss_delete_posts_ajax_spinner').remove();
                                    $('#wp_autonomous_rss_delete_posts_submit').prop('disabled', false);
                                }
                            });
                        } else {
                            alert('You need to confirm the delete before deleting all posts.');
                        }

                    });
                });
            </script>
            <?php
        }

    }

}
add_action( 'admin_footer', 'wp_autonomous_rss_add_article_manual_ajax' );

function wp_autonomous_rss_thumbnail_array_sort($a, $b) {
	return $b['width'] - $a['width'];
}

/**
 * Remove Yoast SEO meta box from RSS campaign page
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_remove_metabox() {
	remove_meta_box( 'wpseo_meta', 'wpa_rss', 'normal' );
	remove_meta_box( 'disruptpress_efi_url_metabox', 'wpa_rss', 'side' );
}
add_action( 'add_meta_boxes', 'wp_autonomous_rss_remove_metabox', 100 );


/**
 * Delete All Posts From Campaign
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_delete_posts() {

	$campaign_id = intval( $_POST['postid'] );

	if ( is_admin() AND $campaign_id != '' ) {
		//$campaign_id = intval( $_POST['postid'] );

		$query = get_posts( array(
			'numberposts'   => -1,
			'meta_key'     => 'wpa_rss_campaign_id',
			'meta_value'   => $campaign_id
		));

		foreach ( $query as $post ) {
			setup_postdata( $post );
			wp_delete_post( $post->ID, true );
		}

		echo '<p>' . count( $query ) . ' posts have been deleted.</p>';

		wp_reset_postdata();
	} else {
		echo 'Permission error.';
	}

	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_wp_autonomous_rss_delete_posts', 'wp_autonomous_rss_delete_posts' );

/**
 * Code from: https://stackoverflow.com/a/18602474/9513906
 */
function wp_autonomous_rss_time_elapsed($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function wp_autonomous_rss_secondsToWords($seconds) {
	$ret = "";

	/*** get the days ***/
	$days = intval(intval($seconds) / (3600*24));
	if($days> 0)
	{
		$ret .= "$days days ";
	}

	/*** get the hours ***/
	$hours = (intval($seconds) / 3600) % 24;
	if($hours > 0)
	{
		$ret .= "$hours hours ";
	}

	/*** get the minutes ***/
	$minutes = (intval($seconds) / 60) % 60;
	if($minutes > 0)
	{
		$ret .= "$minutes minutes ";
	}

	/*** get the seconds ***/
	//$seconds = intval($seconds) % 60;
	if ($seconds < 59) {
		$ret = "$seconds seconds";
	}

	return $ret;
}


function wp_autonomous_rss_hide_sections() {

    if ( is_single() ) {

        $post_id = get_the_ID();

	    $meta_post = get_post_meta( $post_id );
	    $meta_campaign = (isset($meta_post['wpa_rss_campaign_id'][0])) ? get_post_meta( $meta_post['wpa_rss_campaign_id'][0] ) : array();

        if (!empty($meta_campaign) && $meta_campaign['wp_autonomous_rss_content_remove_sections_toggle'][0] == 'yes' AND $meta_campaign['wp_autonomous_rss_content_remove_sections'][0] != '' ) {

	        $content_remove_sections = preg_split('/\n|\r/', $meta_campaign['wp_autonomous_rss_content_remove_sections'][0], -1, PREG_SPLIT_NO_EMPTY);
	        $css = '';

	        foreach($content_remove_sections as $val) {
		        $css .= $val.',';
	        }

	        $css = rtrim(trim($css),',');

	        $output = '
            <style type="text/css">
            '.$css.' {
                display: none !Important;
            }
            </style>';

	        echo $output;
        }

    }

}
add_action('wp_head', 'wp_autonomous_rss_hide_sections');


function wpa_rss_strposa($haystack, $needle, $offset=0) {
	if(!is_array($needle)) $needle = array($needle);
	foreach($needle as $query) {
		if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	}
	return false;
}


// Source: https://stackoverflow.com/questions/16027102/get-domain-name-from-full-url
function wp_autonomous_rss_get_domain($url)
{
	$pieces = parse_url($url);
	$domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
	if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
		return $regs['domain'];
	}
	return false;
}

function wp_autonomous_rss_display_source_link( $content ) {
	if( is_single() ) {

		$post_id = get_the_ID();

		$meta_post = get_post_meta( $post_id );
		$meta_campaign = (isset($meta_post['wpa_rss_campaign_id'][0])) ? get_post_meta( $meta_post['wpa_rss_campaign_id'][0] ) : array();

		if( !empty($meta_campaign) && $meta_post['wpa_rss_article_link'][0] && $meta_campaign['wp_autonomous_rss_content_remove_copyright'][0] != 'yes' ) {

			$source_link = $meta_post['wpa_rss_article_link'][0];
			$host = wp_autonomous_rss_get_domain( $source_link );

			$source_name = ucfirst($host);


			$content .= '<div class="wp_autonomous_rss_source_link">This article was originally published by <a href="//' . $host . '" target="_blank">' . $source_name . '</a>. Read the <a href="' . $source_link . '" target="_blank">original article here</a>.</div>';
		}
	}
	return $content;
}
add_filter( 'the_content', 'wp_autonomous_rss_display_source_link' );

//function wp_autonomous_rss_find( $haystack, $needle ) {
//
//	if( strpos( $haystack,$needle )!== false ){
//		return true;
//	} else {
//		return false;
//	}
//
//}


function wp_autonomous_rss_find($haystack, $needle, $offset=0) {
	if(!is_array($needle)) $needle = array($needle);
	foreach($needle as $query) {
		if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	}
	return false;
}