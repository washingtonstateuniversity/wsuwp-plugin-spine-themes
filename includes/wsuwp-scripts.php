<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Handles script enqueues for the plugin
 *
 * @since 0.0.1
 */
class WSUWP_Scripts {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ), 99 );

	} // End __construct


	/**
	 * Add scripts off of the wp_enqueue_scripts action
	 *
	 * @since 0.0.1
	 */
	public function add_public_scripts() {

		$supported_themes = array(
			'rainier',
			'baker',
			'adams',
			'olympus',
		);

		$theme_type = wsuwp_spine_themes_get_theme();

		if ( ! empty( $theme_type ) && in_array( $theme_type, $supported_themes, true ) ) {

			wp_enqueue_style(
				'spine-theme-base-css',
				wsuwp_spine_themes_get_plugin_url() . 'css/base.css',
				array(),
				WSUWP_Plugin_Spine_Themes::$version
			);

		} // End if

	} // End


} // End WSUWP_Scripts

$wsuwp_scripts = new WSUWP_Scripts();
