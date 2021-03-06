<?php

function theme_enqueue_styles() {
    wp_enqueue_style('avada-parent-stylesheet', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function avada_lang_setup() {
    $lang = get_stylesheet_directory() . '/languages';
    load_child_theme_textdomain('Avada', $lang);
}

add_action('after_setup_theme', 'avada_lang_setup');

function register_my_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

/*
 * increase_fontsize_invoicepdf
 * author: HungTT-FGC	
 * version: 1.0
 */
function increase_fontsize_invoicepdf() {
    ?>
        <style>
            #page {
                font-size: 1.1em;
            }
        </style>
    <?php
}

add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_free_label', 10, 2 );

function remove_free_label($full_label, $method) {
    $full_label = str_replace("(Free)","",$full_label);
    return $full_label;
}

add_action( 'wcdn_head', 'increase_fontsize_invoicepdf', 20 );