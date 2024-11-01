<?php
defined('ABSPATH') || die();

class WL_RTS_Language {
	public static function load_translation() {
		load_plugin_textdomain('responsive-testimonial-slider', false, basename(WL_RTS_PLUGIN_DIR_PATH) . '/languages');
	}
}
