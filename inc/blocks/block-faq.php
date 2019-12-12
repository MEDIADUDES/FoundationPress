<?php
/**
 * Gutenberg FAQ Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_FAQ extends Block {
	public static function get_name(): string {
		return 'faq';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'FAQ', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/faq.php',
				'category'        => 'foundationpress',
				'icon'            => 'editor-help',
				'keywords'        => [ 'fragen', 'questions' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_FAQ::init();
