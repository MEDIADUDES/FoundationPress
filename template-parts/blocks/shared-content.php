<?php
/**
 * Shared Content Block Template.
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

use FoundationPress\Blocks\Block_Shared_Content;

$settings = $block;
$block    = new Block_Shared_Content( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$shared_content = get_field( 'shared_content' ) ?: false;

if ( ! $shared_content ) {
	// important: reset $block variable to initial value.
	$block = $settings;
	return;
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="b-shared-content <?php echo esc_attr( $class_names ); ?>">
	<?php
	switch ( $shared_content ) {
		case 'example-shared-content':
			get_template_part( 'template-parts/shared-content/example-shared-content' );
			break;
	}
	?>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
