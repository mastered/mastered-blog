<?php

add_action('wp_rp_admin_notices', 'wp_rp_display_admin_notices');

// Show connect notice on dashboard and plugins pages
add_action( 'load-index.php', 'wp_rp_prepare_admin_connect_notice' );
add_action( 'load-plugins.php', 'wp_rp_prepare_admin_connect_notice' );

function wp_rp_display_admin_notices() {
	global $wp_rp_admin_notices;

	foreach ((array) $wp_rp_admin_notices as $notice) {
		echo '<div id="message" class="' . $notice[0] . ' below-h2"><p>' . $notice[1] . '</p></div>';
	}
}

function wp_rp_prepare_admin_connect_notice() {
	$meta = wp_rp_get_meta();

	if ($meta['show_turn_on_button'] && !$meta['turn_on_button_pressed'] && !$meta['blog_id'] && $meta['new_user']) {
		wp_register_style( 'wp_rp_connect_style', plugins_url('static/css/connect.css', __FILE__) );
		wp_register_script( 'wp_rp_connect_js', plugins_url('static/js/connect.js', __FILE__) );
		add_action( 'admin_notices', 'wp_rp_admin_connect_notice' );
	}
}

function wp_rp_admin_connect_notice() {
	wp_enqueue_style( 'wp_rp_connect_style' );
	wp_enqueue_script( 'wp_rp_connect_js' );
	?>
	<div id="wp-rp-message" class="updated wp-rp-connect">
		<div id="wp-rp-dismiss">
			<a id="wp-rp-close-button"></a>
		</div>
		<div id="wp-rp-wrap-container">
			<div id="wp-rp-connect-wrap">
				<a id="wp-rp-login" href="<?php echo admin_url('admin.php?page=wordpress-related-posts&ref=turn-on-rp'); ?>">Turn on</a>
			</div>
			<div id="wp-rp-text-container">
				<h4>WordPress Related Posts are almost ready,</h4>
				<h4>now all you need to do is connect to our service.</h4>
			</div>
		</div>
		<div id="wp-rp-bottom-container">
			<p>By turning on Related Posts you agree to <a href="http://www.zemanta.com/rp-tos" target="_blank">terms of service.</a></p>
			<p>You'll get Advanced Settings, Themes, Thumbnails and Analytics Dashboard. These features are provided by <a target="_blank" href="http://www.zemanta.com">Zemanta</a> as a service.</p>
		</div>
	</div>
	<?php
}

function wp_rp_add_admin_notice($type = 'updated', $message = '') {
	global $wp_rp_admin_notices;
	
	if (strtolower($type) == 'updated' && $message != '') {
		$wp_rp_admin_notices[] = array('updated', $message);
		return true;
	}
	
	if (strtolower($type) == 'error' && $message != '') {
		$wp_rp_admin_notices[] = array ('error', $message);
		return true;
	}
	
	return false;
}
