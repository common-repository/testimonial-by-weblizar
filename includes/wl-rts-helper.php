<?php

defined( 'ABSPATH' ) || die();

class WL_RTS_Helper {

	/**
	 * Helper function for testimonial rating
	 *
	 * @return array
	 */
	public static function testimonial_rating() {
		return array(
			'5'   => number_format_i18n( 5 ),
			'4.5' => number_format_i18n( 4.5, 1 ),
			'4'   => number_format_i18n( 4 ),
			'3.5' => number_format_i18n( 3.5, 1 ),
			'3'   => number_format_i18n( 3 ),
			'2.5' => number_format_i18n( 2.5, 1 ),
			'2'   => number_format_i18n( 2 ),
			'1.5' => number_format_i18n( 1.5, 1 ),
			'1'   => number_format_i18n( 1 ),
		);
	}

	/**
	 * Helper function for  number of testimonial per slide for widest browser width for slide layout
	 *
	 * @return array
	 */
	public static function testimonial_per_slide() {
		return array(
			'1' => number_format_i18n( 1 ),
			'2' => number_format_i18n( 2 ),
			'3' => number_format_i18n( 3 ),
		);
	}

	/**
	 * Helper function for  testimonial pagination speed
	 *
	 * @return array
	 */
	public static function testimonial_pagination_speed() {
		return array(
			'800'  => number_format_i18n( 800 ),
			'1000' => number_format_i18n( 1000 ),
			'1200' => number_format_i18n( 1200 ),
			'1400' => number_format_i18n( 1400 ),
			'1600' => number_format_i18n( 1600 ),
			'1800' => number_format_i18n( 1800 ),
			'2000' => number_format_i18n( 2000 ),
		);
	}

	/**
	 * Helper function for  testimonial rewind speed
	 *
	 * @return array
	 */
	public static function testimonial_rewind_speed() {
		return array(
			'1000' => number_format_i18n( 1000 ),
			'1400' => number_format_i18n( 1400 ),
			'1800' => number_format_i18n( 1800 ),
			'2200' => number_format_i18n( 2200 ),
			'2600' => number_format_i18n( 2600 ),
		);
	}
}
