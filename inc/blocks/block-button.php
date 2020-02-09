<?php
/**
 * Gutenberg Button Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Button extends Block {
	public static function get_name(): string {
		return 'button';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'FP Button', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/button.php',
				'category'        => 'foundationpress',
				'icon'            => 'shield-alt',
				'keywords'        => [ 'button' ],
				'supports'        => [
					'align'      => true,
					'anchor'     => true,
					'classNames' => false,
				],
			]
		);
	}
}

Block_Button::init();
