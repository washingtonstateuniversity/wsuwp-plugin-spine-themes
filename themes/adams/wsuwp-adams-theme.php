<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add Adams theme actions and filters.
 *
 * @since 0.0.2
 */
class WSUWP_Adams_Theme {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ), 99 );

		add_filter( 'wsuwp_spine_get_template_part', array( $this, 'remove_template_featured_image' ), 10, 3 );

		add_action( 'spine_theme_template_after_headers', array( $this, 'add_banner' ), 10, 1 );

		add_action( 'spine_theme_template_after_footer', array( $this, 'add_footer' ), 10, 1 );

	} // End __construct


	public function remove_template_featured_image( $slug, $context, $name ) {

		$apply_to = array( 'page.php', 'single.php' );

		$post_type = get_post_type();

		if ( 'parts/featured-images' === $slug ) {

			if ( in_array( $context, $apply_to, true ) || 'page' === $post_type ) {
				$slug = false;
			} // End if
		} // End if

		return $slug;

	} // End remove_template_headers


	public function add_banner( $context ) {

		$menu_location = 'header_menu';

		if ( has_nav_menu( $menu_location ) ) {

			wp_nav_menu(
				array(
					'theme_location'  => $menu_location,
					'depth'           => 1,
					'menu_class'      => 'wsu-actions-submenu',
					'container_class' => 'menu-utility-menu-container',
				)
			);
		}

		if ( is_front_page() && is_singular() ) {

			$page_settings = wsuwp_spine_get_page_settings( get_the_ID() );

			$title           = ( ! empty( $page_settings['title'] ) ) ? $page_settings['title'] : get_the_title();
			$subtitle        = ( ! empty( $page_settings['subtitle'] ) ) ? $page_settings['subtitle'] : '';
			$img_src         = ( ! empty( $banner_image['src'] ) ) ? $banner_image['src'] : '';
			$img_alt         = ( ! empty( $banner_image['alt'] ) ) ? $banner_image['alt'] : '';
			$title_tag       = 'h1';
			$subtitle_before = false;
			$post_id         = get_the_ID();

			include wsuwp_spine_themes_get_plugin_dir() . 'theme-parts/banners/hero-banner.php';

		}

	} // End add_banner


	public function add_footer( $context ) {

		$spine_options = get_option( 'spine_options', array() );

		$unit_name      = ( ! empty( $spine_options['contact_department'] ) ) ? $spine_options['contact_department'] : 'Washington State University';
		$unit_url       = ( ! empty( $spine_options['contact_url'] ) ) ? $spine_options['contact_url'] : '';
		$street_address = ( ! empty( $spine_options['contact_streetAddress'] ) ) ? $spine_options['contact_streetAddress'] : '';
		$city_state     = ( ! empty( $spine_options['contact_addressLocality'] ) ) ? $spine_options['contact_addressLocality'] : '';
		$postal_code    = ( ! empty( $spine_options['contact_postalCode'] ) ) ? $spine_options['contact_postalCode'] : '';
		$phone          = ( ! empty( $spine_options['contact_telephone'] ) ) ? $spine_options['contact_telephone'] : '';
		$email          = ( ! empty( $spine_options['contact_email'] ) ) ? $spine_options['contact_email'] : '';

		include wsuwp_spine_themes_get_plugin_dir() . 'theme-parts/footers/hero-footer.php';

	} // End add_footer


	/**
	 * Add scripts off of the wp_enqueue_scripts action
	 *
	 * @since 0.0.2
	 */
	public function add_public_scripts() {

		wp_enqueue_style(
			'spine-theme-adams-css',
			wsuwp_spine_themes_get_plugin_url() . 'themes/adams/css/adams.css',
			array(),
			WSUWP_Plugin_Spine_Themes::$version
		);

	} // End add_public_scripts


} // End WSUWP_Scripts

$wsuwp_adams_theme = new WSUWP_Adams_Theme();
