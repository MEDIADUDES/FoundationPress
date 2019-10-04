<?php
/**
 * Some helper functions.
 *
 * @package FoundationPress
 */

/**
 * Returns URI to assets without trailing slash.
 *
 * @param boolean $echo whether to echo the URI.
 */
function fp_assets_uri( $echo = true ) {
	$uri = get_template_directory_uri() . '/dist/assets';
	if ( $echo ) {
		echo esc_url( $uri );
	}
	return $uri;
}

/**
 * Echoes the background-image css property with the URL from the specified ACF field.
 *
 * @param string $field name of the field.
 * @param mixed  $post_id post id to get field from.
 *
 * @see https://www.advancedcustomfields.com/resources/get_field/
 */
function fp_acf_bg_img( $field, $post_id = false ) {
	$bg = $field;
	if ( is_string( $bg ) ) {
		$bg = get_field( $bg, $post_id );
	}

	if ( $bg ) {
		if ( is_array( $bg ) ) {
			$bg = $bg['url'];
		}

		echo esc_attr( "background-image: url('{$bg}');" );
	}
}

/**
 * Get a list of pages wichh use specific template.
 *
 * @param string $template name of the template file. Must include .php ending.
 * @param array  $args additional arguments to pass to the get_pages function.
 * @return array list of pages. see https://codex.wordpress.org/Function_Reference/get_pages.
 */
function fp_get_pages_by_template( $template = '', $args = [] ) {
	if ( empty( $template ) ) {
		return false;
	}
	if ( strpos( $template, '.php' ) !== ( strlen( $template ) - 4 ) ) {
		$template .= '.php';
	}
	$args['meta_key']   = '_wp_page_template';
	$args['meta_value'] = $template;
	return get_pages( $args );
}

/**
 * Generates random string with specified length.
 *
 * @see https://stackoverflow.com/a/13212994/2180161
 *
 * @param integer $length lenght of the string.
 * @return string the generated string.
 */
function fp_generate_random_string( $length = 10 ) {
	$x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr( str_shuffle( str_repeat( $x, ceil( $length / strlen( $x ) ) ) ), 1, $length );
}
