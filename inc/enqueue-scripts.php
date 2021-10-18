<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_enqueue_scripts' ) ) :
	function foundationpress_enqueue_scripts() {

		// Enqueue the stylesheet.
		wp_enqueue_style(
			'foundationpress-styles',
			get_template_directory_uri() . '/dist/assets/css/main.css',
			false,
			filemtime( get_template_directory() . '/dist/assets/css/main.css' )
		);

		// Enqueue the scripts.
		wp_enqueue_script(
			'foundationpress-scripts-runtime',
			get_template_directory_uri() . '/dist/assets/js/runtime.js',
			['jquery'],
			filemtime( get_template_directory() . '/dist/assets/js/runtime.js' ),
			true
		);

		wp_enqueue_script(
			'foundationpress-scripts',
			get_template_directory_uri() . '/dist/assets/js/app.js',
			['jquery'],
			filemtime( get_template_directory() . '/dist/assets/js/app.js' ),
			true
		);

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_enqueue_scripts' );
endif;

function fopr_admin_enqueue_scripts() {
	global $pagenow;

	// fix password field is removed
	if ( 'user-new.php' !== $pagenow ) {
		// Enqueue the stylesheet.
		wp_enqueue_style(
			'foundationpress-admin-styles',
			get_template_directory_uri() . '/dist/assets/css/admin.css',
			['jquery'],
			filemtime( get_template_directory() . '/dist/assets/css/admin.css' )
		);

		// Enqueue the scripts.
		wp_enqueue_script(
			'foundationpress-scripts-runtime',
			get_template_directory_uri() . '/dist/assets/js/runtime.js',
			['jquery'],
			filemtime( get_template_directory() . '/dist/assets/js/runtime.js' ),
			true
		);

		wp_enqueue_script(
			'foundationpress-scripts',
			get_template_directory_uri() . '/dist/assets/js/app.js',
			false,
			filemtime( get_template_directory() . '/dist/assets/js/app.js' ),
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'fopr_admin_enqueue_scripts' );
