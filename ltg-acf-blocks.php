<?php
/*
Plugin Name: Verschiedene Blocks für Tanja
Description: ( 1.) Block für Bilder und der Auswahl eines Bilderrahmens. Benötigt ACF Pro. 
Version: 0.1
Author: nikl
*/


add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'bilderrahmen',
            'title'             => __('Bilderrahmen'),
            'description'       => __('Ein Bild mit Bilderrahmen'),
            'render_callback'   => 'render_bilderrahmen',

            'category'          => 'formatting',
            'icon'              => '<svg><path d="M10,13.31c2.51,0,4.56,1.63,4.56,3.64H15.7c0-2.64-2.56-4.78-5.7-4.78S4.3,14.31,4.3,17H5.44C5.44,14.94,7.49,13.31,10,13.31Zm0-1.53A3.47,3.47,0,1,0,6.53,8.31,3.47,3.47,0,0,0,10,11.78ZM10,6A2.33,2.33,0,1,1,7.67,8.31,2.33,2.33,0,0,1,10,6Zm10,4a2,2,0,0,0-1.37-1.86V3.8A1.94,1.94,0,0,0,18.06,0,2,2,0,0,0,16.2,1.37H11.77a1.95,1.95,0,0,0-3.72,0H3.8A1.94,1.94,0,0,0,0,1.94,2,2,0,0,0,1.37,3.8V8.14a1.95,1.95,0,0,0,0,3.72V16.2A1.94,1.94,0,0,0,1.94,20,2,2,0,0,0,3.8,18.63H8.05a1.95,1.95,0,0,0,3.72,0H16.2a1.94,1.94,0,1,0,2.43-2.43V11.86A2,2,0,0,0,20,10Zm-2.51,7.49h-15v-15h15Z"/></svg>',
            'keywords'          => array('bilderrahmen', 'quote'),
            'enqueue_style'     => plugin_dir_url(__FILE__) . 'css/bilderrahmen.css',
        ));
        acf_register_block_type(array(
            'name'              => 'bilderslider',
            'title'             => __('Bilderslider'),
            'description'       => __('Ein Slider für eine Galerie von Bildern'),
            'render_callback'   => 'render_bilderslider',

            'category'          => 'formatting',
            'icon'              => '<svg><path d="M3.5,1.1h15V3.5h1.1V0H2.4V3.5H3.5Zm15,15H3.5V13.67H2.4v3.51H19.57V13.67h-1.1Zm-4-9.18A3.47,3.47,0,1,0,11,10.37,3.48,3.48,0,0,0,14.46,6.9Zm-5.8,0A2.33,2.33,0,1,1,11,9.23,2.33,2.33,0,0,1,8.66,6.9ZM5.28,15.53H6.43c0-2,2-3.63,4.56-3.63s4.56,1.63,4.56,3.63h1.14c0-2.63-2.56-4.77-5.7-4.77S5.28,12.9,5.28,15.53ZM21.81,8.2,18.38,4.77a.54.54,0,0,0-.78,0,.56.56,0,0,0,0,.78l3,3-3,3a.56.56,0,0,0,0,.78.56.56,0,0,0,.78,0L21.81,9A.59.59,0,0,0,22,8.59.55.55,0,0,0,21.81,8.2ZM4,12.57a.59.59,0,0,0,.39-.16.56.56,0,0,0,0-.78l-3-3,3-3a.56.56,0,0,0,0-.78.54.54,0,0,0-.78,0L.16,8.2A.56.56,0,0,0,.16,9l3.43,3.43A.59.59,0,0,0,4,12.57Zm3.85,6.27a.8.8,0,1,0,.8.8A.8.8,0,0,0,7.83,18.84Zm3.16,0a.8.8,0,1,0,.8.8A.8.8,0,0,0,11,18.84Zm3.15,0a.8.8,0,0,0,0,1.6.8.8,0,0,0,0-1.6Z"/></svg>',
            'keywords'          => array('bilder', 'galerie', 'slider'),
            'enqueue_style'     => plugin_dir_url(__FILE__) . 'css/bilderslider.css',
        ));
    }
}



/**
 * Bilderrahmen Block Template.
 */

function render_bilderrahmen($block)
{
    // Create id attribute allowing for custom "anchor" value.
    $id = 'bilderrahmen-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'br-wrapper';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    // Load values and assign defaults.
    $bild = get_field('br_bild') ?: 'Bild einfügen ...';
    $rahmen = get_field('br_rahmen') ?: 'Bild Rahmen';
    $bsBackgroundColor = get_field('br_background');
    $size = get_field('br_size') * 8;

?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="br-container-<?php echo $rahmen; ?> br-container">
            <div class="br-rahmen-<?php echo $rahmen; ?> br-rahmen"></div>
            <div class="br-image">
                <?php echo wp_get_attachment_image($bild, 'full'); ?>
            </div>
        </div>
        <style type="text/css">
            #<?php echo $id; ?> .br-container {
                max-width: <?php echo $size; ?>px;
                float: left;
            }
        </style>
    </div>
<?php
}


/**
 * Bilderslider Block Template.
 */

function render_bilderslider($block)
{
    // allgemeine variablen
    $tImgSizeFlexbox = 'large';
    $tImgSizeIcon = 'large';

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
    $bsGal = get_field('bs_galerie') ?: 'Bilder einfügen ...';
    $bsBackgroundColor = get_field('bs_background');
    $bsNavigationColor = get_field('bs_navicolor');
    if (empty($bsNavigationColor)) {
        $bsNavigationColor = '#333333';
    }
    $bsNavigationColorSVG = preg_replace('/#/', '%23', $bsNavigationColor);
    $bsNavigation = get_field('bs_navigation');
    $bsPagination = get_field('bs_pagination');
    $bsSlidesPerView = get_field('bs_slidesperview');
    $bsSpaceBetween = get_field('bs_spacebetween');
    $bsHeight = get_field('bs_height');
    $bsWidth = get_field('bs_width');
    $bsTranstempo = get_field('bs_transtempo')*1000;
    $bsAutoplay = get_field('bs_autoplay');
    $bsAutoplayTime = get_field('bs_autoplaytime') * 1000;



?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> bs-bilderslider">
        <?php

        $bsid = 'swiper-bs-galerie-' . $block['id'];
        if ($bsGal) {
        ?>
            <div id="<?php echo esc_attr($bsid); ?>" class="swiper-container ">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($bsGal as $tImage) {
                    ?>
                        <figure class="swiper-slide galerie-slide">
                            <img class="" src="<?php echo $tImage['sizes'][$tImgSizeIcon]; ?>" />
                        </figure>
                    <?php
                    }
                    ?>
                </div>
                <?php if ($bsNavigation) { ?>
                    <div>
                        <div class="swiper-button-prev swiper-button-prev-<?php echo $block['id'] ?>"></div>
                        <div class="swiper-button-next swiper-button-next-<?php echo $block['id'] ?>"></div>
                    </div>
                <?php } ?>

                <?php if ($bsPagination) { ?>
                    <div class="swiper-pagination"></div>
                <?php } ?>


            </div>
        <?php
        }
        /* 
             * ENDE
             */
        ?>


        <style type="text/css">
            #<?php echo $id; ?> .bs-container {
                background-color: <?php echo $bsBackgroundColor; ?>;
            }

            #<?php echo $bsid; ?>  {
                <?php if($bsHeight){?>
                    max-height: <?php echo $bsHeight;?>px;
                    <?php } ?>
                    <?php if($bsWidth){?>
                    max-width: <?php echo $bsWidth;?>px;
                    <?php } ?>
            }


            #<?php echo $id; ?> .swiper-button-prev,
            #<?php echo $id; ?> .swiper-container-rtl .swiper-button-next {
                background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'<?php echo $bsNavigationColorSVG; ?>'%2F%3E%3C%2Fsvg%3E");
                left: 10px;
                right: auto;
            }

            #<?php echo $id; ?> .swiper-button-next,
            #<?php echo $id; ?> .swiper-container-rtl .swiper-button-prev {
                background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'<?php echo $bsNavigationColorSVG; ?>'%2F%3E%3C%2Fsvg%3E");
                right: 10px;
                left: auto;
            }

            #<?php echo $id; ?> .swiper-pagination-bullet-active {
                background: <?php echo $bsNavigationColor; ?>;
            }
        </style>
        <script>
            jQuery(document).ready(function() {
                //initialize swiper when document ready
                var swiperHaendlerBilder = new Swiper('#<?php echo esc_attr($bsid); ?>', {

                    centeredSlides: true,
                    spaceBetween: <?php echo $bsSpaceBetween ?>,
                    slidesPerView: <?php echo $bsSlidesPerView ?>,
                    loop: true,
                    speed: <?php echo $bsTranstempo; ?>,

                    <?php if ($bsAutoplay) { ?>
                        autoplay: {
                            delay: <?php echo $bsAutoplayTime; ?>,
                        },
                    <?php } ?>

                    <?php if ($bsPagination) { ?>
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                    <?php } ?>

                    <?php if ($bsNavigation) { ?>
                        navigation: {
                            nextEl: '.swiper-button-next-<?php echo $block['id'] ?>',
                            prevEl: '.swiper-button-prev-<?php echo $block['id'] ?>',
                        },
                    <?php } ?>
                })
            });
        </script>
    </div>
<?php
}
function ltg_swiper_enqueued_assets()
{
    wp_enqueue_script('swiper', plugin_dir_url(__FILE__) . 'js/swiper.js', array('jquery'), '1.0', true);
    wp_enqueue_style('slider', plugin_dir_url(__FILE__) .  'css/swiper.css', false, '1.1', 'all');
    wp_enqueue_style('slider', plugin_dir_url(__FILE__) .  'css/bilderslider.css', false, '1.1', 'all');
}
add_action('wp_enqueue_scripts', 'ltg_swiper_enqueued_assets');
function ltg_swiper_enqueued_block_assets()
{
    wp_enqueue_script('swiper', plugin_dir_url(__FILE__) . 'js/swiper.js', array('jquery'), '1.0', true);
    wp_enqueue_style('slider', plugin_dir_url(__FILE__) .  'css/swiper.css', false, '1.1', 'all');
    wp_enqueue_style('bs-bilderslider', plugin_dir_url(__FILE__) .  'css/bilderslider.css', false, '1.1', 'all');
}
add_action('enqueue_block_assets', 'ltg_swiper_enqueued_block_assets');
