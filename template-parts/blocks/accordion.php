<?php
/**
 * Accordion Block Template.
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

use FoundationPress\Blocks\Block_Accordion;

$settings = $block;
$block    = new Block_Accordion( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$accordion = get_field( 'accordion' ) ?: ( true === $is_preview ? [
	[
		'title'   => 'Your title here...',
		'content' => 'Your content here...',
	],
	[
		'title'   => 'Your title here...',
		'content' => 'Your content here...',
	],
] : false );

$two_columns = get_field( 'two_columns' ) ?: false;

if ( ! $accordion ) {
	// important: reset $block variable to initial value.
	$block = $settings;
	return;
}

// split the accordion items in 2 pieces.
if ( true === $two_columns ) {
	$class_names .= ' b-accordion--two-columns';

	$len        = count( $accordion );
	$firsthalf  = array_slice( $accordion, 0, ceil( $len / 2 ) );
	$secondhalf = array_slice( $accordion, ceil( $len / 2 ) );
	$accordion  = [$firsthalf, $secondhalf];
} else {
	$accordion = [$accordion];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section b-accordion <?php echo esc_attr( $class_names ); ?>">
	<div class="b-accordion__inner">
		<?php foreach ( $accordion as $half ) : ?>
			<ul class="accordion" data-accordion data-allow-all-closed="true">
				<?php foreach ( $half as $item ) : ?>
					<li class="accordion-item" data-accordion-item>
						<a href="#" class="accordion-title">
							<?php echo esc_html( $item['title'] ); ?>
						</a>

						<div class="accordion-content" data-tab-content>
							<?php echo wp_kses_post( $item['content'] ); ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
