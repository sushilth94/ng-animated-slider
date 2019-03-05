<?php
if (!function_exists('ng_animated_slider_theme_options')) :
    function ng_animated_slider_theme_options()
    {
        $defaults = array(

            //banner section
            'banner_content_align' => 'center',
            'ng_slider_height' => '500px',
            'ng_slider_layout' => 'layout1',
            'ng_slider_title_size' => '74px',
            'ng_slider_desc_size' => '21px',
            'ng_slider_desc_exp' => '100',
            'buy_me_coffee' => '',
        );

        $options = get_option('ng_animated_slider_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
