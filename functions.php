<?php

/**
 * Get plugin base url path.
 *
 * @since 0.0.2
 *
 * @return string Plugin url.
 */
function wsuwp_spine_themes_get_plugin_url() {

	return plugin_dir_url( __FILE__ );

} // End wsuwp_spine_themes_get_plugin_url

/**
 * Get plugin base directory path
 *
 * @since 0.0.2
 *
 * @return string Plugin directory.
 */
function wsuwp_spine_themes_get_plugin_dir() {

	return plugin_dir_path( __FILE__ );

} // End wsuwp_spine_themes_get_plugin_dir

/**
 * Get the current spine theme.
 *
 * @since 0.0.2
 *
 * @return string Current theme or empty string in not set.
 */
function wsuwp_spine_themes_get_theme() {

	$spine_options = get_option( 'spine_options', array() );

	$theme_type = ( is_array( $spine_options ) && ! empty( $spine_options['theme_style'] ) ) ? $spine_options['theme_style'] : '';

	return $theme_type;

} // End wsuwp_spine_themes_get_theme


/**
 * Get spine theme page settings.
 *
 * @since 0.0.2
 *
 * @return array Current page settings.
 */
function wsuwp_spine_get_page_settings( $post_id ) {

	if ( $post_id ) {

		$spine_page_settings = get_post_meta( $post_id, 'wsuwp_spine_page_settings', true );

		return ( is_array( $spine_page_settings ) ) ? $spine_page_settings : array();

	} else {

		return array();

	} // End if

} // End wsuwp_spine_get_page_settings

/**
 * Get post image data array.
 *
 * @since 0.0.2
 *
 * @return array Post image array.
 */
function wsuwp_spine_get_post_image_data( $post_id, $size ) {

	$image = array();

	if ( $post_id && has_post_thumbnail( $post_id ) ) {

		$img_id = get_post_thumbnail_id( $post_id );

		$img_url_array = wp_get_attachment_image_src( $img_id, $size, true );

		$image['id'] = $img_id;

		$image['src'] = $img_url_array[0];

		$image['alt'] = get_post_meta( $img_id, '_wp_attachment_image_alt', true );

	} // End if

	return $image;

} // End wsuwp_spine_get_post_image_data


/**
 * Register theme sidebars
 *
 * @since 0.0.2
 *
 * @param string $sidebar Sidebar ID
 */
function wsuwp_spine_register_sidebar( $sidebar ) {

	switch ( $sidebar ) {

		case 'footer':
			$args = array(
				'name'          => 'Footer Widgets',
				'id'            => 'footer_widgets',
				'before_widget' => '<div id="%1$s" class="widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
			);
			register_sidebar( $args );
			break;
	} // End switch

} // End wsuwp_spine_register_sidebar
