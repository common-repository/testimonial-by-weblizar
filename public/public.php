<?php

/**
 * Testimonial Public file
 *
 * @package Responsive Testimonial Slider
 */

defined('ABSPATH') || die();
require_once(WL_RTS_PLUGIN_DIR_PATH . 'public/wl-rts-language.php');
require_once(WL_RTS_PLUGIN_DIR_PATH . 'public/inc/wl-rts-testimonial.php');
require_once(WL_RTS_PLUGIN_DIR_PATH . 'public/inc/wl-rts-testimonial-shortcode.php');

/* Load translation */
add_action('plugins_loaded', array('WL_RTS_Language', 'load_translation'));

/* Register post types */
add_action('init', array('WL_RTS_Testimonial', 'register_testimonial_post_type'));

/* Create shortcode */
add_shortcode('RTS', array('WL_RTS_Testimonial_Shortcode', 'create_testimonial_shortcode'));

/* Shortcode Assets */
add_action('wp_enqueue_scripts', array('WL_RTS_Testimonial_Shortcode', 'shortcode_assets'));
