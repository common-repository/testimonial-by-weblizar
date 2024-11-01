<?php
/**
 * Plugin Name: Testimonial - Responsive Testimonials Showcase
 * Plugin URI: https://wordpress.org/plugins/testimonial-by-weblizar/
 * Description: Testimonial is the Responsive Testimonials Showcase Plugin for WordPress built to display testimonials, reviews or quotes in multiple ways on any page , posts or widget! The plugin comes with the easiest Shortcode settings that can help you build awesome and unique testimonials showcase with responsive layouts and customizable styles on your website.
 * Version: 4.0
 * Author: Weblizar
 * Author URI: https://weblizar.com
 * Text Domain: responsive-testimonial-slider
 **/

defined( 'ABSPATH' ) || die();

if ( ! defined( 'WL_RTS_DOMAIN' ) ) {
	define( 'WL_RTS_DOMAIN', 'WL-RTS' );
}

if ( ! defined( 'WL_RTS_PLUGIN_URL' ) ) {
	define( 'WL_RTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WL_RTS_PLUGIN_DIR_PATH' ) ) {
	define( 'WL_RTS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

final class WL_RTS_Responsive_Testimonial_Slider {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once 'admin/admin.php';
		}
		require_once 'public/public.php';
	}
}
WL_RTS_Responsive_Testimonial_Slider::get_instance();

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'testmb_page_pro_link' );
function testmb_page_pro_link( $links ) {
	$links[] = '<a href="' . ( 'https://weblizar.com/plugins/testimonial-pro/' ) . '" style="color:green;"  target="blank"> ' . __( 'Get Pro' ) . '</a>';
	return $links;
}
