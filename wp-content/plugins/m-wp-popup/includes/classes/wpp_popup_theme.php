<?php

class Wpp_Popup_Theme {

	protected $name;

	protected $description;

	protected $id;

	protected $settings;

	function __construct() {

		$this->hooks();

		$this->filters();

	}

	function hooks() {

		add_action( 'wpp_save_popup_data', array( $this, 'save_settings' ) );

		add_action( 'wpp_admin_theme_view', array( $this, 'render_settings' ) );

		add_action( 'wpp_link_popup_shortcode',
			array( $this, 'link_popup_render' ), 10, 2 );

		add_action( 'wp_footer', array( $this, 'auto_popup_hook' ), 99999 );

	}

	function filters() {

		add_filter( 'wpp_popup_themes', array( $this, 'register_theme' ) );

	}

	function register_theme( $themes ) {

		if ( isset( $themes[$this->id] ) )
			return $themes;

		$themes[$this->id] = $this;

		return $themes;

	}

	public function is_activated( $popup_id, $id = '' ) {

		if ( empty( $id ) )
			$id = $this->id();

		$theme = wpp_get_popup_theme( $popup_id );

		return $theme == $id;

	}

	function check_rules( $popup_id ) {

		$options = wpp_get_popup_meta( $popup_id, 'options' );

		if ( ! $options['enabled'] )
			return apply_filters( 'wpp_check_rules_false', FALSE, $popup_id, 'enabled' );

		$rules = $options['rules'];

		if ( ! $rules['show_to_logged_in_users'] && is_user_logged_in() )
			return apply_filters( 'wpp_check_rules_false', FALSE, $popup_id, 'show_to_logged_in_users' );

		if ( $rules['show_only_on_homepage'] && ! ( is_front_page() || is_home() ) )
			return apply_filters( 'wpp_check_rules_false', FALSE, $popup_id, 'show_only_on_homepage' );

		if ( ! $rules['show_on_homepage'] && ( is_front_page() || is_home() ) )
			return apply_filters( 'wpp_check_rules_false', FALSE, $popup_id, 'show_on_homepage' );

		if ( $rules['show_only_to_search_engine_visitors'] ):

		$is_se_visitor = false;

		$ref = $_SERVER['HTTP_REFERER'];
		
		$SE = array( '/search?', 'images.google.', 'web.info.com', 'search.', 
			'del.icio.us/search', 'soso.com', '/search/', '.yahoo.', '.google.',
			 '.bing.', 'search.twitter.com' );
		
		foreach ( $SE as $source ) {
			
			if ( strpos( $ref, $source ) !== false ) {
			
				setcookie( 'wpp_is_searchengine_visitor', 1, time()+3600*24*100, COOKIE_DOMAIN, false );
				
				$is_se_visitor = true;
			
			}
		}

		if ( $is_se_visitor !== true ||
			! $_COOKIE['wpp_is_searchengine_visitor'] == 1 )
			return apply_filters( 'wpp_check_rules_false', FALSE, $popup_id, 'show_only_to_search_engine_visitors' );

		endif;

		return apply_filters( 'wpp_check_rules', TRUE, $popup_id );

	}

	function is_link_popup( $popup_id ) {

		return FALSE;

	}


	function save_settings( $popup_id ) {



	}

	public function auto_popup_render( $popup_id ) {

		if ( ! $this->check_rules( $popup_id ) )
			return FALSE;

	}

	function link_popup_render( $popup_id, $shortcode_atts ) {



	}

	function render_settings( $popup_id ) {



	}

	public function name( $name = '' ) {

		if (  empty( $name ) )
			return $this->name;

		$this->name = $name;

	}

	public function description( $description = '' ) {

		if (  empty( $description ) )
			return $this->description;

		$this->description = $description;

	}

	public function id( $id = '' ) {

		if (  empty( $id ) )
			return $this->id;

		$this->id = $id;

	}

	function save_settings_to_db( $popup_id, $settings ) {

		return wpp_save_popup_meta( $popup_id, $this->id() . '_settings', $settings );

	}

	function get_settings( $popup_id ) {

		$settings = wpp_get_popup_meta( $popup_id, $this->id() . '_settings' );

		if ( ! $settings )
			return $this->default_settings();

		return $settings;

	}

	function default_settings() {

		return array();

	}

	function auto_popup_hook() {

		$popups = get_posts( array(
				'post_type' => POPUP_PLUGIN_POPUP_POST_TYPE,
				'numberposts' => -1,
				'post_status' => 'publish'
			) );

		$themes = wpp_get_popup_themes();

		foreach ( $popups as $popup ):

		$popup_id = $popup->ID;

		if ( ! $this->is_activated( $popup_id ) )
			continue;

		if ( ! $this->check_rules( $popup_id ) )
			continue;

		$theme = wpp_get_popup_theme( $popup_id );

		if ( ! isset( $themes[ $theme ] ) )
			continue;

		$themes[$theme]->auto_popup_render( $popup_id );

		endforeach;

	}

	function echo_popup_options_in_json( $popup_id ) {

		$options = wpp_get_popup_meta( $popup_id, 'options' );

		$options = json_encode( $options );

		echo apply_filters( 'wpp_echo_popup_options_in_json',  $options, $popup_id );

	}



}
