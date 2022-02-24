<?php
/**
 * The Template for displaying the license page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="wrap">

<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>

<form method="post" action="options.php">

<?php wp_nonce_field( $this->plugin_name . '_license_nonce', $this->plugin_name . '_license_nonce' ); ?>
<?php settings_fields( $this->plugin_name . '_license' ); ?>
<?php $license = get_option( $this->plugin_name . '_license_key' ) ?>
<?php $status = get_option( $this->plugin_name . '_license_status' ) ?>

<h2><?php echo WP_AUTONOMOUS_RSS_NAME_FANCY; ?> - Plugin License</h2>

<table class="form-table">

    <tr valign="top">
        <th scope="row" valign="top">	<?php _e('Plugin License Key'); ?></th>
        <td>
            <input id="<?php echo $this->plugin_name; ?>_license_key" name="<?php echo $this->plugin_name; ?>_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
        </td>
    </tr>

    <tr>
        <th scope="row" valign="top">	<?php _e('Status'); ?></th>
        <td>
            <?php if( $status !== false && $status == 'valid' ) { ?>
                <span style="color:green;"><?php _e('Active'); ?></span>
            <?php } else {  ?>
                <span style="color:red;"><?php _e('Inactive'); ?></span>
            <?php } ?>
        </td>
    </tr>
</table>

<input type="hidden" name="action" value="update" />

<p class="submit">
    <?php if( $status !== false && $status == 'valid' ) { ?>
        <input type="submit" class="button-primary button-red" name="<?php echo $this->plugin_name; ?>_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
    <?php } else {  ?>
        <input type="submit" class="button-primary" name="<?php echo $this->plugin_name; ?>_license_activate" value="<?php _e('Activate License'); ?>"/>
    <?php } ?>
</p>

</form>
</div>