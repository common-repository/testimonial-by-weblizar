<?php
defined( 'ABSPATH' ) || die();

require_once WL_RTS_PLUGIN_DIR_PATH . 'includes/wl-rts-helper.php';

class WL_RTS_Testimonial {

	/**
	 * Register testimonial post type
	 *
	 * @return void
	 */
	public static function register_testimonial_post_type() {
		$labels = array(
			'name'                  => esc_html_x( 'Testimonial Slider', 'Post Type General Name', 'responsive-testimonial-slider' ),
			'singular_name'         => esc_html_x( 'Testimonial Slider', 'Post Type Singular Name', 'responsive-testimonial-slider' ),
			'menu_name'             => esc_html__( 'Testimonial Slider', 'responsive-testimonial-slider' ),
			'name_admin_bar'        => esc_html__( 'Testimonial Slider', 'responsive-testimonial-slider' ),
			'archives'              => esc_html__( 'Testimonial Slider Archives', 'responsive-testimonial-slider' ),
			'attributes'            => esc_html__( 'Testimonial Slider Attributes', 'responsive-testimonial-slider' ),
			'all_items'             => esc_html__( 'All Testimonial Slider', 'responsive-testimonial-slider' ),
			'add_new_item'          => esc_html__( 'Add New Testimonial Slider', 'responsive-testimonial-slider' ),
			'add_new'               => esc_html__( 'Add New', 'responsive-testimonial-slider' ),
			'new_item'              => esc_html__( 'New Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'edit_item'             => esc_html__( 'Edit Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'update_item'           => esc_html__( 'Update Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'view_item'             => esc_html__( 'View Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'view_items'            => esc_html__( 'View Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'search_items'          => esc_html__( 'Search Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'not_found'             => esc_html__( 'Not found', 'responsive-testimonial-slider' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'responsive-testimonial-slider' ),
			'items_list'            => esc_html__( 'Responsive Testimonial Slider list', 'responsive-testimonial-slider' ),
			'items_list_navigation' => esc_html__( 'Responsive Testimonial Slider list navigation', 'responsive-testimonial-slider' ),
			'filter_items_list'     => esc_html__( 'Filter Responsive Testimonial Slider list', 'responsive-testimonial-slider' ),
		);
		$args   = array(
			'label'               => esc_html__( 'Responsive Testimonial Slider', 'responsive-testimonial-slider' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'hierarchical'        => true,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-format-quote',
			'menu_position'       => 28,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'rewrite'             => array( 'slug' => 'testimonial' ),
		);
		register_post_type( 'testimonial', $args );
	}
}
