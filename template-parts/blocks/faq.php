<?php
/**
 * FAQ Block Template.
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

use FoundationPress\Blocks\Block_FAQ;

$settings = $block;
$block    = new Block_FAQ( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$faq = get_field( 'faq' ) ?: ( true === $is_preview ? [
	[
		'question' => 'Your question here...',
		'answer'   => 'Your answer here...',
	],
	[
		'question' => 'Your question here...',
		'answer'   => 'Your answer here...',
	],
] : false );

$heading = get_field( 'heading' );

if ( ! $faq ) {
	// important: reset $block variable to initial value.
	$block = $settings;
	return;
}

// split the questions in 2 pieces.
$len        = count( $faq );
$firsthalf  = array_slice( $faq, 0, ceil( $len / 2 ) );
$secondhalf = array_slice( $faq, ceil( $len / 2 ) );
$faq        = [$firsthalf, $secondhalf];
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section b-faq <?php echo esc_attr( $class_names ); ?>">
	<?php if ( $heading ) : ?>
		<h2 class="b-faq__heading"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<div class="b-faq__accordions">
		<?php foreach ( $faq as $half ) : ?>
			<ul class="accordion" data-accordion data-allow-all-closed="true">
				<?php foreach ( $half as $item ) : ?>
					<li class="accordion-item" data-accordion-item>
						<a href="#" class="accordion-title">
							<?php echo esc_html( $item['question'] ); ?>
						</a>

						<div class="accordion-content" data-tab-content>
							<?php echo wp_kses_post( $item['answer'] ); ?>
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
