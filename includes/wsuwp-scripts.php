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

		$spine_options = get_option( 'spine_options', array() );

		$theme_type = ( is_array( $spine_options ) && ! empty( $spine_options['theme_style'] ) ) ? $spine_options['theme_style'] : false;

		if ( ! empty( $theme_type ) && in_array( $theme_type, $supported_themes, true ) ) {

			$theme_css = false;

			switch ( $theme_type ) {

				case 'rainier':
					$theme_css = 'css/rainier.css';
					break;

				case 'baker':
					$theme_css = 'css/baker.css';
					break;

				case 'adams':
					$theme_css = 'css/adams.css';
					break;

				case 'olympus':
					$theme_css = 'css/olympus.css';
					break;

			} // End switch

			if ( ! empty( $theme_css ) ) {

				wp_enqueue_style(
					'spine-theme-base-css',
					plugin_dir_url( dirname( __FILE__ ) ) . $theme_css,
					array(),
					WSUWP_Plugin_Spine_Themes::$version
				);

			} // End if

			wp_enqueue_style(
				'spine-theme-base-css',
				plugin_dir_url( dirname( __FILE__ ) ) . 'css/base.css',
				array(),
				WSUWP_Plugin_Spine_Themes::$version
			);

		} // End if

	} // End


} // End WSUWP_Scripts

$wsuwp_scripts = new WSUWP_Scripts();
