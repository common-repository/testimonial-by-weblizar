<?php
defined('ABSPATH') || die();

wp_enqueue_script('popper', WL_RTS_PLUGIN_URL . 'assets/js/popper.min.js', array('jquery'), true, true);
wp_enqueue_script('wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/js/bootstrap.min.js', array('jquery'), true, true);
wp_enqueue_script('owl-carousel', WL_RTS_PLUGIN_URL . 'assets/js/owl.carousel.min.js', array(), true, true);
wp_enqueue_style('wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), true, 'all');
wp_enqueue_style('owl-carousel', WL_RTS_PLUGIN_URL . 'assets/css/owl.carousel.min.css', array(), true, 'all');
wp_enqueue_style('owl-theme', WL_RTS_PLUGIN_URL . 'assets/css/owl.theme.min.css', array(), true, 'all');
wp_enqueue_style('wltp-grid', WL_RTS_PLUGIN_URL . 'public/inc/layouts/grid-layout/css/grid-style.css', array(), true, 'all');


$grid_css = '
.testimonial_grid_link a, .testimonial_grid_link a:hover, .testimonial_grid_link a:active, .testimonial_grid_link a:visited, .testimonial_grid_link a:link, .testimonial_grid_link a:focus {
    color: ' . sanitize_hex_color($layout1['link_color']) . ';' .
	'}
.wltp_grid_email {
    color: ' . sanitize_hex_color($layout1['link_color']) . ';' .
	'}
.wltp-grid-testimonial-rating li {
    color: ' . sanitize_hex_color($layout1['rating_color']) . ';' .
	'}

h3.wltp-grid-testimonial-title {
    color: ' . sanitize_hex_color($layout1['title_color']) . ';' .
	'}
h4.wltp-grid-designation {
    color: ' . sanitize_hex_color($layout1['designation_color']) . ';' .
	'}
.wltp-grid-testimonial .wltp-grid-testimonial-description:before {
    color: ' . sanitize_hex_color($layout1['designation_color']) . ';' .
	'}   
.wltp-grid-testimonial .wltp-grid-testimonial-description {
    background: ' . sanitize_hex_color($layout1['background_color']) . ';' .
	'}';
wp_add_inline_style('wltp-grid', $grid_css);
?>

<div class="testimonial-slider row">
	<?php foreach ($layout_data as $key => $value) : ?>
		<div class="col-lg-6 col-md-6">
			<?php
			$title                    = isset($value['title']) ? esc_attr($value['title']) : '';
			$profile_photo            = isset($value['profile_photo']) ? esc_url($value['profile_photo']) : '';
			$site_url                 = isset($value['site_url']) ? esc_url($value['site_url']) : '';
			$designation              = isset($value['designation']) ? esc_attr($value['designation']) : '';
			$testimonial_description  = isset($value['testimonial_description']) ? esc_attr($value['testimonial_description']) : '';
			$testimonial_rating       = isset($value['testimonial_rating']) ? esc_attr($value['testimonial_rating']) : '';
			$description_title        = isset($value['description_title']) ? esc_attr($value['description_title']) : '';



			?>
			<div class="wltp-grid-testimonial">
				<div class="wltp-grid-testimonial-description">
					<div class="wltp-grid-testimonial-description-title">
						<p><?php echo esc_attr($description_title); ?></p>
					</div>
					<p><?php echo esc_attr($testimonial_description); ?></p>
				</div>
				<div class="wltp-testimonial-grid">
					<div class="testimonial_img">
						<?php if ($layout1['show_client_photo']) { ?>
							<span value="<?php if ($profile_photo) {
												echo esc_url($profile_photo);
											} else {
												echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/profile_img.png');
											}
											?>"><img src="<?php if ($profile_photo) {
												echo esc_url($profile_photo);
											} else {
												echo esc_url(WL_RTS_PLUGIN_URL . 'assets/images/profile_img.png');
											} ?>"></span>
						<?php } ?>
					</div>
					<div class="testimonial-cont">
						<h3 class="wltp-grid-testimonial-title">
							<?php if ($layout1['show_title']) { ?>
								<span><?php echo esc_html($title); ?></span>
							<?php
							}
							?>
						</h3>

						<h4 class="wltp-grid-designation">
							<?php if ($layout1['show_designation']) { ?>
								<span><?php echo esc_html($designation); ?></span>
							<?php
							}
							?>
						</h4>

						<div class="testimonial_grid_link">
							<?php if ($layout1['show_site_url']) { ?>
								<span><a href="<?php echo esc_url($site_url); ?>" target="blank"><?php echo esc_url($site_url); ?></a></span>
							<?php
							}
							?>
						</div>

						<ul class="wltp-grid-testimonial-rating">
							<?php
							if ($layout1['show_rating']) {
								$testimonial_rating = number_format((float) $testimonial_rating, 1);
								$intpart            = floor($testimonial_rating);
								$fraction           = $testimonial_rating - $intpart;
								$unrated            = 5 - ceil($testimonial_rating);

								if ($intpart <= 5) {
									for ($i = 0; $i < $intpart; $i++) {
							?>
										<li><i class="fas fa-star"></i></i></li>
									<?php
									}
								}

								if (0.5 == $fraction) {
									?>
									<li><i class="fas fa-star-half-alt"></i></li>
									<?php
								}

								if ($unrated > 0) {
									for ($j = 0; $j < $unrated; $j++) {
									?>
										<li><i class="far fa-star"></i></li>
							<?php
									}
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>