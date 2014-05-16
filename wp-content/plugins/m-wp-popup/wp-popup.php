<?php
/**
Plugin Name: WP Popup Plugin
Plugin URI: http://rocketplugins.com/wordpress-popup-plugin/
Description: The best WordPress Popup plugin. Period.
Version: 0.5
Author: Muneeb
Author URI: http://rocketplugins.com/wordpress-popup-plugin/
License: GPLv2 or later
Copyright: 2013 Muneeb ur Rehman http://muneeb.me
**/

require plugin_dir_path( __FILE__ ) . 'config.php';

require POPUP_PLUGIN_INCLUDE_DIRECTORY . 'functions.php';

load_wpp();