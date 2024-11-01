<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_script( 'popper', WL_RTS_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
wp_enqueue_script( 'wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
wp_enqueue_script( 'owl-carousel', WL_RTS_PLUGIN_URL . 'assets/js/owl.carousel.min.js', array(), true, true );
wp_enqueue_style( 'wltp-bootstrap', WL_RTS_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), true, 'all' );
wp_enqueue_style( 'owl-carousel', WL_RTS_PLUGIN_URL . 'assets/css/owl.carousel.min.css', array(), true, 'all' );
wp_enqueue_style( 'owl-theme', WL_RTS_PLUGIN_URL . 'assets/css/owl.theme.min.css', array(), true, 'all' );
wp_enqueue_style( 'wltp-slider', WL_RTS_PLUGIN_URL . 'public/inc/layouts/slider-layout/css/slider-style.css', array(), true, 'all' );
wp_register_script( 'wltp-slider', '', array( 'jquery' ), true, true );
wp_enqueue_script( 'wltp-slider' );

$slider_js = '(function($) {
"use strict";
    jQuery(document).ready(function(){
        jQuery("#testimonial-slider").owlCarousel({
            items: 2,
            itemsDesktop: true,
            itemsDesktopSmall: false,
            itemsTablet: [768,2],
            itemsMobile: [479,1],
            pagination: true,
            paginationNumbers: false,
            navigation: true,
            autoPlay: false,
            stopOnHover : true,
            scrollPerPage : false,
            paginationSpeed : false,
            rewindNav : true,
            rewindSpeed : false,
            navigationText:["' . esc_html__( 'Prev', 'responsive-testimonial-slider' ) . '","' . esc_html__( 'Next', 'responsive-testimonial-slider' ) . '"]
        });
    });
})(jQuery);';
wp_add_inline_script( 'wltp-slider', $slider_js );

$slider_css = '
.testimonial_slider_link a, .testimonial_slider_link a:hover, .testimonial_slider_link a:active, .testimonial_slider_link a:visited, .testimonial_slider_link a:link, .testimonial_slider_link a:focus {
    color: ' . sanitize_hex_color( $layout2['link_color'] ) . ';' .
'}
.wltp-slider-testimonial-rating li {
    color: ' . sanitize_hex_color( $layout2['rating_color'] ) . ';' .
'}
.owl-theme .owl-controls .owl-page span {
    color: ' . sanitize_hex_color( $layout2['rating_color'] ) . ';' .
'}
.wltp-slider-testimonial .wltp-slider-testimonial-title {
    color: ' . sanitize_hex_color( $layout2['title_color'] ) . ';' .
'}
h4.wltp-slider-designation {
    color: ' . sanitize_hex_color( $layout2['designation_color'] ) . ';' .
'}';
wp_add_inline_style( 'wltp-slider', $slider_css );
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="testimonial-slider" class="owl-carousel">
				<?php foreach ( $layout_data as $key => $value ) : ?>
							<?php
								$title                    = isset( $value['title'] ) ? esc_attr( $value['title'] ) : '';
								$profile_photo            = isset( $value['profile_photo'] ) ? esc_url( $value['profile_photo'] ) : '';
								$site_url                 = isset( $value['site_url'] ) ? esc_url( $value['site_url'] ) : '';
								$designation              = isset( $value['designation'] ) ? esc_attr( $value['designation'] ) : '';
								$testimonial_description  = isset( $value['testimonial_description'] ) ? esc_attr( $value['testimonial_description'] ) : '';
								$testimonial_rating       = isset( $value['testimonial_rating'] ) ? esc_attr( $value['testimonial_rating'] ) : '';
								$description_title        = isset( $value['description_title'] ) ? esc_attr( $value['description_title'] ) : '';
							?>

				<div class="wltp-slider-testimonial">
					<div class="wltp-slider-client-photo">
					<?php if ( $layout2['show_client_photo'] ) { ?>
						<!-- <span value="<?php //echo esc_url( $profile_photo ); ?>"><img src="<?php //echo esc_url( $profile_photo ); ?>"></span> -->
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
					<?php
					}
					?>
					</div>
					<div class="wltp-slider-testimonial-description">
						<div class="wltp-slider-testimonial-description-title">
							<p><?php echo esc_attr( $description_title ); ?></p>
						</div>
						<p><?php echo esc_attr( $testimonial_description ); ?></p>
					</div>
					<div class="wltp-testimonial-content">
						<div class="wltp-testimonial-profile">
							<h3 class="wltp-slider-testimonial-title">
								<?php if ( $layout2['show_title'] ) { ?>
										<span><?php echo esc_html( $title ); ?></span>
									<?php
								}
								?>
							</h3>
								<h4 class="wltp-slider-designation">
									<?php if ( $layout2['show_designation'] ) { ?>
											<span><?php echo esc_html( $designation ); ?></span>                                        
										<?php
									}
									?>
								</h4>

						</div>
						<div class="testimonial_slider_link">
							<?php if ( $layout2['show_site_url'] ) { ?>
									<span><a href="<?php echo esc_url( $site_url ); ?>" target="blank"><?php echo esc_url( $site_url ); ?></a></span>
								<?php
							}
							?>
						</div>

						<ul class="wltp-slider-testimonial-rating">
							<?php
							if ( $layout2['show_rating'] ) {
								$testimonial_rating = number_format( (float) $testimonial_rating, 1 );
								$intpart            = floor( $testimonial_rating );
								$fraction           = $testimonial_rating - $intpart;
								$unrated            = 5 - ceil( $testimonial_rating );

								if ( $intpart <= 5 ) {
									for ( $i = 0; $i < $intpart; $i++ ) {
										?>
										<li><i class="fas fa-star"></i></i></li>
										<?php
									}
								}
								if ( 0.5 == $fraction ) {
									?>
									<li><i class="fas fa-star-half-alt"></i></li>
									<?php
								}

								if ( $unrated > 0 ) {
									for ( $j = 0; $j < $unrated; $j++ ) {
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
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
