<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

	<footer class="footer">
		<div class="footer-grid">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</div>

		<nav class="legal-navigation" role="navigation">
			<?php foundationpress_footer_legal_nav(); ?>
		</nav>
	</footer>

	<?php if ( get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		</div><!-- Close off-canvas content -->
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
