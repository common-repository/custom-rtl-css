<?php

if( ! defined( 'CRTLCSS_FILE' ) ) {
	die();
}

function crtlcss_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'themes.php?page=custom-rtl-css.php' ) . '">' . __( 'Add RTL CSS', 'custom-rtl-css' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . plugin_basename( CRTLCSS_FILE ), 'crtlcss_settings_link' );

function crtlcss_textdomain() {
	load_plugin_textdomain( 'custom-rtl-css', false, dirname( plugin_basename( CRTLCSS_FILE ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'crtlcss_textdomain' );

function crtlcss_uninstall() {
	delete_option( 'crtlcss_settings' );
}
register_uninstall_hook( CRTLCSS_FILE, 'crtlcss_uninstall' );

function crtlcss_register_submenu_page() {
	add_theme_page( __( 'Custom RTL CSS', 'custom-rtl-css' ), __( 'Custom RTL CSS', 'custom-rtl-css' ), 'edit_theme_options', basename( CRTLCSS_FILE ), 'crtlcss_render_submenu_page' );
}
add_action( 'admin_menu', 'crtlcss_register_submenu_page' );


function crtlcss_register_settings() {
	register_setting( 'crtlcss_settings_group', 'crtlcss_settings' );
}
add_action( 'admin_init', 'crtlcss_register_settings' );


function crtlcss_render_submenu_page() {

	$options = get_option( 'crtlcss_settings' );
	$content = isset( $options['crtlcss-content'] ) && ! empty( $options['crtlcss-content'] ) ? $options['crtlcss-content'] : __( '/* Enter Your Custom CSS Here */', 'custom-rtl-css' );

	if ( isset( $_GET['settings-updated'] ) ) : ?>
		<div id="message" class="updated"><p><?php _e( 'Custom RTL CSS updated successfully.', 'custom-rtl-css' ); ?></p></div>
	<?php endif; ?>
	<div class="wrap">
		<h2 style="margin-bottom: 1em;"><?php _e( 'Custom RTL CSS', 'custom-rtl-css' ); ?></h2>
		<form name="crtlcss-form" action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields( 'crtlcss_settings_group' ); ?>
			<div id="templateside">
				<?php do_action( 'crtlcss-sidebar-top' ); ?>
				<p style="margin-top: 0"><?php _e( 'Custom RTL CSS allows you to add your own RTL styles or override the default CSS of a plugin or theme.', 'custom-rtl-css' ) ?></p>
        <p><?php _e( 'Visit <a href="http://elbruz.co" target="_blank">Elbruz Technologies</a> for more tools and services.', 'custom-rtl-css' ) ?></p>
				<?php submit_button( __( 'Update Custom RTL CSS', 'custom-rtl-css' ), 'primary', 'submit', true ); ?>
				<?php do_action( 'crtlcss-sidebar-bottom' ); ?>
			</div>
			<div id="template">
				<?php do_action( 'crtlcss-form-top' ); ?>
				<div>
					<textarea cols="70" rows="15" name="crtlcss_settings[crtlcss-content]" id="crtlcss_settings[crtlcss-content]" ><?php echo esc_html( $content ); ?></textarea>
				</div>
				<?php do_action( 'crtlcss-textarea-bottom' ); ?>
				<div>
					<?php submit_button( __( 'Update Custom RTL CSS', 'custom-rtl-css' ), 'primary', 'submit', true ); ?>
				</div>
				<?php do_action( 'crtlcss-form-bottom' ); ?>
			</div>
		</form>
	</div>
<?php
}
