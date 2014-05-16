<?php

class Wpp_Email_Manager {

	function __construct() {

		$this->hooks();

	}

	function hooks() {

		add_action( 'wp_ajax_wpp_store_email', array( $this, 'store_email' ) );

		add_action( 'wp_ajax_nopriv_wpp_store_email', array( $this, 'store_email' ) );

	}

	function get_email_storage() {

		$options = wpp_get_settings();

		if ( ! isset( $options['email_service'] ) )
			return 'db';

		return $options['email_service'];

	}

	function store_email() {

		usleep( 500 );

		error_reporting(0);

		$response = array(
				'status' => 'error',
				'code' => 0,
				'message' => 'Unknown error'
			);

		if ( ! wp_verify_nonce( $_POST['wpp_email_manager_nonce'], 
			'wpp_email_manager_nonce' ) ) {

			$response = array(
				'status' => 'error',
				'code' => 1,
				'message' => 'Invalid Nonce'
			);

			exit( json_encode( $response ) );

		}

		if ( ! isset( $_POST['name'] ) )
			$_POST['name'] = '';

		$email = $_POST['email'];

		$name = $_POST['name'];

		$theme_id = '';

		$popup_id = '';

		$ip_address = $_SERVER['REMOTE_ADDR'];

		if ( isset( $_POST['theme_id'] ) )
			$theme_id = $_POST['theme_id'];

		if( ! ( long2ip(ip2long($ip_address)) == $ip_address ) )
			$ip_address = '127.0.0.1';

		$storage = $this->get_email_storage();

		$settings = wpp_get_settings();

		$storage = apply_filters( 'wpp_email_storage_id', $storage );

		if ( ! is_email( $email ) ) {

			$response = array(
				'status' => 'error',
				'code' => 11,
				'message' => 'Please enter a valid email address'
			);

			exit( json_encode( $response ) );

		}

		$data = array(
				'name' => sanitize_text_field( $name ),
				'email' => $email,
				'theme_id' => $theme_id,
				'popup_id' => $popup_id,
				'__ip_address' => $ip_address
			);

		if ( $storage == 'db' ) 
			$this->store_email_to_db( $data);

		if ( $storage == 'mailchimp' )
			$this->store_email_to_mailchimp( $data );

		if ( $storage == 'aweber' )
			$this->store_email_to_aweber( $data );

		if ( $storage == 'cm' )
			$this->store_email_to_campaign_monitor( $data );

		do_action( 'wpp_store_email', $data, $storage );

		$response = array(
				'status' => 'success',
				'code' => 1,
				'message' => mb_substr( $settings['inline_thanks_message'], 0, 200 ),
				'redirect_to' => $settings['redirect_url'],
			);

		exit( json_encode( $response ) );

	}

	function store_email_to_db( $data ) {

		$emails = wpp_get_email_store();

		if ( isset( $emails[$data['email']] ) ) {

			$response = array(
				'status' => 'error',
				'code' => 12,
				'message' => 'Email already exist'
			);

			exit( json_encode( $response ) );

		}

		$emails[$data['email']] = $data;

		wpp_update_email_store( $emails );

		do_action( 'wpp_store_email_to_db' );

	}

	function store_email_to_mailchimp( $data ) {

		wpp_include( '/libs/MCAPI.class.php' );

		$settings = wpp_get_settings();

		$api_key = $settings['mailchimp']['api_key'];
		
		$list_id = $settings['mailchimp']['list_id'];

		$subscriber_exist_message = $settings['error_message']['subscriber_already_exist'];

		$unknown_error_message = $settings['error_message']['unknown'];

		$api = new MCAPI( $api_key );

		$name = $data['name'];

		$email = $data['email'];

		$theme_id = $data['theme_id'];

		$popup_id = $data['popup_id'];

		list($fname,$lname) = preg_split('/\s+(?=[^\s]+$)/', $name, 2); 
		
		$merge_vars = array(
			'FNAME' => $fname, 
			'LNAME' => $lname,
			'POPUPTHEMEID' => $theme_id,
			'POPUPID' => $popup_id
		);

		$retval = $api->listSubscribe( $list_id, $email, $merge_vars );

		if( $api->errorCode ):


			if ( $api->errorCode === 214 ):
				
				$response = array(
					'status' => 'error',
					'code' => 12,
					'message' => mb_substr( $subscriber_exist_message, 0, 200 )
				);

				exit( json_encode( $response ) );

			endif;

			$response = array(
					'status' => 'error',
					'code' => -1,
					'message' => $unknown_error_message . ' - ' .  $api->errorMessage
				);

			exit( json_encode( $response ) );

		endif;



		do_action( 'wpp_store_email_to_mailchimp', $data );

	}

	function store_email_to_aweber( $data ) {


		do_action( 'wpp_store_email_to_aweber', $data );

	}

	function store_email_to_campaign_monitor( $data ) {

		do_action( 'wpp_store_email_to_campaign_monitor', $data );
		
	}


}