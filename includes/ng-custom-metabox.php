<?php if (!function_exists('wp_custom_post_type_metabox_register')) {
    function wp_custom_post_type_metabox_register() {


        add_meta_box(
            'wp_custom_post_metabox_registration',
            __('Slider Extra Settings ','wp-custom-post-type'),
            'wp_custom_post_slider_meta_box',
            'slider',
            'normal'
        );


    }
    add_action('add_meta_boxes', 'wp_custom_post_type_metabox_register');
}


// The Callback
function wp_custom_post_slider_meta_box() {
    // Field Array
    $prefix = 'wp_custom_post_slider_';
    $custom_meta_fields = array();

    $my_theme = wp_get_theme();
    $theme = $my_theme->get( 'TextDomain' );
        $custom_meta_fields = array(

            array(
                'label'=> 'Button Title',
                'desc'  => '',
                'id'    => $prefix.'btntxt',
                'type'  => 'text'
            ),
            array(
                'label'=> 'Button Link',
                'desc'  => '',
                'id'    => $prefix.'link',
                'type'  => 'text'
            ),

        );

    global $post;
    // Use nonce for verification
    echo '<input type="hidden" name="wp_custom_post_metabox_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($custom_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
        switch($field['type']) {
            // case items will go here
            // text
            case 'text':
                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
                            <br /><span class="description">'.$field['desc'].'</span>';
                break;

            // textarea
            case 'textarea':
                echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                            <br /><span class="description">'.$field['desc'].'</span>';
                break;

            // repeatable
            case 'repeatable':
                echo '
                                <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                $i = 0;

                if ($meta) {
                    foreach($meta as $row) {
                        echo '<li>
                                            <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />';?>
                        <?php
                        echo '<a class="repeatable-remove button" href="#">-</a></li>';
                        $i++;
                    }
                } else {
                    echo '<li>
                                       <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$meta.'" size="30" />

                                            <a class="repeatable-remove button" href="#">-</a></li>';
                }
                echo '</ul><a class="repeatable-add button" href="#">Add</a>
                            ';
                break;

            case 'select':
                $items = array (
                    'ion-wineglass', 'ion-umbrella', 'ion-plane'
                );
                echo '<ul class="custom_repeatable"><li><select name="'.$field['id'].'" id="'.$field['id'].'">
                                    <option value="">Select Icon</option>'; // Select One
                foreach($items as $item) {
                    echo '<option value="'.$item.'"',$meta == $item ? ' selected="selected"' : '','>'.$item.'</option>';
                } // end foreach
                echo '</select><br /><span class="description">'.$field['desc'].'</span></li></ul>';
                break;

            // checkbox
            case 'checkbox':
                echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
                            <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                break;
        } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}


// Save the Data
function save_custom_meta($post_id, $post) {

    if ($post->post_type == 'slider') {

        $prefix = 'wp_custom_post_slider_';
        $custom_meta_fields = array();
        $my_theme = wp_get_theme();
        $theme = $my_theme->get( 'TextDomain' );
            $custom_meta_fields = array(

                array(
                    'label'=> 'Button Title',
                    'desc'  => '',
                    'id'    => $prefix.'btntxt',
                    'type'  => 'text'
                ),
                array(
                    'label'=> 'Button Link',
                    'desc'  => '',
                    'id'    => $prefix.'link',
                    'type'  => 'text'
                ),

            );


        if (empty($_POST['wp_custom_post_metabox_nonce'])) {
            return $post_id;
        }
        // verify nonce
        if (!wp_verify_nonce($_POST['wp_custom_post_metabox_nonce'], basename(__FILE__)))
            return $post_id;
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
        // check permissions
        if (!current_user_can('edit_post', $post->ID))
            return $post->ID;

        // loop through fields and save the data
        foreach ($custom_meta_fields as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        } // end foreach
    }
}
add_action('save_post', 'save_custom_meta', 1, 2);


