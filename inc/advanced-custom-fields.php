<?php
/**
 * Defines all functions needed for Advanced Custom Fields.
 *
 * It defines the load path as well as the save path. If ACF is not installed
 * a warning will be shown.
 *
 * @package FoundationPress
 * @since 3.0.0
 */

/**
 * Admin notice in backend if Advanced Custom Fields Pro is not installed.
 */
function foundationpress_acf_not_installed_error() {
	$class   = 'notice notice-error';
	$message = __( 'You need to have Advanced Custom Fields Pro installed to make the theme work properly!', 'foundationpress' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}

// needed for is_plugin_active function.
require_once ABSPATH . 'wp-admin/includes/plugin.php';

// Show admin notice if ACF Pro is not installed/active.
if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	add_action( 'admin_notices', 'foundationpress_acf_not_installed_error' );
}


/**
 * Initializes advanced custom fields fields
 *
 * @param array $paths acf load point paths.
 */
function foundationpress_acf_json_load_point( $paths ) {
	// append path.
	$paths[] = get_template_directory() . '/acf-fields';

	return $paths;
}
// Add ACF JSON load point to load acf groups of this theme.
add_filter( 'acf/settings/load_json', 'foundationpress_acf_json_load_point' );


/**
 * Saves advanced custom fields json fields
 *
 * @param string $path acf save point path.
 */
function foundationpress_acf_json_save_point( $path ) {
	// set path.
	$path = get_template_directory() . '/acf-fields';
	return $path;
}
/*
Set location for ACF to save groups as JSON files.
To enable saving them as json files set FP_ACF_SAVE_JSON to true in your wp-config.php.
*/
if ( defined( 'FP_ACF_SAVE_JSON' ) && FP_ACF_SAVE_JSON ) {
	add_filter( 'acf/settings/save_json', 'foundationpress_acf_json_save_point' );
}

/**
 * Add ACF option pages to the backend.
 */
function foundationpress_add_option_pages() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			[
				'page_title' => 'Theme Einstellungen',
				'menu_title' => 'Theme Einstellungen',
				'menu_slug'  => 'theme-settings',
				'redirect'   => false,
				'autoload'   => true,
			]
		);
	}
}
add_action( 'acf/init', 'foundationpress_add_option_pages' );
