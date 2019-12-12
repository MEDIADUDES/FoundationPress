<?php
/**
 * Gutenberg Block with ACF
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

abstract class Block {
	/**
	 * The block settings and attributes.
	 *
	 * @var array
	 */
	protected $settings;

	/**
	 * A unique name that identifies the block (without namespace).
	 * Note: A block name can only contain lowercase alphanumeric characters
	 * and dashes, and must begin with a letter.
	 */
	abstract public static function get_name(): string;

	/**
	 * Calls acf_register_block_type function to register the block.
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	abstract public static function register_block_type(): void;

	public function __construct( array $settings ) {
		$this->settings = $settings;
	}

	/**
	 * Register all needed WordPress actions.
	 */
	public static function init(): void {
		// only run on child classes.
		if ( get_called_class() !== __CLASS__ ) {
			add_action( 'acf/init', [ get_called_class(), 'register_block_type' ] );
		}
	}

	/**
	 * Get the anchor to use for the id attribute..
	 */
	public function get_anchor(): string {
		$id = $this->get_name() . '-' . $this->settings['id'];
		if ( ! empty( $this->settings['anchor'] ) ) {
			$id = $this->settings['anchor'];
		}
		return $id;
	}

	/**
	 * Get block class names.
	 *
	 * @param string $names class names.
	 */
	public function get_class_names( string $names = '' ): string {
		if ( ! empty( $this->settings['className'] ) ) {
			$names .= ' ' . $this->settings['className'];
		}

		if ( ! empty( $this->settings['align'] ) ) {
			$names .= ' align' . $this->settings['align'];
		}

		return $names;
	}

	/**
	 * Whether the current block is the first block in the page.
	 *
	 * @param int $post_id ID of the current post.
	 */
	public function is_first_block( $post_id ): bool {
		$post = get_post( $post_id );

		if ( ! empty( $post ) && has_blocks( $post->post_content ) ) {
			$blocks = parse_blocks( $post->post_content );

			foreach ( $blocks as $block ) {
				if ( isset( $block['attrs']['id'] ) && $block['attrs']['id'] === $this->settings['id'] ) {
						return true;
				} elseif ( 'core/block' === $block['blockName'] ) {
					$block_content = parse_blocks( get_post( $block['attrs']['ref'] )->post_content );
					if ( isset( $block_content[0]['attrs']['id'] )
					&& $block_content[0]['attrs']['id'] === $this->settings['id'] ) {
						return true;
					}
				}
			}
		}

		return false;
	}
}

Block::init();
