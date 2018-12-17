<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Handles script enqueues for the plugin
 *
 * @since 0.0.2
 */
class WSUWP_Metaboxes {

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );

		add_action( 'save_post', array( $this, 'save_page_settings_metabox' ), 10, 1 );

	} // End __construct


	public function add_metaboxes() {

		add_meta_box(
			'wsuwp_spine_metabox_page_settings',
			'Page Settings',
			array( $this, 'do_wsuwp_spine_metabox_page_settings' )
		);

	} // End do_metaboxes


	public function do_wsuwp_spine_metabox_page_settings( $post ) {

		wp_nonce_field( 'spine_page_settings', 'wsuwp_spine_page_settings_verify' );

		$page_settings = get_post_meta( $post->ID, 'wsuwp_spine_page_settings', true );

		if ( apply_filters( 'wsuwp_spine_metabox_page_settings_show_titles', true, $post ) ) {

			$title    = ( ! empty( $page_settings['title'] ) ) ? $page_settings['title'] : '';
			$subtitle = ( ! empty( $page_settings['subtitle'] ) ) ? $page_settings['subtitle'] : '';

			include wsuwp_spine_themes_get_plugin_dir() . 'metabox-parts/page-settings-titles.php';

		} // End if

		do_action( 'wsuwp_spine_metabox_page_settings', $post );

	} // End do_wsuwp_spine_metabox_page_settings


	public function save_page_settings_metabox( $post_id ) {

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {

			return false;

		} // end if

		if ( isset( $_REQUEST['wsuwp_spine_page_settings_verify'] ) && isset( $_REQUEST['wsuwp_spine_page_settings'] ) ) {

			if ( ! wp_verify_nonce( $_REQUEST['wsuwp_spine_page_settings_verify'], 'spine_page_settings' ) ) {

				die( 'Security check' );

			} else {

				$text_fields = array(
					'title',
					'subtitle',
				);

				$text_fields = apply_filters( 'wsuwp_spine_page_settings_metabox_save_fields', $text_fields, $post_id );

				$to_save = ( is_array( $_REQUEST['wsuwp_spine_page_settings'] ) ) ? $_REQUEST['wsuwp_spine_page_settings'] : array();

				$save_array = array();

				foreach ( $text_fields as $text_field ) {

					if ( ! empty( $to_save[ $text_field ] ) ) {

						$value = sanitize_text_field( $to_save[ $text_field ] );

						if ( ! empty( $value ) ) {

							$save_array[ $text_field ] = $value;

						}
					} // End if
				} // End foreach

				update_post_meta( $post_id, 'wsuwp_spine_page_settings', $save_array );

			} // End if
		} // End if

	} // End save_metabox

} // End WSUWP_Metaboxes

$wsuwp_metaboxes = new WSUWP_Metaboxes();
