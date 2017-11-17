<?php

/**
* Jetpack_Google_Analytics_Options provides a single interface to module options
*
* @author allendav 
*/

/**
* Bail if accessed directly
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Jetpack_Google_Analytics_Options {
	public static function get_option( $option_name, $default = false ) {
		$o = get_option( 'jetpack_wga' );
		return isset( $o[ $option_name ] ) ? $o[ $option_name ] : $default;
	}

	public static function get_tracking_code() {
		return self::get_option( 'code', '' );
	}

	public static function has_tracking_code() {
		$code = self::get_tracking_code();
		return ! empty( $code );
	}

	// Options used by both legacy and universal analytics
	public static function anonymize_ip_is_enabled() {
		return self::get_option( 'anonymize_ip' );
	}

	// eCommerce options used by both legacy and universal analytics
	public static function track_purchases_is_enabled() {
		return self::get_option( 'ec_track_purchases' );
	}

	public static function track_add_to_cart_is_enabled() {
		return self::get_option( 'ec_track_add_to_cart' );
	}

	// Enhanced eCommerce options
	public static function enhanced_ecommerce_tracking_is_enabled() {
		return self::get_option( 'enh_ec_tracking' );
	}

	public static function debug_dump() {
		$messages = array( 'Jetpack_Google_Analytics_Options' );
		$tracking_code = self::has_tracking_code() ? self::get_tracking_code() : '(empty)';
		array_push( $messages, "get_tracking_code: $tracking_code" );

		$flags = array(
			'anonymize_ip_is_enabled',
			'track_purchases_is_enabled',
			'track_add_to_cart_is_enabled',
			'enhanced_ecommerce_tracking_is_enabled',
		);

		foreach( $flags as $flag ) {
			$value = call_user_func( 'Jetpack_Google_Analytics_Options::' . $flag ) ? 'true' : 'false';
			array_push( $messages, "$flag: $value" );
		}

		return $messages;
	}
}