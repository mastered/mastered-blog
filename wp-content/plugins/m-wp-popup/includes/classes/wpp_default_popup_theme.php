<?php

class Wpp_Default_Popup_Theme extends Wpp_Popup_Theme {

	protected $id = 'default_theme';

	protected $description = 'Default Popup theme for WP popup plugin';

	protected $name = 'Default Theme';

	function save_settings( $popup_id ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		if ( ! isset( $_POST['default_theme_is_theme'] ) )
			return FALSE;

		$header = $_POST['s-header'];

		$list_1 = $_POST['s-list1'];

		$list_2 = $_POST['s-list2'];

		$list_3 = $_POST['s-list3'];

		$sub_header = $_POST['s-subheader'];

		$first_name_text = $_POST['first_name_text'];

		$enter_email_text = $_POST['enter_email_text'];

		$button_txt = $_POST['s-btntxt'];

		if ( $first_name_text == '' )
			$first_name_text = 'Enter your First Name..';

		if ( $enter_email_text == '' )
			$enter_email_text = 'Enter your Email Address..';

		$settings = array(
				'header' => $header,
				'list_items' => array( $list_1, $list_2, $list_3 ),
				'sub_header' => $sub_header,
				'first_name_text' => $first_name_text,
				'enter_email_text' => $enter_email_text,
				'button_txt' => $button_txt
			);

		$this->save_settings_to_db( $popup_id, $settings );

	}

	function render_settings( $popup_id ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		$settings = $this->get_settings( $popup_id );

		include wpp_view_path( 'themes/default/admin_view.php' );

	}

	public function auto_popup_render( $popup_id ) {

		if ( ! $this->check_rules( $popup_id ) )
			return FALSE;

		$settings = $this->get_settings( $popup_id );

		$uniq_id = uniqid();

		include wpp_view_path( 'themes/default/auto_popup.php' );


	}

	function link_popup_render( $popup_id, $shortcode_atts ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		$link_text = $shortcode_atts['link_text'];

		$settings = $this->get_settings( $popup_id );

		$uniq_id = uniqid();

		include wpp_view_path( 'themes/default/link_popup.php' );

	}

	function default_settings() {

		return array(
				'header' => 'Header Goes Here Make it effective and short',
				'list_items' => array( 
					'List Item #1', 'List Item #2', 'List Item #3' ),
				'sub_header' => 'Sub- Heading Text Goes here Tease them',
				'first_name_text' => 'Enter your First Name..',
				'enter_email_text' => 'Enter your Email Address..',
				'button_txt' => 'Submit'
			);

	}
	

}
