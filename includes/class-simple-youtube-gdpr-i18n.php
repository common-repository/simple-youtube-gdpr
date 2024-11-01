<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://alexeyvolkov.com/
 * @since      0.6
 *
 * @package    Simple_Youtube_Gdpr
 * @subpackage Simple_Youtube_Gdpr/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.6
 * @package    Simple_Youtube_Gdpr
 * @subpackage Simple_Youtube_Gdpr/includes
 * @author     Alexey Volkov <alexey.a.volkov@pm.me>
 */
class Simple_Youtube_Gdpr_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.6
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'simple-youtube-gdpr',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
