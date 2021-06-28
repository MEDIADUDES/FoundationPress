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
		if ( function_exists( 'acf_register_block_type' ) ) {
			acf_register_block_type(
				[
					'name'            => self::get_name(),
					'title'           => __( 'FP Button', 'foundationpress' ),
					'render_template' => 'template-parts/blocks/' . self::get_name() . '.php',
					'enqueue_style'   => get_template_directory_uri() . '/dist/assets/css/blocks/' . self::get_name() . '.css',
					// 'enqueue_script'  => get_template_directory_uri() . '/dist/assets/js/blocks/' . self::get_name() . '.js',
					'category'        => 'foundationpress',
					'icon'            => 'shield-alt',
					'keywords'        => [ self::get_name() ],
					'supports'        => [
						'align'      => true,
						'anchor'     => true,
						'classNames' => true,
					],
				]
			);
		}
	}
}

Block_Button::init();
