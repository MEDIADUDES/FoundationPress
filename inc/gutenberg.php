<?php
/**
 * Add theme support for Gutenberg editor.
 *
 * @package FoundationPress
 */

if ( ! function_exists( 'foundationpress_gutenberg_support' ) ) :
	function foundationpress_gutenberg_support() {

		// Add foundation color palette to the editor
		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Primary Color', 'foundationpress' ),
					'slug'  => 'primary',
					'color' => '#1779ba',
				],
				[
					'name'  => __( 'Secondary Color', 'foundationpress' ),
					'slug'  => 'secondary',
					'color' => '#767676',
				],
				[
					'name'  => __( 'Success Color', 'foundationpress' ),
					'slug'  => 'success',
					'color' => '#3adb76',
				],
				[
					'name'  => __( 'Warning color', 'foundationpress' ),
					'slug'  => 'warning',
					'color' => '#ffae00',
				],
				[
					'name'  => __( 'Alert color', 'foundationpress' ),
					'slug'  => 'alert',
					'color' => '#cc4b37',
				],
			]
		);

	}

	add_action( 'after_setup_theme', 'foundationpress_gutenberg_support' );
endif;

function foundationpress_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'foundationpress',
				'title' => 'FoundationPress',
				'icon'  => 'art',
			],
		]
	);
}
add_filter( 'block_categories', 'foundationpress_block_categories', 0, 2 );
