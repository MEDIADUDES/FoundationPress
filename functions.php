<?php
/**
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// composer autoload.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Requires all files recursively within given directory
 *
 * @param string $path path to directory which should be required recursively.
 */
function foundationpress_recursive_require_dir( $path ) {
	$dir      = new RecursiveDirectoryIterator( $path );
	$iterator = new RecursiveIteratorIterator( $dir );
	foreach ( $iterator as $file ) {
		$fname = $file->getFilename();
		if ( preg_match( '%\.php$%', $fname ) ) {
			require_once $file->getPathname();
		}
	}
}

foundationpress_recursive_require_dir( get_template_directory() . '/inc' );
