<?php
// Register Custom Post Types
if(!function_exists('ng_custom_post_type_register')):
    add_action('init', 'ng_custom_post_type_register',8);
    function ng_custom_post_type_register() {

        $postTypes = array(
            'Slider'         => array('postType' => 'Slider', 'dashicon' => 'dashicons-format-gallery', 'supports-thumbnail' => 'thumbnail', 'supports-editor' => 'editor', 'support-comment' => '' ),
        );

        foreach ($postTypes as $postType) {
            $dashicon = $postType['dashicon'];
            $supports = $postType['supports-thumbnail'];
            $editor   = $postType['supports-editor'];
            $comment = $postType['support-comment'];
            $singular_title = $postType['postType'];
            $labels = array(
                'name'=> $singular_title . 's',
                'singular_name' => $singular_title,
                'menu_name'=> $singular_title. 's',
                'name_admin_bar'=> $singular_title. 's',
                'parent_item_colon'=> __('Parent ', 'wp-custom-post-type'). $singular_title ,
                'all_items'=> __('All ', 'wp-custom-post-type'). $singular_title. 's',
                'add_new_item'=> __('Add New ', 'wp-custom-post-type'). $singular_title,
                'add_new'=> __('Add New ', 'wp-custom-post-type'). $singular_title,
                'new_item'=> __('New ', 'wp-custom-post-type'). $singular_title,
                'edit_item'=> __('Edit ', 'wp-custom-post-type'). $singular_title,
                'update_item'=> __('Update ', 'wp-custom-post-type'). $singular_title,
                'view_item'=> __('View ', 'wp-custom-post-type'). $singular_title,
                'search_items'=> __('Search ', 'wp-custom-post-type'). $singular_title,
                'not_found'=> __('Not found', 'wp-custom-post-type'),
                'not_found_in_trash'=> __('Not found in Trash', 'wp-custom-post-type'),
            );
            $args = array(
                'label'=> $singular_title,
                'description'=> $singular_title. __(' post type for themes', 'wp-custom-post-type'),
                'labels'=> $labels,
                'supports'=> array( 'title', $editor, $supports, $comment ),
                'hierarchical'=> true,
                'rewrite' => array(
                    'slug' => sanitize_title($singular_title)
                ),
                'public'=> true,
                'show_ui'=> true,
                'show_in_menu'=> true,
                'menu_position'=> 5,
                'menu_icon'=> $dashicon,
                'show_in_admin_bar'=> true,
                'show_in_nav_menus'=> true,
                'can_export'=> true,
                'has_archive'=> true,
                'exclude_from_search'=> false,
                'publicly_queryable'=> true,
                'capability_type'=>'page',
            );

          register_post_type($singular_title, $args);
          // flush_rewrite_rules();

          if ($singular_title == 'Slider') {
              register_taxonomy( 'slider_category', // register custom taxonomy - category
                  'slider',
                  array(
                      'hierarchical' => true,
                      'rewrite'       => array('slug' => 'slider_category'),
                      'labels' => array(
                          'name' => 'Slider categories',
                          'singular_name' => 'Slider category',
                      )
                  )
              );
          }


        }

    }
endif;
