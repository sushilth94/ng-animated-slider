<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              pridethemes.com
 * @since             1.0.2
 * @package           Ng_Animated_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       NG Animated Slider
 * Plugin URI:        pridethemes.com/plugins/ng-animated-slider
 * Description:       Awesome animated SVG Frame Slideshow with super smooth hardware accelerated transitions.It is a responsive and device friendly slider which works perfectly on all major devices.It has 7 different awesome animation layout.
 * Version:           1.0.2
 * Author:            Sushil Thapa
 * Author URI:        pridethemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ng-animated-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NG_ANIMATED_SLIDER_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ng-animated-slider-activator.php
 */
function activate_ng_animated_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ng-animated-slider-activator.php';
	Ng_Animated_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ng-animated-slider-deactivator.php
 */
function deactivate_ng_animated_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ng-animated-slider-deactivator.php';
	Ng_Animated_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ng_animated_slider' );
register_deactivation_hook( __FILE__, 'deactivate_ng_animated_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . '/inc/ng-customizer-control.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-ng-animated-slider.php';
require plugin_dir_path( __FILE__ ) . 'includes/ng-custom-functions.php';

/**
 * Customizer additions.
 */

require plugin_dir_path( __FILE__ ) . '/inc/customizer-sections.php';

require plugin_dir_path( __FILE__ ) . '/inc/ng-slider-customizer-default.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ng_animated_slider() {

	$plugin = new Ng_Animated_Slider();
	$plugin->run();

}
run_ng_animated_slider();

function ng_animated_slider_scripts() {
  $ng_theme_options = ng_animated_slider_theme_options();
  $animationn_layout = $ng_theme_options['ng_slider_layout'];

    wp_enqueue_style( 'ng-bootstrap-css', plugin_dir_url( __FILE__ ) . 'public/css/bootstrap.css');
    wp_enqueue_style( 'ng-fontawesome-css', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.css');
    wp_enqueue_script( 'ng-imagesloaded-js', plugin_dir_url( __FILE__ ) . 'public/js/imagesloaded.min.js' , array('jquery') , false, true);
    wp_enqueue_script( 'ng-anime_min-js', plugin_dir_url( __FILE__ ) . 'public/js/anime.min.js' , array('jquery') , false, true);

    wp_register_script( 'my_custom_demo1', plugin_dir_url( __FILE__ ) . 'public/js/demo1.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo2', plugin_dir_url( __FILE__ ) . 'public/js/demo2.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo3', plugin_dir_url( __FILE__ ) . 'public/js/demo3.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo4', plugin_dir_url( __FILE__ ) . 'public/js/demo4.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo5', plugin_dir_url( __FILE__ ) . 'public/js/demo5.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo6', plugin_dir_url( __FILE__ ) . 'public/js/demo6.js' , array('jquery') , false, true);
    wp_register_script( 'my_custom_demo7', plugin_dir_url( __FILE__ ) . 'public/js/demo7.js' , array('jquery') , false, true);

    wp_enqueue_script( 'my_custom_plugin', plugin_dir_url( __FILE__ ) . 'public/js/custom-plugin.js' , array('jquery') , false, true);
}
add_action( 'wp_enqueue_scripts', 'ng_animated_slider_scripts' );


