<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content main-content--with-sidebar">
			<article>
				<header>
					<h1 class="entry-title"><?php esc_html_e( 'File Not Found', 'foundationpress' ); ?></h1>
				</header>
				<div class="entry-content">
					<div class="error">
						<p class="bottom"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
					</div>
					<p><?php esc_html_e( 'Please try the following:', 'foundationpress' ); ?></p>
					<ul>
						<li>
							<?php esc_html_e( 'Check your spelling', 'foundationpress' ); ?>
						</li>
						<li>
							<?php
								printf(
									// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
									/* translators: %s: home page url */
									__( 'Return to the <a href="%s">home page</a>', 'foundationpress' ),
									// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
									esc_url( home_url() )
								);
								?>
						</li>
						<li>
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction
							_e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' );
							?>
						</li>
					</ul>
				</div>
			</article>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
