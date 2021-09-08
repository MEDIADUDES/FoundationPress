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

/**
 * Adding a new (custom) block category.
 *
 * @param   array                   $block_categories      Array of categories for block types.
 * @param   WP_Block_Editor_Context $block_editor_context  The current block editor context.
 */
function foundationpress_block_categories( $block_categories, $block_editor_context ) {
	return array_merge(
		$block_categories,
		[
			[
				'slug'  => 'foundationpress',
				'title' => 'FoundationPress',
				'icon'  => 'art',
			],
		]
	);
}
add_filter( 'block_categories_all', 'foundationpress_block_categories', 0, 2 );
