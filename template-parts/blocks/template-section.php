<?php
/**
 * Template Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   int|string $post_id The post ID this block is saved to.
 * @package FoundationPress
 */

// we can disable some phpcs rules because we are not in the global scope.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited

use FoundationPress\Blocks\Block_Template_Section;

$settings = $block;
$block    = new Block_Template_Section( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$name = get_field( 'name' ) ?: false;

if ( function_exists( 'fopr_template_section' ) && $name ) {
	fopr_template_section( $name );
}

// important: reset $block variable to initial value.
$block = $settings;
