<?php
/**
 * Gutenberg Template Section Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Template_Section extends Block {
	public static function get_name(): string {
		return 'template-section';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Template Section', 'foundationpress' ),
				'description'     => __( 'Displays specific section of the current template. Template needs to define a fopr_template_section function.', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/template-section.php',
				'category'        => 'foundationpress',
				'icon'            => 'admin-tools',
				'keywords'        => [ 'template' ],
				'mode'            => 'edit',
				'supports'        => [
					'align'           => false,
					'anchor'          => false,
					'customClassName' => false,
				],
			]
		);
	}
}

Block_Template_Section::init();
