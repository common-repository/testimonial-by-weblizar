<?php
if (!defined('ABSPATH')) {
    exit;
}
wp_enqueue_style('testi-banner', WL_RTS_PLUGIN_URL . '/assets/css/banner.css');
$testi_banner_imgpath = WL_RTS_PLUGIN_URL . "/assets/images/banner.jpg"; ?>
<div class="wb_plugin_feature notice  is-dismissible">
    <div class="wb_plugin_feature_banner default_pattern pattern_ ">
        <div class="wb-col-md-6 wb-col-sm-12 box">
            <div class="ribbon"><span><?php esc_html_e('Go Pro', 'WL_RTS_DOMAIN'); ?></span></div>
            <img class="wp-img-responsive" src="<?php echo esc_url($testi_banner_imgpath); ?>" alt="img">
        </div>
        <div class="wb-col-md-6 wb-col-sm-12 wb_banner_featurs-list">
            <span class="gp_banner_head">
                <h2><?php esc_html_e('Testimonials Pro Features', 'WL_RTS_DOMAIN'); ?> </h2>
            </span>
            <ul>
                <li><?php esc_html_e('Testimonial Group', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Multiple Layout', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Mutliple Color Picker', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Testimonial Category', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Fully Responsive', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Layout Settings', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Testimonial Short-code', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Grid Layout', 'WL_RTS_DOMAIN'); ?></li>
                <li><?php esc_html_e('Slider Layout', 'WL_RTS_DOMAIN'); ?></li>
            </ul>
            <div class="wp_btn-grup">
                <a class="wb_button-primary" href="https://demo.weblizar.com/testimonial-pro/" target="_blank"><?php esc_html_e('View Demo', 'WL_RTS_DOMAIN'); ?></a>
                <a class="wb_button-primary" href="https://weblizar.com/plugins/testimonial-pro/" target="_blank"><?php esc_html_e('Buy Now', 'WL_RTS_DOMAIN'); ?><?php esc_html_e(' $7', 'WL_RTS_DOMAIN'); ?> </a>
            </div>
        </div>
    </div>
</div>