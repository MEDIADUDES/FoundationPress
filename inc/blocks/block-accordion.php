<?php
/**
 * Gutenberg Accordion Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Accordion extends Block {
	public static function get_name(): string {
		return 'accordion';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Accordion', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/accordion.php',
				'category'        => 'foundationpress',
				'icon'            => 'editor-help',
				'keywords'        => [ 'accordion', 'faq', 'akkordion' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Accordion::init();
