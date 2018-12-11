<?php
/*
Plugin Name: WSUWP Plugin Spine Themes
Version: 0.0.1
Description: Plugin to add additional Spine themes.
Author: washingtonstateuniversity, Danial Bleile
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/wsuwp-plugin-skeleton
Text Domain: wsuwp-plugin-spine-themes
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {

	// @codingStandardsIgnoreStart
	add_action( 'admin_notices', create_function( '', 
	"echo '<div class=\"error\"><p>" . __( 'WSUWP Plugin Skeleton requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'wsuwp-plugin-skeleton' ) . "</p></div>';" ) );
	// @codingStandardsIgnoreEnd
	return;
} else {
	include_once __DIR__ . '/includes/wsuwp-plugin-spine-themes.php';
}
