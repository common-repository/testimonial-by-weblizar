<?php

/**
 * Admin file for all actions, filters and shortcodes.
 *
 * @package Responsive Testimonial Slider
 */

defined('ABSPATH') || die();

require_once(WL_RTS_PLUGIN_DIR_PATH . 'admin/inc/wl-rts-testimonial-admin.php');
require_once(WL_RTS_PLUGIN_DIR_PATH . 'includes/wl-rts-helper.php');

/* Add metaboxes */
add_action('add_meta_boxes', array('Wl_RTS_Testimonial_Admin', 'add_meta_boxes'));

/* Enqueue scripts and styles */
add_action('admin_enqueue_scripts', array('Wl_RTS_Testimonial_Admin', 'enqueue_scripts_styles'));

/* Save metaboxes */
add_action('save_post', array('Wl_RTS_Testimonial_Admin', 'save_metaboxes'), 10, 2);

/* Change title text */
add_filter('enter_title_here', array('Wl_RTS_Testimonial_Admin', 'change_title_text'));

/* Set Testimonial columns */
add_filter('manage_testimonial_posts_columns', array('Wl_RTS_Testimonial_Admin', 'set_columns'));
add_action('manage_testimonial_posts_custom_column', array('Wl_RTS_Testimonial_Admin', 'manage_col'), 10, 2);

// Review Notice Box
add_action("admin_notices", "review_admin_notice_testimonial_free");

add_action('media_buttons', 'aa_add_testimonial_custom_button');
add_action('admin_footer', 'aa_add_testimonial_inline_popup_content');

function review_admin_notice_testimonial_free() {
	global $pagenow;
	$aatp_screen = get_current_screen();
	if ($pagenow == 'edit.php' && $aatp_screen->post_type == "testimonial") {
		include('banner.php');
	}
}

//add media button fuction
function aa_add_testimonial_custom_button()
{
	$context	  =  null;
	$container_id = 'WLTESTI';
	$title        = 'Responsive Testimonial Slider';
	$context      .= '<a class="button button-primary thickbox" title="'.$title.'" href="#TB_inline?width400&inlineId=' . $container_id . '"><span class="dashicons dashicons-editor-quote"></span> Responsive Testimonial Slider</a>';
	printf($context);
}

function aa_add_testimonial_inline_popup_content()
{ 
	wp_register_script( 'weblizar-testimonial-script', false );
	wp_enqueue_script( 'weblizar-testimonial-script' );
	$js = " ";
	ob_start(); ?>	
		jQuery(document).ready(function() {
			jQuery('#wl_tm_insert').on('click', function() {
				var id = jQuery('#Wl_Tm_ME option:selected').val();
				window.send_to_editor('<p>[RTS id=' + id + ']</p>');
				tb_remove();
			})
		});
	<?php
	$js .= ob_get_clean();
	wp_add_inline_script( 'weblizar-testimonial-script', $js ); ?>
	
	<div id="WLTESTI" style="display:none;">
		<?php $all_posts = wp_count_posts('testimonial')->publish;
		if (!$all_posts == null) { ?>
			<h5><?php esc_html_e('Select Testimonial Shortcode And Widget To Insert Into Post', 'responsive-testimonial-slider'); ?></h5>
			<select id="Wl_Tm_ME">
				<?php
				global $wpdb;
				$Web_Lizar_shortcodegallerys = $wpdb->get_results("SELECT post_title, ID FROM $wpdb->posts WHERE post_status = 'publish'	AND post_type='testimonial' ");
				foreach ($Web_Lizar_shortcodegallerys as $Web_Lizar_shortcodegallery) {
					if ($Web_Lizar_shortcodegallery->post_title) {
						$title_var = $Web_Lizar_shortcodegallery->post_title;
					} else {
						$title_var = "(no title)";
					}
					echo "<option value='" . esc_attr($Web_Lizar_shortcodegallery->ID) . "'>" . esc_html($title_var) . "</option>";
				} ?>
			</select>
			<button class='button primary' id='wl_tm_insert'><?php esc_html_e('Insert Testimonial Shortcode', 'responsive-testimonial-slider'); ?></button>
		<?php } else { ?>
			<h1 align="center"> <?php esc_html_e('No Testimonial Shortcode not_found ', 'responsive-testimonial-slider'); ?> </h1>
			<?php } ?>
	</div>
<?php
} ?>