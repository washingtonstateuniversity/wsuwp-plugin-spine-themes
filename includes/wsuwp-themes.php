<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Themes {

	public function __construct() {

		add_filter( 'spine_theme_styles', array( $this, 'add_spine_styles' ) );

	} // End __construct


	public function add_spine_styles( $theme_styles ) {

		if ( is_array( $theme_styles ) ) {

			if ( array_key_exists( 'bookmark', $theme_styles ) ) {

				if ( is_super_admin() ) {

					$theme_styles['bookmark'] = 'Bookmark (Deprecated)';

				} else {

					unset( $theme_styles['bookmark'] );

				} // End if
			} // End if

			$new_themes = array(
				'rainier'  => 'Rainier',
				'baker'    => 'Baker',
				'Adams'    => 'Adams',
				'olympus'  => 'Olympus',
			);

			$theme_styles = array_merge( $theme_styles, $new_themes );

		} // End if

		return $theme_styles;

	} // End add_spine_styles


} // End WSUWP_Themes

$wsuwp_themes = new WSUWP_Themes();
