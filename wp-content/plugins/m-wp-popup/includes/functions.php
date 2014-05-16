<?php

function load_wpp() {

	load_wpp_classes();


	//Plugin loaded
	wpp_loaded();

}

function load_wpp_classes() {

	wpp_include( 'classes/wpp_popup_post_type.php' );
	wpp_include( 'classes/wpp_settings.php' );
	wpp_include( 'classes/wpp_email_manager.php' );
	wpp_include( 'classes/wpp_popup_theme.php' );
	wpp_include( 'classes/wpp_default_popup_theme.php' );

	do_action( 'wpp_classes_loaded'  );

	new Wpp_Popup_Post_Type();
	new Wpp_Settings();
	new Wpp_Email_Manager();

	//Register and init the default popup theme
	new Wpp_Default_Popup_Theme();


}

function wpp_loaded() {

	do_action( 'wpp_loaded' );

}

function wpp_include( $file_name, $require = true ) {

	if ( $require )
		require POPUP_PLUGIN_INCLUDE_DIRECTORY . $file_name;
	else
		include POPUP_PLUGIN_INCLUDE_DIRECTORY . $file_name;

}

function wpp_view_path( $view_name, $is_php = true ) {

	if ( strpos( $view_name, '.php' ) === FALSE && $is_php )
		return POPUP_PLUGIN_VIEW_DIRECTORY . $view_name . '.php';

	return POPUP_PLUGIN_VIEW_DIRECTORY . $view_name;

}

function wpp_image_url( $image_name ) {

	return plugins_url( 'images/' . $image_name, POPUP_PLUGIN_MAIN_FILE );

}

function wpp_get_settings() {

	$settings = get_option( 'wpp_settings' );

	$default_settings = Wpp_Settings::default_settings();

	$settings = wp_parse_args( $settings, $default_settings );

	return apply_filters( 'wpp_settings', $settings );

}

function wpp_get_email_store() {

	$emails = get_option( 'wpp_email_store' );

	if ( ! $emails )
		$emails = array();

	return apply_filters( 'wpp_email_store', $emails );

}

function wpp_get_popup_themes() {

	$themes = array();

	return apply_filters( 'wpp_popup_themes' , $themes );

}

function wpp_get_popup_meta( $popup_id, $key ) {

	return get_post_meta( $popup_id, $key, true );

}

function wpp_get_popup_theme( $popup_id ) {

	$theme = wpp_get_popup_meta( $popup_id, 'theme' );

	if ( ! $theme )
		$theme = 'default_theme';

	return apply_filters( 'wpp_get_popup_theme', $theme, $popup_id );

}

function wpp_save_popup_meta( $popup_id, $key, $value ) {

	return update_post_meta( $popup_id, $key, $value );

}

function wpp_update_email_store( $emails ) {

	return update_option( 'wpp_email_store', $emails );

}

function wpp_email_manager_store_link() {

	$link = admin_url( 'admin-ajax.php?action=wpp_store_email' );

	return apply_filters( 'wpp_email_manager_store_link', $link );

}

function wpp_email_manager_nonce() {

	return wp_create_nonce( 'wpp_email_manager_nonce' );

}
