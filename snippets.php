<?php
function render_bilderslider($block)
{
    // allgemeine variablen
    $tImgSizeFlexbox = 'large';
    $tImgSizeIcon = 'medium';

    // Create id attribute allowing for custom "anchor" value.
    $id = 'bilderslider-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'bs-wrapper';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    // Load values and assign defaults.
    $gal = get_field('bs_galerie') ?: 'Bilder einfügen ...';
    $background_color = get_field('bs_background');

    ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="bs-gal bs-container">
            <?php

            /*
             * old gal from wpun !!! transform !!!
             */
            if ($gal) {
                echo '  <div class="bs-bg-wrapper">
                            <div class="container">
                                <div class="main-grid">
                                    <div class="bs-slider main-content-full-width">
                                        <div class="swiper-container swiper-bs-galerie">
                                            <div class="swiper-wrapper">';

                foreach ($gal as $tImage) {
                    echo '	        <div class="swiper-slide galerie-slide">
                                        <a href="' . $tImage['sizes'][$tImgSizeFlexbox] . '" class="slide">
                                            <figure class="">
                                                <img  class=""  src="' . $tImage['sizes'][$tImgSizeIcon] . '"/>
                                            </figure>
                                        </a>
                                    </div>';
                }

                echo '              <div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>';

                // frame container stuff ENDE
                echo '			            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            /* 
             * ENDE
             */
            ?>


        </div>
        <style type="text/css">
            #<?php echo $id; ?>.bs-container {
                background-color: <?php echo $background_color; ?>;
            }
        </style>
    </div>
    <?php
}
function ltg_swiper_enqueued_assets()
{
    wp_enqueue_script('swiper', plugin_dir_url(__FILE__) . 'js/swiper.js', array('jquery'), '1.0', true);
    wp_enqueue_script('swiper-call', plugin_dir_url(__FILE__) . 'js/swiper-call.js', array('jquery'), '1.0', true);
    wp_enqueue_style('slider', plugin_dir_url(__FILE__) .  'css/swiper.css', false, '1.1', 'all');
}
add_action('wp_enqueue_scripts', 'ltg_swiper_enqueued_assets');
