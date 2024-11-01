<?php

/**
 * Testimonial  admin file for meta boxes and for saving data.
 *
 * @package Responsive Testimonial Slider
 */

defined('ABSPATH') || die();

require_once(WL_RTS_PLUGIN_DIR_PATH . 'includes/wl-rts-helper.php');

/**
 * Class for callback all functions.
 */
class Wl_RTS_Testimonial_Admin {

	/**
	 * Add metaboxes to testimonial post type
	 *
	 * @return void
	 */
	public static function add_meta_boxes() {
		add_meta_box('wltp_testimonial', esc_html__('Responsive Testimonial Slider', 'responsive-testimonial-slider'), array('Wl_RTS_Testimonial_Admin', 'testimonial_html'), 'testimonial', 'advanced');
		add_meta_box('wltp_testimonial_short', esc_html__('Responsive Testimonial Slider Shortcode', 'responsive-testimonial-slider'), array('Wl_RTS_Testimonial_Admin', 'testimonial_shortcode_html'), 'testimonial', 'side');
		add_meta_box('wltp_testimonial_layout_settings', esc_html__('Layout Settings', 'responsive-testimonial-slider'), array('Wl_RTS_Testimonial_Admin', 'testimonial_layout_html'), 'testimonial', 'advanced');
		add_meta_box('wltp_testimonial_do_short', esc_html__('Do Shortcode', 'responsive-testimonial-slider'), array('Wl_RTS_Testimonial_Admin', 'testimonial_do_shortcode_html'), 'testimonial', 'side');
	}

	/**
	 * Render html of testimonial metabox
	 *
	 * @param  WP_Post $post The post object.
	 * @return void
	 */
	public static function testimonial_html($post) {
		$post_id    = $post->ID;
		/* Array of array having keys: title, profile_photo, site_url, designation, testimonial_description, testimonial_rating*/
		$testimonial = get_post_meta($post_id, 'wltp_testimonial', true);
?>
		<?php wp_nonce_field('save_testimonial_meta', 'testimonial_meta'); ?>
		<div class="wltp">
			<div class="wltp" id="wltp_testimonial">
				<div id="wltp_testimonial_rows" class="row">

					<?php if (is_array($testimonial) && count($testimonial) > 0) : ?>
						<?php foreach ($testimonial as $key => $value) : ?>
							<?php
							$title                      = isset($value['title']) ? esc_attr($value['title']) : '';
							$profile_photo              = isset($value['profile_photo']) ? esc_url($value['profile_photo']) : '';
							$site_url                   = isset($value['site_url']) ? esc_url($value['site_url']) : '';
							$designation                = isset($value['designation']) ? esc_attr($value['designation']) : '';
							$testimonial_description    = isset($value['testimonial_description']) ? esc_attr($value['testimonial_description']) : '';
							$testimonial_rating         = isset($value['testimonial_rating']) ? esc_attr($value['testimonial_rating']) : '';
							$description_title          = isset($value['description_title']) ? esc_attr($value['description_title']) : '';
							?>
							<div class="col-sm-12 col-md-6 col-lg-12 wltp_testimonial_row">
								<div class="wltp_testimonial_inner">
									<div class="form-group wltp-title mt-2">
										<small class="d-block float-right">
											<button type="button" class="wltp_testimonial_remove_label btn btn-sm btn-outline-danger testimonial_remove_label mb-1"><i class="fas fa-times"></i></button>
										</small>
										<label><?php esc_html_e('Title', 'responsive-testimonial-slider'); ?>:</label>
										<input type="text" name="testimonial_title[]" class="form-control" value="<?php echo esc_attr($title); ?>" placeholder="Enter Title">
									</div>
									<div class="form-group wltp-photo">
										<label class="mt-1"><?php esc_html_e('Client Photo', 'responsive-testimonial-slider'); ?>:</label>
										<?php if ($profile_photo) { ?>
											<div class="tp-default tp-hide"><img src="<?php echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/profile_img.png'); ?>"></div>
											<div class='tp-photo'>
												<input type="hidden" class="testimonial_profile_photo" name="testimonial_profile_photo[]" value="<?php echo esc_url($profile_photo); ?>"><img src="<?php echo esc_url($profile_photo); ?>" class="img-fluid" alt="img">
											</div>
										<?php } else { ?>
											<div class="tp-default"><img src="<?php echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/profile_img.png'); ?>"></div>
										<?php } ?>
										<button type="button" class="d-block testimonial_profile_photo_button btn btn-outline-primary mt-2"><?php esc_html_e('Upload Photo', 'responsive-testimonial-slider'); ?></button>
									</div>
									<div class="wltp-profile_link">
										<div class="form-group mt-2">
											<label><?php esc_html_e('Site URL', 'responsive-testimonial-slider'); ?>:</label>
											<input type="text" name="testimonial_site_url[]" class="form-control" value="<?php echo esc_url($site_url); ?>" placeholder="Enter Site URL">
										</div>
										<div class="form-group wltp-designation mt-2">
											<label><?php esc_html_e('Designation', 'responsive-testimonial-slider'); ?>:</label>
											<input type="text" name="testimonial_designation[]" class="form-control" value="<?php echo esc_attr($designation); ?>" placeholder="Eneter Designation">
										</div>
										<div class="form-group wltp-description-title mt-2">
											<label><?php esc_html_e('Description Title', 'responsive-testimonial-slider'); ?>:</label>
											<input type="text" name="description_title[]" class="form-control" value="<?php echo esc_attr($description_title); ?>" placeholder="Enter Description Title">
										</div>
									</div>
									<div class="form-group wltp-description mt-2">
										<label><?php esc_html_e('Testimonial Description', 'responsive-testimonial-slider'); ?>:</label>
										<textarea rows="3" cols="50" type="text" name="testimonial_description[]" class="form-control" placeholder="Enter Description"><?php echo esc_html($testimonial_description); ?></textarea>
									</div>
									<div class="form-group wltp-rating mt-2">
										<label><?php esc_html_e('Testimonial Rating', 'responsive-testimonial-slider'); ?>:</label>
										<select name="testimonial_rating[]" class="form-control">
											<?php foreach (WL_RTS_Helper::testimonial_rating() as $key => $value) : ?>
												<option <?php selected($key, $testimonial_rating, true); ?> value="<?php echo esc_attr($key); ?>"><?php echo floatval($value); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="col-sm-12 col-md-6 col-lg-12 wltp_testimonial_row mt-2">
							<div class="wltp_testimonial_inner">
								<div class="form-group wltp-title mt-2">
									<small class="d-block float-right"><button type="button" class="wltp_testimonial_remove_label btn btn-sm btn-outline-danger testimonial_remove_label mb-1"><i class="fas fa-times"></i></button></small>
									<label><?php esc_html_e('Title', 'responsive-testimonial-slider'); ?>:</label>
									<input type="text" name="testimonial_title[]" class="form-control" placeholder="Enter Title">
								</div>
								<div class="form-group wltp-photo">
									<label class="mt-1"><?php esc_html_e('Client Photo', 'responsive-testimonial-slider'); ?>:</label>
									<div class="tp-default"><img src="<?php echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/profile_img.png'); ?>"></div>
									<div class="tp-photo"></div>
									<button type="button" class="testimonial_profile_photo_button btn btn-outline-primary mt-2"><?php esc_html_e('Upload Photo', 'responsive-testimonial-slider'); ?></button>
								</div>
								<div class="wltp-profile_link">
									<div class="form-group mt-2">
										<label><?php esc_html_e('Site URL', 'responsive-testimonial-slider'); ?>:</label>
										<input type="text" name="testimonial_site_url[]" class="form-control" placeholder="Enter Site URL">
									</div>
									<div class="form-group wltp-designation mt-2">
										<label><?php esc_html_e('Designation', 'responsive-testimonial-slider'); ?>:</label>
										<input type="text" name="testimonial_designation[]" class="form-control" placeholder="Eneter Designation">
									</div>
									<div class="form-group wltp-description-title mt-2">
										<label><?php esc_html_e('Description Title', 'responsive-testimonial-slider'); ?>:</label>
										<input type="text" name="description_title[]" class="form-control" placeholder="Enter Description Title"> 
									</div>
								</div>
								<div class="form-group wltp-description mt-2">
									<label><?php esc_html_e('Testimonial Description', 'responsive-testimonial-slider'); ?>:</label>
									<textarea rows="3" cols="50" type="text" name="testimonial_description[]" class="form-control" placeholder="Enter Description"></textarea>
								</div>
								<div class="form-group wltp-rating mt-2">
									<label><?php esc_html_e('Testimonial Rating', 'responsive-testimonial-slider'); ?>:</label>
									<select name="testimonial_rating" class="form-control">
										<?php foreach (WL_RTS_Helper::testimonial_rating() as $key => $value) : ?>
											<option value="<?php echo esc_attr($key); ?>"><?php echo floatval($value); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 btn-div">
					<button type="button" id="wltp_testimonial_row_add_more" class="btn wltp_row_add_more btn btn-primary col-md-6 mt-2 float-right"><i class="fas fa-plus"></i><?php esc_html_e('Add more', 'responsive-testimonial-slider'); ?></button>
				</div>
			</div>
		</div>
		<style type="text/css">
			#titlediv #title {			  
			    font-size: 30px;			   
			    height: 1.8em;			   
			}
	   </style>
	<?php
	}

	/**
	 * Render html of testimonial shortcode metabox
	 *
	 * @param  WP_Post $post The post object.
	 * @return void
	 */
	public static function testimonial_shortcode_html($post) {
	?>
		<p style="color: red;">
			<?php esc_html_e('Use below shortcode to publish your Testimonial in any post/pages', 'responsive-testimonial-slider'); ?>
		</p>
		<input readonly="readonly" type="text" value="<?php echo esc_attr('[RTS id=' . get_the_ID() . ']'); ?>">
	<?php
	}

	/**
	 * Render html of do shortcode metabox
	 *
	 * @param  WP_Post $post The post object.
	 * @return void
	 */
	public static function testimonial_do_shortcode_html($post) {
	?>
		<p> <?php esc_html_e('Use below code in your theme', 'responsive-testimonial-slider'); ?></p>
		<input class="widefat" readonly="readonly" type="text" value="<?php echo '<?php echo do_shortcode( \'[RTS id=' . esc_attr(get_the_ID()) . ']\' ); ?>'; ?>">
	<?php
	}

	/**
	 * Render html of testimonial layout metabox
	 *
	 * @param  WP_Post $post The post object.
	 * @return void
	 */
	public static function testimonial_layout_html($post) {
		$post_id            = $post->ID;
		$testimonial_layout = get_post_meta($post_id, 'wltp_testimonial_layout', true);
		$layout1            = get_post_meta($post_id, 'wltp_testimonial_layout_1', true);
		$layout2            = get_post_meta($post_id, 'wltp_testimonial_layout_2', true);

		/* Layout 1 Settings */
		$layout1_show_title        = isset($layout1['show_title']) ? sanitize_title($layout1['show_title']) : true;
		$layout1_show_site_url     = isset($layout1['show_site_url']) ? sanitize_text_field($layout1['show_site_url']) : true;
		$layout1_show_client_photo = isset($layout1['show_client_photo']) ? sanitize_text_field($layout1['show_client_photo']) : true;
		$layout1_show_designation  = isset($layout1['show_designation']) ? sanitize_text_field($layout1['show_designation']) : true;
		$layout1_show_rating       = isset($layout1['show_rating']) ? sanitize_text_field($layout1['show_rating']) : true;
		$layout1_title_color       = isset($layout1['title_color']) ? sanitize_hex_color($layout1['title_color']) : '#5c1a13';
		$layout1_background_color  = isset($layout1['background_color']) ? sanitize_hex_color($layout1['background_color']) : '#000000';
		$layout1_designation_color = isset($layout1['designation_color']) ? sanitize_hex_color($layout1['designation_color']) : '#3888c9';
		$layout1_link_color        = isset($layout1['link_color']) ? sanitize_hex_color($layout1['link_color']) : '#3a85e0';
		$layout1_rating_color      = isset($layout1['rating_color']) ? sanitize_hex_color($layout1['rating_color']) : '#f2b01e';


		/* Layout 2 Settings */
		$layout2_show_title        = isset($layout2['show_title']) ? sanitize_title($layout2['show_title']) : true;
		$layout2_show_site_url     = isset($layout2['show_site_url']) ? sanitize_text_field($layout2['show_site_url']) : true;
		$layout2_show_client_photo = isset($layout2['show_client_photo']) ? sanitize_text_field($layout2['show_client_photo']) : true;
		$layout2_show_designation  = isset($layout2['show_designation']) ? sanitize_text_field($layout2['show_designation']) : true;
		$layout2_show_rating       = isset($layout2['show_rating']) ? sanitize_text_field($layout2['show_rating']) : true;
		$layout2_title_color       = isset($layout2['title_color']) ? sanitize_hex_color($layout2['title_color']) : '#5c1a13';
		$layout2_designation_color = isset($layout2['designation_color']) ? sanitize_hex_color($layout2['designation_color']) : '#3888c9';
		$layout2_link_color        = isset($layout2['link_color']) ? sanitize_hex_color($layout2['link_color']) : '#3a85e0';
		$layout2_rating_color      = isset($layout2['rating_color']) ? sanitize_hex_color($layout2['rating_color']) : '#f2b01e';


		if (empty($testimonial_layout)) {
			$testimonial_layout = 'gridLayout';
		}
	?>
		<div class="wltp">
			<div class="row mt-2 ml-1">
				<div class="col-md-6">
					<div class="form-group wl_Layouts">
						<input type="radio" name="layouts" id="gridLayout" class="radio_item" <?php checked('gridLayout', $testimonial_layout, true); ?> value="gridLayout">
						<label for="gridLayout" class="label_item wltp_label"><img src="<?php echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/Layout1.png'); ?>">
							<h4 class="wltp_head"><?php echo esc_html__('Grid Layout', 'responsive-testimonial-slider'); ?></h4>
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group wl_Layouts">
						<input type="radio" name="layouts" id="sliderLayout" class="radio_item" <?php checked('sliderLayout', $testimonial_layout, true); ?> value="sliderLayout">
						<label for="sliderLayout" class="label_item wltp_label"><img src="<?php echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/Layout2.png'); ?>">
							<h4 class="wltp_head"><?php echo esc_html__('Slider Layout', 'responsive-testimonial-slider'); ?></h4>
						</label>
					</div>
				</div>
			</div>

			<!-- Layout 1  -->
			<div class="wltp-testimonial_grid mt-2">
				<ul class="nav nav-tabs mb-2 ml-3" role="tablist">
					<li class="nav-item"><a class="nav-link active font-weight-bold font-italic" data-toggle="tab" href="#main-settings1"><?php echo esc_html('Main Settings') ?></a>
					</li>
					<li class="nav-item"><a class="nav-link font-weight-bold font-italic" data-toggle="tab" href="#style-settings1"><?php echo esc_html('Style Settings') ?></a>
					</li>
				</ul>
				<div class="row tab-content">
					<div class="tab-pane container active" id="main-settings1">
						<div class="col-md-8 ml-3">
							<div class="row mt-2">
								<div class="col-md-6">
									<label for="layout_1_show_title"><?php esc_html_e('Title', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout1_show_title, true); ?> type="checkbox" id="layout_1_show_title" name="layout_1[show_title]"></br>
									<label for="layout_1_show_title"><?php esc_html_e('Check/Uncheck for hide/show title.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_show_site_url"><?php esc_html_e('Site URL', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout1_show_site_url, true); ?> type="checkbox" id="layout_1_show_site_url" name="layout_1[show_site_url]"></br>
									<label for="layout_1_show_site_url"><?php esc_html_e('Check/Uncheck for hide/show site url.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_show_client_photo"><?php esc_html_e('Client Photo', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout1_show_client_photo, true); ?> type="checkbox" id="layout_1_show_client_photo" name="layout_1[show_client_photo]"></br>
									<label for="layout_1_show_client_photo"><?php esc_html_e('Check/Uncheck for hide/show client photo.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_show_designation"><?php esc_html_e('Designation', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout1_show_designation, true); ?> type="checkbox" id="layout_1_show_designation" name="layout_1[show_designation]"></br>
									<label for="layout_1_show_designation"><?php esc_html_e('Check/Uncheck for hide/show designation.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_show_rating"><?php esc_html_e('Rating', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout1_show_rating, true); ?> type="checkbox" id="layout_1_show_rating" name="layout_1[show_rating]"></br>
									<label for="layout_1_show_rating"><?php esc_html_e('Check/Uncheck for hide/show rating.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="style-settings1">
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_background_color"><?php esc_html_e('Background Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_1[background_color]" id="layout_1_background_color" value="<?php echo esc_attr($layout1_background_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_1_background_color"><?php esc_html_e('Pick a color for background.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_title_color"><?php esc_html_e('Title Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_1[title_color]" id="layout_1_title_color" value="<?php echo esc_attr($layout1_title_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_1_title_color"><?php esc_html_e('Pick a color for title.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_designation_color"><?php esc_html_e('Designation Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_1[designation_color]" id="layout_1_designation_color" value="<?php echo esc_attr($layout1_designation_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_1_title_color"><?php esc_html_e('Pick a color for designation.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_link_color"><?php esc_html_e('Link Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_1[link_color]" id="layout_1_link_color" value="<?php echo esc_attr($layout1_link_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_1_link_color"><?php esc_html_e('Pick a color for link.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_1_rating_color"><?php esc_html_e('Rating Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_1[rating_color]" id="layout_1_rating_color" value="<?php echo esc_attr($layout1_rating_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_1_rating_color"><?php esc_html_e('Pick a color for rating.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Layout 2 -->
			<div class="wltp-testimonial_slider mt-2">
				<ul class="nav nav-tabs mb-2 ml-3" role="tablist">
					<li class="nav-item"><a class="nav-link active font-weight-bold font-italic" data-toggle="tab" href="#main-settings2"><?php echo esc_html('Main Settings'); ?></a>
					</li>
					<li class="nav-item"><a class="nav-link font-weight-bold font-italic" data-toggle="tab" href="#style-settings2"><?php echo esc_html('Style Settings') ?></a>
					</li>
				</ul>
				<div class="row tab-content">
					<div class="tab-pane container active" id="main-settings2">
						<div class="col-md-8 ml-3">
							<div class="row mt-2">
								<div class="col-md-6">
									<label for="layout_2_show_title"><?php esc_html_e('Title', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout2_show_title, true); ?> type="checkbox" id="layout_2_show_title" name="layout_2[show_title]"></br>
									<label for="layout_2_show_title"><?php esc_html_e('Check/Uncheck for hide/show title.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_show_site_url"><?php esc_html_e('Site URL', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout2_show_site_url, true); ?> type="checkbox" id="layout_2_show_site_url" name="layout_2[show_site_url]"></br>
									<label for="layout_2_show_site_url"><?php esc_html_e('Check/Uncheck for hide/show site url.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_show_client_photo"><?php esc_html_e('Client Photo', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout2_show_client_photo, true); ?> type="checkbox" id="layout_2_show_client_photo" name="layout_2[show_client_photo]"></br>
									<label for="layout_2_show_client_photo"><?php esc_html_e('Check/Uncheck for hide/show client photo.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_show_designation"><?php esc_html_e('Designation', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout2_show_designation, true); ?> type="checkbox" id="layout_2_show_designation" name="layout_2[show_designation]"></br>
									<label for="layout_2_show_designation"><?php esc_html_e('Check/Uncheck for hide/show designation.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_show_rating"><?php esc_html_e('Rating', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input <?php checked(true, $layout2_show_rating, true); ?> type="checkbox" id="layout_2_show_rating" name="layout_2[show_rating]"></br>
									<label for="layout_2_show_rating"><?php esc_html_e('Check/Uncheck for hide/show rating.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="style-settings2">
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_title_color"><?php esc_html_e('Title Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_2[title_color]" id="layout_2_title_color" value="<?php echo esc_attr($layout2_title_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_2_title_color"><?php esc_html_e('Pick a color for title.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_designation_color"><?php esc_html_e('Designation Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_2[designation_color]" id="layout_2_designation_color" value="<?php echo esc_attr($layout2_designation_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_2_designation_color"><?php esc_html_e('Pick a color for designation.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_link_color"><?php esc_html_e('Link Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_2[link_color]" id="layout_2_link_color" value="<?php echo esc_attr($layout2_link_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_2_link_color"><?php esc_html_e('Pick a color for link.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
						<div class="col-md-8 ml-3">
							<div class="row">
								<div class="col-md-6">
									<label for="layout_2_rating_color"><?php esc_html_e('Rating Color', 'responsive-testimonial-slider'); ?></label>
								</div>
								<div class="col-md-6">
									<input type="text" name="layout_2[rating_color]" id="layout_2_rating_color" value="<?php echo esc_attr($layout2_rating_color); ?>" class="color-field mt-2 mb-2">
									<label for="layout_2_rating_color"><?php esc_html_e('Pick a color for rating.', 'responsive-testimonial-slider'); ?></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}

	/**
	 * Enqueue scripts and styles to admin testimonial post type
	 *
	 * @param  string $hook_suffix The hook_suffix object.
	 * @return void
	 */
	public static function enqueue_scripts_styles($hook_suffix) {
		if (in_array($hook_suffix, array('post.php', 'post-new.php'))) {
			$screen = get_current_screen();
			if (is_object($screen) && 'testimonial' == $screen->post_type) {
				/* Enqueue styles */
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), true, 'all');
				wp_enqueue_style('font-awesome-free', WL_RTS_PLUGIN_URL . 'assets/css/all.min.css', array(), true, 'all');
				wp_enqueue_style('wltp-admin', WL_RTS_PLUGIN_URL . 'assets/css/wltp-admin.css', array(), true, 'all');

				/* Enqueue scripts */
				wp_enqueue_media();
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('popper', WL_RTS_PLUGIN_URL . 'assets/js/popper.min.js', array('jquery'), true, true);
				wp_enqueue_script('wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/js/bootstrap.min.js', array('jquery'), true, true);
				wp_enqueue_script('wltp-admin', WL_RTS_PLUGIN_URL . 'assets/js/wltp-admin.js', array('jquery'), true, true);
			}
		}
	}

	/**
	 * Change title text for testimonial post type
	 *
	 * @param  string $title The title object.
	 * @return string
	 */
	public static function change_title_text($title) {
		$screen = get_current_screen();
		if ('testimonial' == $screen->post_type) {
			$title = esc_html__('Enter Testimonial Name', 'responsive-testimonial-slider');
		}
		return $title;
	}

	/**
	 * Set testimonial columns
	 *
	 * @param array $columns The columns object.
	 * @return array
	 */
	public static function set_columns($columns) {
		unset($columns['author'],
		$columns['Date']);
		$new_cols = array(
			'title'        => esc_html__('Client', 'responsive-testimonial-slider'),
			'date'         => esc_html__('Date', 'responsive-testimonial-slider'),
			'shortcode'    => esc_html__('Responsive Testimonial Slider Shortcode', 'responsive-testimonial-slider'),
			'do_shortcode' => esc_html__('Do Shortcode', 'responsive-testimonial-slider'),
			'author'       => esc_html__('Author', 'responsive-testimonial-slider'),
		);
		return array_merge($columns, $new_cols);
	}

	/**
	 * Manage testimonial columns
	 *
	 * @param string  $column The column object.
	 * @param  WP_Post $post_id The post_id object.
	 * @return void
	 */
	public static function manage_col($column, $post_id) {
		global $post;
		switch ($column) {
			case 'shortcode':
				echo '<input type="text" value="[RTS id=' . esc_attr($post_id) . ']" readonly="readonly" />';
				break;
			case 'do_shortcode':
				echo '<input type="text" value="<?php echo do_shortcode( \'[RTS id=' . esc_attr($post_id) . ']\' ); ?>" readonly="readonly" />';
				break;
			default:
				break;
		}
	}

	/**
	 * Save metaboxes values
	 *
	 * @param  int     $post_id The post_id object.
	 * @param  WP_Post $post The post object.
	 * @return void
	 */
	public static function save_metaboxes($post_id, $post) {
		if (!isset($_POST['testimonial_meta']) || !wp_verify_nonce(sanitize_key($_POST['testimonial_meta']), 'save_testimonial_meta')) {
			return;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		if (defined('DOING_AJAX') && DOING_AJAX) {
			return;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}
		if (wp_is_post_revision($post)) {
			return;
		}
		if ('testimonial' !== $post->post_type) {
			return;
		}

		$testimonial_title         = (isset($_POST['testimonial_title']) && is_array($_POST['testimonial_title'])) ? array_map('sanitize_title', $_POST['testimonial_title']) : array();
		$testimonial_profile_photo = (isset($_POST['testimonial_profile_photo']) && is_array($_POST['testimonial_profile_photo'])) ? array_map('esc_url_raw', $_POST['testimonial_profile_photo']) : array();
		$testimonial_site_url      = (isset($_POST['testimonial_site_url']) && is_array($_POST['testimonial_site_url'])) ? array_map('esc_url_raw', $_POST['testimonial_site_url']) : array();
		$testimonial_designation   = (isset($_POST['testimonial_designation']) && is_array($_POST['testimonial_designation'])) ? array_map('sanitize_text_field', $_POST['testimonial_designation']) : array();
		$testimonial_description   = (isset($_POST['testimonial_description']) && is_array($_POST['testimonial_description'])) ? array_map('sanitize_textarea_field', $_POST['testimonial_description']) : array();
		$testimonial_rating        = (isset($_POST['testimonial_rating']) && is_array($_POST['testimonial_rating'])) ? array_map('sanitize_text_field', $_POST['testimonial_rating']) : array(); $description_title         = (isset($_POST['description_title']) && is_array($_POST['description_title'])) ? array_map('sanitize_title', $_POST['description_title']) : array();
		$layout                    = (isset($_POST['layouts'])) ? sanitize_text_field($_POST['layouts']) : '';
		$layout1                   = (isset($_POST['layout_1']) && is_array($_POST['layout_1'])) ? $_POST['layout_1'] : array();
		$layout2                   = (isset($_POST['layout_2']) && is_array($_POST['layout_2'])) ? $_POST['layout_2'] : array();

		$testimonial = array();
		foreach ($testimonial_title as $key => $title) {
			array_push(
				$testimonial,
				array(					
					'title'                   => isset($title) ? sanitize_title($title) : null,
					'profile_photo'           => isset($testimonial_profile_photo[$key]) ? esc_url_raw($testimonial_profile_photo[$key]) : null,
					'site_url'                => isset($testimonial_site_url[$key]) ? esc_url($testimonial_site_url[$key]) : null,
					'designation'             => isset($testimonial_designation[$key]) ? sanitize_text_field($testimonial_designation[$key]) : null,
					'testimonial_description' => isset($testimonial_description[$key]) ? sanitize_textarea_field($testimonial_description[$key]) : null,
					'testimonial_rating'      => isset($testimonial_rating[$key]) ? sanitize_text_field($testimonial_rating[$key]) : null,
					'description_title'       => isset($description_title[$key]) ? sanitize_title($description_title[$key]) : null,				
				)
			);
		}
		update_post_meta($post_id, 'wltp_testimonial', $testimonial);
		update_post_meta($post_id, 'wltp_testimonial_layout', $layout);

		if ('gridLayout' === $layout) {
			$layout1 = array(
				'show_title'              => isset($layout1['show_title']) ? boolval($layout1['show_title']) : false,
				'show_site_url'           => isset($layout1['show_site_url']) ? boolval($layout1['show_site_url']) : false,
				'show_client_photo'       => isset($layout1['show_client_photo']) ? boolval($layout1['show_client_photo']) : false,
				'show_designation'        => isset($layout1['show_designation']) ? boolval($layout1['show_designation']) : false,
				'show_rating'             => isset($layout1['show_rating']) ? boolval($layout1['show_rating']) : false,
				'show_align_header'       => isset($layout1['show_align_header']) ? sanitize_text_field($layout1['show_align_header']) : null,
				'title_color'             => isset($layout1['title_color']) ? sanitize_hex_color($layout1['title_color']) : null,
				'background_color'        => isset($layout1['background_color']) ? sanitize_hex_color($layout1['background_color']) : null,
				'designation_color'       => isset($layout1['designation_color']) ? sanitize_hex_color($layout1['designation_color']) : null,
				'link_color'              => isset($layout1['link_color']) ? sanitize_hex_color($layout1['link_color']) : null,
				'rating_color'            => isset($layout1['rating_color']) ? sanitize_hex_color($layout1['rating_color']) : null,
				'card_background_color'   => isset($layout1['card_background_color']) ? sanitize_hex_color($layout1['card_background_color']) : null,
				'card_font_color'         => isset($layout1['card_font_color']) ? sanitize_hex_color($layout1['card_font_color']) : null,
				'description_title_color' => isset($layout1['description_title_color']) ? sanitize_hex_color($layout1['description_title_color']) : null,
				'show_align_content'      => isset($layout1['show_align_content']) ? sanitize_text_field($layout1['show_align_content']) : null,
			);
			update_post_meta($post_id, 'wltp_testimonial_layout_1', $layout1);
		} elseif ('sliderLayout' === $layout) {
			$layout2 = array(
				'show_title'                 => isset($layout2['show_title']) ? boolval($layout2['show_title']) : false,
				'show_site_url'              => isset($layout2['show_site_url']) ? boolval($layout2['show_site_url']) : false,
				'show_client_photo'          => isset($layout2['show_client_photo']) ? boolval($layout2['show_client_photo']) : false,
				'show_designation'           => isset($layout2['show_designation']) ? boolval($layout2['show_designation']) : false,
				'show_rating'                => isset($layout2['show_rating']) ? boolval($layout2['show_rating']) : false,
				'show_testimonial_per_slide' => isset($layout2['show_testimonial_per_slide']) ? sanitize_text_field($layout2['show_testimonial_per_slide']) : null,
				'show_pagination'            => isset($layout2['show_pagination']) ? boolval($layout2['show_pagination']) : false,
				'show_pagination_number'     => isset($layout2['show_pagination_number']) ? boolval($layout2['show_pagination_number']) : false,
				'show_navigation'            => isset($layout2['show_navigation']) ? boolval($layout2['show_navigation']) : false,
				'show_autoplay'              => isset($layout2['show_autoplay']) ? boolval($layout2['show_autoplay']) : false,
				'show_stop_on_hover'         => isset($layout2['show_stop_on_hover']) ? boolval($layout2['show_stop_on_hover']) : false,
				'show_scroll_per_page'       => isset($layout2['show_scroll_per_page']) ? boolval($layout2['show_scroll_per_page']) : false,
				'show_pagination_speed'      => isset($layout2['show_pagination_speed']) ? sanitize_text_field($layout2['show_pagination_speed']) : null,
				'show_rewind_navigation'     => isset($layout2['show_rewind_navigation']) ? boolval($layout2['show_rewind_navigation']) : false,
				'show_rewind_speed'          => isset($layout2['show_rewind_speed']) ? sanitize_text_field($layout2['show_rewind_speed']) : null,
				'photo_hover_color'          => isset($layout2['photo_hover_color']) ? sanitize_hex_color($layout2['photo_hover_color']) : null,
				'title_color'                => isset($layout2['title_color']) ? sanitize_hex_color($layout2['title_color']) : null,
				'designation_color'          => isset($layout2['designation_color']) ? sanitize_hex_color($layout2['designation_color']) : null,
				'link_color'                 => isset($layout2['link_color']) ? sanitize_hex_color($layout2['link_color']) : null,
				'rating_color'               => isset($layout2['rating_color']) ? sanitize_hex_color($layout2['rating_color']) : null,
				'card_background_color'      => isset($layout2['card_background_color']) ? sanitize_hex_color($layout2['card_background_color']) : null,
				'card_font_color'            => isset($layout2['card_font_color']) ? sanitize_hex_color($layout2['card_font_color']) : null,
				'description_title_color'    => isset($layout2['description_title_color']) ? sanitize_hex_color($layout2['description_title_color']) : null,
			);
			update_post_meta($post_id, 'wltp_testimonial_layout_2', $layout2);
		}
	}
}