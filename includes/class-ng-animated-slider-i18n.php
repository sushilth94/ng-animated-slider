<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       pridethemes.com
 * @since      1.0.0
 *
 * @package    Ng_Animated_Slider
 * @subpackage Ng_Animated_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ng_Animated_Slider
 * @subpackage Ng_Animated_Slider/includes
 * @author     Sushil Thapa <sushil.th94@gmail.com>
 */
class Ng_Animated_Slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ng-animated-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
