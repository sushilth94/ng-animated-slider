<?php
/**
 * Plugin Customizer
 *
 * @package    Ng_Animated_Slider
 * @subpackage Ng_Animated_Slider/inc
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ng_animated_slider_customize_register( $wp_customize ) {
    $ng_theme_options = ng_animated_slider_theme_options();


    $wp_customize->add_section(
        'ng_animated_slider_options',
        array(
            'title' => esc_html__( 'NG Animated Slider Options','ng-animated-slider' ),
            'capability'=>'edit_theme_options',
            'priority' => 1,
        )
    );


        $wp_customize->add_setting( 'ng_animated_slider_theme_options[banner_content_align]', array(
          'capability' => 'edit_theme_options',
          'default' => 'center',
          'type' => 'option',
        ) );

        $wp_customize->add_control( 'ng_animated_slider_theme_options[banner_content_align]', array(
          'type' => 'radio',
          'section' => 'ng_animated_slider_options', // Add a default or your own section
          'label' =>esc_attr( __('Choose Content Align', 'ng-animated-slider') ),
          'description' => esc_attr( __('Choose Where you want your Slider Content?', 'ng-animated-slider') ),
          'choices' => array(
            'left' => esc_attr( __('Left Align', 'ng-animated-slider') ),
            'center' => esc_attr( __('Center Align', 'ng-animated-slider') ),
            'right' => esc_attr( __('Right Align', 'ng-animated-slider') ),
          ),
        ) );

        $wp_customize->add_setting('ng_animated_slider_theme_options[ng_slider_height]',
        array(
            'default' => $ng_theme_options['ng_slider_height'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('ng_animated_slider_theme_options[ng_slider_height]',
        array(
            'label' => esc_html__('Slider Height', 'ng-animated-slider'),
            'description' => esc_attr( __('Enter Slider Height in px', 'ng-animated-slider') ),
            'section' => 'ng_animated_slider_options',
            'type' => 'text',
        ));

        $wp_customize->add_setting( 'ng_animated_slider_theme_options[ng_slider_layout]', array(
          'capability' => 'edit_theme_options',
          'default' => 'layout1',
          'type' => 'option',
        ) );

        $wp_customize->add_control( 'ng_animated_slider_theme_options[ng_slider_layout]', array(
          'type' => 'radio',
          'section' => 'ng_animated_slider_options', // Add a default or your own section
          'label' =>esc_attr( __('Choose Slider Animation', 'ng-animated-slider') ),
          'choices' => array(
            'layout1' => esc_attr( __('Layout1', 'ng-animated-slider') ),
            'layout2' => esc_attr( __('Layout2', 'ng-animated-slider') ),
            'layout3' => esc_attr( __('Layout3', 'ng-animated-slider') ),
            'layout4' => esc_attr( __('Layout4', 'ng-animated-slider') ),
            'layout5' => esc_attr( __('Layout5', 'ng-animated-slider') ),
            'layout6' => esc_attr( __('Layout6', 'ng-animated-slider') ),
            'layout7' => esc_attr( __('Layout7', 'ng-animated-slider') ),
          ),
        ) );

        $wp_customize->add_setting('ng_animated_slider_theme_options[ng_slider_title_size]',
        array(
            'default' => $ng_theme_options['ng_slider_title_size'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('ng_animated_slider_theme_options[ng_slider_title_size]',
        array(
            'label' => esc_html__('Slider Title Size', 'ng-animated-slider'),
            'description' => esc_attr( __('Enter Slider Title size in px', 'ng-animated-slider') ),
            'section' => 'ng_animated_slider_options',
            'type' => 'text',
        ));

        $wp_customize->add_setting('ng_animated_slider_theme_options[ng_slider_desc_size]',
        array(
            'default' => $ng_theme_options['ng_slider_desc_size'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('ng_animated_slider_theme_options[ng_slider_desc_size]',
        array(
            'label' => esc_html__('Slider Description Size', 'ng-animated-slider'),
            'description' => esc_attr( __('Enter Slider description size in px', 'ng-animated-slider') ),
            'section' => 'ng_animated_slider_options',
            'type' => 'text',
        ));

        $wp_customize->add_setting('ng_animated_slider_theme_options[ng_slider_desc_exp]',
        array(
            'default' => $ng_theme_options['ng_slider_desc_exp'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('ng_animated_slider_theme_options[ng_slider_desc_exp]',
        array(
            'label' => esc_html__('Description Excerpt length', 'ng-animated-slider'),
            'description' => esc_attr( __('Enter Description Excerpt length', 'ng-animated-slider') ),
            'section' => 'ng_animated_slider_options',
            'type' => 'text',
        ));
}
add_action( 'customize_register', 'ng_animated_slider_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ng_animated_slider_customize_preview_js() {
	wp_enqueue_script( 'ng-slider-customizer', plugin_dir_path( __FILE__ ) . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ng_animated_slider_customize_preview_js' );




