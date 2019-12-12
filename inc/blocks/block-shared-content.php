<?php
/**
 * Gutenberg Shared Content Block
 *
 * Use FoundationPress Shared Content as Gutenberg blocks.
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Shared_Content extends Block {
	public static function get_name(): string {
		return 'shared-content';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Shared Content', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/shared-content.php',
				'category'        => 'foundationpress',
				'icon'            => 'welcome-add-page',
				'keywords'        => [ 'shared', 'content' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Shared_Content::init();
