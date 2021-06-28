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
		if ( function_exists( 'acf_register_block_type' ) ) {
			acf_register_block_type(
				[
					'name'            => self::get_name(),
					'title'           => __( 'Accordion', 'foundationpress' ),
					'render_template' => 'template-parts/blocks/' . self::get_name() . '.php',
					'enqueue_style'   => get_template_directory_uri() . '/dist/assets/css/blocks/' . self::get_name() . '.css',
					'enqueue_script'  => get_template_directory_uri() . '/dist/assets/js/blocks/' . self::get_name() . '.js',
					'category'        => 'foundationpress',
					'icon'            => 'editor-help',
					'keywords'        => [ self::get_name(), 'faq', 'akkordion' ],
					'supports'        => [
						'align'      => false,
						'anchor'     => true,
						'classNames' => true,
					],
				]
			);
		}
	}
}

Block_Accordion::init();
