<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content main-content--with-sidebar">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', '' );
				the_post_navigation();
				comments_template();
			endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
