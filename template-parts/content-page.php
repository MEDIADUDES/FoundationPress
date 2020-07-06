<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$fopr_hide_title = get_field( 'hide_title' ) ?: false;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( true !== $fopr_hide_title ) : ?>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<footer>
		<?php
		wp_link_pages(
			[
				'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
				'after'  => '</p></nav>',
			]
		);
		if ( get_the_tags() ) {
			?>
			<p><?php the_tags(); ?></p>
			<?php
		}
		?>
	</footer>
</article>
