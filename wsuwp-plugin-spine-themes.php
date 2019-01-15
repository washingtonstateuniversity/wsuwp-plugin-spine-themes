<?php namespace WSUWP\Plugin_Spine_Themes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Plugin_Spine_Themes {

	/**
	 * Version of the plugin to use.
	 *
	 * @since 0.0.1
	 *
	 * @var string $version Semantic Version
	 */
	public static $version = '1.0.0';


	/**
	 * Instance of WSUWP_Plugin_Spine_Themes for singleton pattern.
	 *
	 * @since 0.0.1
	 *
	 * @var WSUWP_Plugin_Spine_Themes|null $instance
	 */
	protected static $instance = null;


	/**
	 * Get current instance or create one if null.
	 *
	 * @since 0.0.1
	 *
	 * @return WSUWP_Plugin_Spine_Themes Instance of WSUWP_Plugin_Spine_Themes
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {

			self::$instance = new WSUWP_Plugin_Spine_Themes();

			self::$instance->init_plugin();

		} // End if

		return self::$instance;

	} // End get_instance


	/**
	 * Init the plugin. Called on creation of an instance.
	 *
	 * @since 0.0.1
	 */
	private function init_plugin() {

		include_once __DIR__ . '/includes/wsuwp-themes.php';

		include_once __DIR__ . '/includes/wsuwp-scripts.php';

		include_once __DIR__ . '/includes/wsuwp-metaboxes.php';

	} // End init_plugin

	/**
	 * Make constructor private, so nobody can call "new Class".
	 */
	private function __construct() {}

	/**
	 * Make clone magic method private, so nobody can clone instance.
	 */
	private function __clone() {}

	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */
	private function __sleep() {}

	/**
	 * Make wakeup magic method private, so nobody can unserialize instance.
	 */
	private function __wakeup() {}

} // End WSUWP_Plugin_Spine_Themes
