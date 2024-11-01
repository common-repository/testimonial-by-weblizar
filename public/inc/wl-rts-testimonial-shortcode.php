<?php
defined( 'ABSPATH' ) || die();

class WL_RTS_Testimonial_Shortcode {
	public static function create_testimonial_shortcode( $atts ) {
		ob_start(); ?>
		<div class="wltp">
			<?php
			$post_id = $atts['id'];
			$layout  = get_post_meta( $post_id, 'wltp_testimonial_layout', true );
			if ( 'gridLayout' === $layout ) {
				$layout1     = get_post_meta( $post_id, 'wltp_testimonial_layout_1', true );
				$layout_data = get_post_meta( $post_id, 'wltp_testimonial', true );
				require_once WL_RTS_PLUGIN_DIR_PATH . 'public/inc/layouts/grid-layout/testimonial-grid-layout.php';
			} elseif ( 'sliderLayout' === $layout ) {
				$layout2     = get_post_meta( $post_id, 'wltp_testimonial_layout_2', true );
				$layout_data = get_post_meta( $post_id, 'wltp_testimonial', true );
				require_once WL_RTS_PLUGIN_DIR_PATH . 'public/inc/layouts/slider-layout/testimonial-slider-layout.php';
			}
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	public static function shortcode_assets() {
		global $post;
		if ( is_a( $post, 'WP_Post' ) ) {
			if ( has_shortcode( $post->post_content, 'RTS' ) ) {
				wp_enqueue_style( 'font-awesome-free', WL_RTS_PLUGIN_URL . 'assets/css/all.min.css', array(), true, 'all' );
			}
		}
	}
}
