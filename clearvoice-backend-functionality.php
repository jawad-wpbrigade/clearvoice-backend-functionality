<?php
/**
 * Plugin Name: Clearvoice Backend Functionality
 * Description: Custom Elementor Widgets and CPT's for ClearVoice
 * Plugin URI:  https://www.clearvoice.com/
 * Version:     1.0.0
 * Author:      Jawad
 * Author URI:  https://wpbrigade.com
 * Text Domain: ClearVoice-backend-functionality
 *
 * Elementor tested up to: 3.9.2
 * Elementor Pro tested up to: 3.9.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Clearvoice_Backend_Functionality {

	const VERSION = '1.0.0';
	const ELEMENTOR_MINIMUM_VERSION = '3.0.0';
	const PHP_MINIMUM_VERSION = '7.4';

	private static $_instance = null;

	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		$this->includes();
	}

	/**
	 * Include files for Widgets and CPT
	 */
	public function includes() {
		require_once __DIR__ . '/clearvoice-cpt-taxonomy.php';
		require_once __DIR__ . '/clearvoice-elementor-widgets.php';
	}

	/**
	 * Load text domain.
	 */
	public function i18n() {
		load_plugin_textdomain( 'ClearVoice-backend-functionality' );
	}

	public static function get_instance() {

		if ( null == self::$_instance ) {
			self::$_instance = new Self();
		}

		return self::$_instance;

	}

}

Clearvoice_Backend_Functionality::get_instance();
