<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add Baker theme actions and filters.
 *
 * @since 0.0.2
 */
class WSUWP_Baker_Theme {

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

		$post_type = get_post_type();

		if ( 'page.php' === $context || 'page' === $post_type ) {

			$page_settings = wsuwp_spine_get_page_settings( get_the_ID() );

			$title     = ( ! empty( $page_settings['title'] ) ) ? $page_settings['title'] : get_the_title();
			$subtitle  = ( ! empty( $page_settings['subtitle'] ) ) ? $page_settings['subtitle'] : '';
			$img_src   = false;
			$img_alt   = false;
			$post_id   = get_the_ID();

			global $post;

			$post_content = ( isset( $post->post_content ) ) ? $post->post_content : '';
			$has_h1 = ( strpos( $post_content, '<h1' ) !== false ) ? true : false;
			$title_tag = ( $has_h1 ) ? 'div' : 'h1';

			if ( ! $has_h1 || ( $has_h1 && ! empty( $img_src ) ) ) {

				include wsuwp_spine_themes_get_plugin_dir() . 'theme-parts/banners/hero-banner.php';

			} // End if

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
			'spine-theme-baker-css',
			wsuwp_spine_themes_get_plugin_url() . 'themes/baker/css/baker.css',
			array(),
			WSUWP_Plugin_Spine_Themes::$version
		);

	} // End add_public_scripts


} // End WSUWP_Scripts

$wsuwp_baker_theme = new WSUWP_Baker_Theme();
