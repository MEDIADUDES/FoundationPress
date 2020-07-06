<?php
/**
 * Button Block Template.
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

use FoundationPress\Blocks\Block_Button;

$settings = $block;
$block    = new Block_Button( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
?>

<div id="<?php echo esc_attr( $id ); ?>" class="b-button <?php echo esc_attr( $class_names ); ?>">
	<?php fopr_button( 'button' ); ?>
</div>

<?php
// important: reset $block variable to initial value.
$block = $settings;
