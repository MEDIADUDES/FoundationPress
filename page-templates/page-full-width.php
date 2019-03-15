<?php
/**
 * Template Name: Full Width
 *
 * @package FoundationPress
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-container main-container--full-width">
	<div class="main-grid">
		<main class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
				comments_template();
			endwhile;
			?>
		</main>
	</div>
</div>

<?php
get_footer();
