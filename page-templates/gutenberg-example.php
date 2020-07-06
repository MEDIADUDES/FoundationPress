<?php
/**
 * Template Name: Gutenberg Example
 *
 * Example template to show how to use gutenberg blocks in combination with template files.
 *
 * @package FoundationPress
 */

/**
 * Prints section of template.
 *
 * @param string $name name of the section.
 */
function fopr_template_section( $name ) {
	$id = get_the_ID();
	switch ( $name ) {
		case 'example-template-section':
			?>
			<section class="[ section section--full ] example">
				Hi, I'm an example section to show how to use templates mixed with Gutenberg blocks.
				Just use the Template Section block and enter the name of this case.
				This way you can use gutenberg blocks in one section and a section from the template in another.
			</section>
			<?php
			break;

		default:
			echo 'Template section "' . esc_html( $name ) . '" not found.';
	}
}

get_header();
?>

<div class="main-container main-container--full-width">
	<div class="main-grid">
		<main class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>

						<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</main>
	</div>
</div>

<?php
get_footer();
