<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Themes {

	public function __construct() {

		add_filter( 'spine_theme_styles', array( $this, 'add_spine_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'do_theme' ) );

		add_action( 'init', array( $this, 'add_sidebars' ) );

	} // End __construct


	/**
	 * Filter theme styles. Add additional themes and remove not supported ones.
	 *
	 * @since 0.0.1
	 */
	public function add_spine_styles( $theme_styles ) {

		$current_theme = wsuwp_spine_themes_get_theme();

		if ( is_array( $theme_styles ) ) {

			if ( array_key_exists( 'bookmark', $theme_styles ) ) {

				$theme_styles['bookmark'] = 'Bookmark (Deprecated)';

			} // End if

			$new_themes = array(
				'rainier'  => 'Rainier',
			);

			$theme_styles = array_merge( $theme_styles, $new_themes );

		} // End if

		return $theme_styles;

	} // End add_spine_styles


	public function do_theme() {

		$theme = wsuwp_spine_themes_get_theme();

		if ( ! empty( $theme ) ) {

			switch ( $theme ) {

				case 'rainier':
					include_once wsuwp_spine_themes_get_plugin_dir() . '/themes/rainier/wsuwp-rainier-theme.php';
					break;

			} // End switch
		} // End if

	} // End do_theme


	/**
	 * Add Sidebars for theme
	 *
	 * @since 0.0.1
	 */
	public function add_sidebars() {

		$theme = wsuwp_spine_themes_get_theme();

		if ( ! empty( $theme ) ) {

			switch ( $theme ) {

				case 'rainier':
					wsuwp_spine_register_sidebar( 'footer' );
					break;

			} // End switch
		} // End if

	} // End add_sidebars


} // End WSUWP_Themes

$wsuwp_themes = new WSUWP_Themes();
