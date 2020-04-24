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

		add_action( 'init', array( $this, 'register_menus' ) );

		add_action( 'customize_register', array( $this, 'add_css_order' ), 20 );

	} // End __construct


	public function add_css_order( $wp_customize ) {

		$wp_customize->add_setting(
			'wsuwp_custom_css_priority',
			array(
				'default'        => false,
			)
		);

		$wp_customize->add_control(
			'wsuwp_custom_css_priority_control',
			array(
				'settings' => 'wsuwp_custom_css_priority',
				'label'    => 'Fix Custom Stylesheet Order',
				'section'  => 'section_spine_advanced_options',
				'type'     => 'checkbox',
			)
		);

	}


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
				'baker'    => 'Baker',
				'adams'    => 'Adams (Beta)',
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
				case 'baker':
					include_once wsuwp_spine_themes_get_plugin_dir() . '/themes/baker/wsuwp-baker-theme.php';
					break;
				case 'adams':
					include_once wsuwp_spine_themes_get_plugin_dir() . '/themes/adams/wsuwp-adams-theme.php';
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

				case 'adams':
				case 'rainier':
				case 'baker':
					wsuwp_spine_register_sidebar( 'footer' );
					break;

			} // End switch
		} // End if

	} // End add_sidebars


	public function register_menus() {

		$theme = wsuwp_spine_themes_get_theme();

		if ( ! empty( $theme ) ) {

			switch ( $theme ) {

				case 'adams':
					register_nav_menu( 'header_menu', 'Header Menu' );
					break;

			} // End switch
		} // End if

	} // End register_menus


} // End WSUWP_Themes

$wsuwp_themes = new WSUWP_Themes();
