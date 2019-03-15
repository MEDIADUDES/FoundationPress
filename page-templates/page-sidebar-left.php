<?php
/**
 * Template Name: Left Sidebar
 *
 * @package FoundationPress
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-container">
	<div class="main-grid main-grid--sidebar-left">
		<main class="main-content main-content--with-sidebar">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
				comments_template();
			endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
