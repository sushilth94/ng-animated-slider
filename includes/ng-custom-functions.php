<?php

if (!function_exists('wp_custom_post_slider_content')) {

function wp_custom_post_slider_content($atts = null){
  $ng_theme_options = ng_animated_slider_theme_options();
  $banner_align = $ng_theme_options['banner_content_align'];
  $ng_slider_height = $ng_theme_options['ng_slider_height'];
  $animation_layout = $ng_theme_options['ng_slider_layout'];
  $title_size = $ng_theme_options['ng_slider_title_size'];
  $desc_size = $ng_theme_options['ng_slider_desc_size'];
  $desc_exp = $ng_theme_options['ng_slider_desc_exp'];

     extract(shortcode_atts( array(
                'cat' => '',
                'layout' => '',
                ), $atts )
        );

   $cat    = (!empty($cat)? $cat :'');

         if($cat != ''){
         $slider_arg = array(
                        'post_type' => 'slider',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'orderby' => 'menu_order date',
                        'order' => 'desc',
                         'tax_query' => array(
                                array(
                            'taxonomy' => 'slider_category',
                            'field' => 'term_id',
                            'terms' => $cat,
                            )
                        )
                    );}
                    else{
                       $slider_arg = array(
                        'post_type' => 'slider',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'orderby' => 'menu_order date',
                        'order' => 'desc',
                      );
                    } ?>

                <?php

            $slider_query = new WP_Query($slider_arg);
            $count_posts = wp_count_posts('slider');
            $published_posts = $count_posts->publish;


            ob_start();
          $slider_choice = ( empty($layout)?$ng_theme_options['ng_slider_layout']:$layout );
          if('layout1' == $slider_choice) {
            wp_enqueue_script( 'my_custom_demo1' );
              ?>
              <div class="demo-1 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides">
                    <?php
              if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;
                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);


                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>

                          </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                <?php endif;
                 wp_reset_query(); ?>
                 </div>
                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>


          <?php


        }
        else if('layout2' == $slider_choice){
            wp_enqueue_script( 'my_custom_demo2' );?>

              <div class="demo-2 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides">
                    <?php
              if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;
                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);


                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>

                          </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                <?php endif;
                 wp_reset_query(); ?>
                 </div>
                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }

        else if('layout3' == $slider_choice){
          wp_enqueue_script( 'my_custom_demo3' );?>

              <div class="demo-3 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides">
                    <?php
              if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;
                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);


                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>

                          </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                <?php endif;
                 wp_reset_query(); ?>
                 </div>
                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }

        else if('layout4' == $slider_choice){
          wp_enqueue_script( 'my_custom_demo4' );?>
              <div class="demo-4 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides">
                    <?php
              if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;
                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);


                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>

                          </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                <?php endif;
                 wp_reset_query(); ?>
                 </div>
                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }

        else if('layout5' == $slider_choice){
          wp_enqueue_script( 'my_custom_demo5' );?>
              <div class="demo-5 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides">
                    <?php
              if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;
                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);


                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>

                          </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                <?php endif;
                 wp_reset_query(); ?>
                 </div>
                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }

        else if('layout6' == $slider_choice){
          wp_enqueue_script( 'my_custom_demo6' );?>
              <div class="demo-6 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides  slides--images">
                    <?php
                      if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;

                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);
                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>
                              </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                    <?php endif;
                     wp_reset_query(); ?>
                 </div>





                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }

        else if('layout7' == $slider_choice){
        wp_enqueue_script( 'my_custom_demo7' );?>
              <div class="demo-7 large-animated-slider">
                <div class="slideshow" style="height: <?php echo esc_attr($ng_slider_height); ?>">
                    <div class="slides  slides--images">
                    <?php
                      if ($slider_query->have_posts()):

                     while ($slider_query->have_posts()) : $slider_query->the_post();
                        global $post;

                     $slider_btntxt_one = get_post_meta($post->ID,'wp_custom_post_slider_btntxt', true);
                     $slider_btnlnk_one = get_post_meta($post->ID,'wp_custom_post_slider_link', true);
                        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $image_src[0];
                        if (!empty($image_src)) {
                            $image_style = "style='background-image:url(" . esc_url($url) . ")'"; ?>
                        <?php } else {
                            $image_style = "";
                        }
                        // $excerpt                     = substr(get_the_excerpt(), 0 , 160);
                        ?>


                      <div class="slide">
                          <div class="container">
                              <div class="animated-slider-wrap <?php echo esc_attr($banner_align); ?>">
                              <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                             <h2 class="slide__title" style="font-size: <?php echo esc_attr($title_size); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo the_title(); ?></a></h2>
                              <p class="slide__desc" style="font-size: <?php echo esc_attr($desc_size); ?>"><?php echo wp_kses_post(ng_animated_slider_get_excerpt(get_the_ID(), $desc_exp)); ?></p>
                                <?php if ($slider_btntxt_one){ ?>
                                <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default"><?php echo esc_html($slider_btntxt_one) ?></a> <?php }
                                else{ ?>
                                  <a href="<?php echo esc_url($slider_btnlnk_one); ?>" class="slide__link btn btn-default display-none"><?php echo esc_html($slider_btntxt_one) ?></a> <?php
                                  } ?>
                              </div>
                          </div>
                      </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  ?>
                    <?php endif;
                     wp_reset_query(); ?>
                 </div>





                 <?php
                 if($published_posts == '1' ) {?>
                  <nav class="slidenav display-none">
                      <button class="slidenav__item slidenav__item--prev">Previous</button>
                      <span>/</span>
                      <button class="slidenav__item slidenav__item--next">Next</button>
                  </nav>
                  <?php } else{ ?>
                    <nav class="slidenav">
                        <button class="slidenav__item slidenav__item--prev">Previous</button>
                        <span>/</span>
                        <button class="slidenav__item slidenav__item--next">Next</button>
                    </nav>
                    <?php } ?>
              </div>
          </div>
        <?php
        }
                $output = ob_get_clean();
                 return $output;



    }
    add_shortcode( 'slider', 'wp_custom_post_slider_content' );
    }
