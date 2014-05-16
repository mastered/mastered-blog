<?php

class Wpp_Settings {

	function __construct() {

		$this->start();

	}

	function start() {

		$this->hooks();
		$this->filters();

	}



	function hooks() {

		//Add the 'WP Popup' admin dashboard menu

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}

	function filters() {

		//No filters yet

	}

	function admin_menu() {

		$page_title = __( 'Popups', POPUP_PLUGIN_PREFIX );
		$menu_title = __( 'WP Popup', POPUP_PLUGIN_PREFIX );
		$capability = POPUP_PLUGIN_CAPABILITY;
		$menu_slug = 'edit.php?post_type=' . POPUP_PLUGIN_POPUP_POST_TYPE;

		add_object_page( $page_title, $menu_title, $capability,
			$menu_slug );

		//Add the 'WP Popup Settings' page to settings dashboard menu

		add_submenu_page( 'options-general.php', 'WP Popup Settings', 
			'WP Popup Settings', POPUP_PLUGIN_CAPABILITY , 'wpp-settings',
			array( $this, 'settings_page' )  );

	}

	function settings_page() {

		if ( $this->save_settings() )
			$_REQUEST['saved'] = true;

		$nonce = wp_create_nonce( 'wpp_settings_nonce' );

		$settings = wpp_get_settings();

		include wpp_view_path( __FUNCTION__ );

	}

	function save_settings() {

		if ( ! isset( $_REQUEST['saved'] ) )
			return FALSE;

		if ( ! wp_verify_nonce( $_POST['nonce'], 'wpp_settings_nonce' ) )
			return FALSE;

		unset( $_POST['saved'] );
		unset( $_POST['nonce'] );

		$_POST['settings']['inline_thanks_message'] = stripslashes( $_POST['settings']['inline_thanks_message'] );

		do_action( 'wpp_save_settings' );

		return update_option( 'wpp_settings', $_POST['settings'] );

	}

	public static function default_settings() {

		$settings = array( 
				'email_storage' => 'mailchimp',
				'redirect_url' => '',
				'inline_thanks_message' => 'An email is sent to you with a link. Kindly click on the link to confirm your email address.',
				'error_message' => array(
					 	'unknown' => 'An unknown error occured',
					 	'subscriber_already_exist' => 'Subscriber with this email already exist'
					),
				'mailchimp' => array(
						'list_id' => '',
						'api_key' => ''
					)
		 );

		return apply_filters( 'wpp_default_settings', $settings );

	}

}