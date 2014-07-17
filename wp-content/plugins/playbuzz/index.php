<?php
/*
Plugin Name: PlayBuzz
Plugin URI: http://www.PlayBuzz.com/
Description: Plugin for embedding PlayBuzz playful content in WordPress sites.
Version: 0.2.0
Author: PlayBuzz
Author URI: http://www.PlayBuzz.com/
Text Domain: playbuzz
Domain Path: /lang
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/*
 * WordPress Admin Options Page
 */
require ( plugin_dir_path( __FILE__ ) . 'admin.php' );
new PlayBuzzAdmin();


/*
 * Register WordPress Shortcodes
 */
include_once ( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );



/*
 * Register WordPress Sidebar Widgets
 */
include_once ( plugin_dir_path( __FILE__ ) . 'widgets.php' );


add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'playbuzz_settings_link' );

// Add settings link on plugin page
function playbuzz_settings_link($links) {
	$settings_link = '<a href="options-general.php?page=playbuzz">Settings</a>';
	array_unshift($links, $settings_link); 
	return $links; 
}


// Hooks fired when the Plugin is activated and deactivated
register_activation_hook(   __FILE__ , array( 'PlayBuzzAdmin', 'activate'   ) );
register_deactivation_hook( __FILE__ , array( 'PlayBuzzAdmin', 'deactivate' ) );