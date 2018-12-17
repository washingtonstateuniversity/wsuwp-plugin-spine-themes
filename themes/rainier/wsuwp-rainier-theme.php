<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add Rainier theme actions and filters.
 *
 * @since 0.0.2
 */
class WSUWP_Rainier_Theme {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ), 99 );

		add_filter( 'wsuwp_spine_get_template_part', array( $this, 'remove_template_featured_image' ), 10, 3 );

		add_action( 'spine_theme_template_after_headers', array( $this, 'add_banner' ), 10, 1 );

		add_action( 'spine_theme_template_after_footer', array( $this, 'add_footer' ), 10, 1 );

		wsuwp_spine_register_sidebar( 'footer' );

	} // End __construct


	public function remove_template_featured_image( $slug, $context, $name ) {

		$apply_to = array( 'page.php', 'single.php' );

		if ( in_array( $context, $apply_to, true ) && 'parts/featured-images' === $slug ) {

			$slug = false;

		} // End if

		return $slug;

	} // End remove_template_headers


	public function add_banner( $context ) {

		if ( 'page.php' === $context ) {

			$page_settings = wsuwp_spine_get_page_settings( get_the_ID() );

			$banner_image = wsuwp_spine_get_post_image_data( get_the_ID(), 'full' );

			$title    = ( ! empty( $page_settings['title'] ) ) ? $page_settings['title'] : get_the_title();
			$subtitle = ( ! empty( $page_settings['subtitle'] ) ) ? $page_settings['subtitle'] : '';
			$img_src  = ( ! empty( $banner_image['src'] ) ) ? $banner_image['src'] : '';
			$img_alt  = ( ! empty( $banner_image['alt'] ) ) ? $banner_image['alt'] : '';

			include wsuwp_spine_themes_get_plugin_dir() . 'theme-parts/banners/hero-banner.php';

			add_filter(
				'wsuwp_spine_themes_show_title',
				function( $show_title, $context ) {
					return ( 'article.php' === $context ) ? false : $show_title;
				},
				10,
				2
			);

		} // End if

	} // End add_banner


	public function add_footer( $context ) {

		include wsuwp_spine_themes_get_plugin_dir() . 'theme-parts/footers/hero-footer.php';
	} // End add_footer


	/**
	 * Add scripts off of the wp_enqueue_scripts action
	 *
	 * @since 0.0.2
	 */
	public function add_public_scripts() {

		wp_enqueue_style(
			'spine-theme-rainier-css',
			wsuwp_spine_themes_get_plugin_url() . 'themes/rainier/css/rainier.css',
			array(),
			WSUWP_Plugin_Spine_Themes::$version
		);

	} // End add_public_scripts


} // End WSUWP_Scripts

$wsuwp_rainier_theme = new WSUWP_Rainier_Theme();
