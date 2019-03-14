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
			get_stylesheet_directory_uri() . '/dist/assets/css/main.css',
			false,
			filemtime( get_stylesheet_directory() . '/dist/assets/css/main.css' )
		);

		// Enqueue the scripts.
		wp_enqueue_script(
			'foundationpress-scripts',
			get_stylesheet_directory_uri() . '/dist/assets/js/app.js',
			false,
			filemtime( get_stylesheet_directory() . '/dist/assets/js/app.js' ),
			true
		);

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_enqueue_scripts' );
endif;
