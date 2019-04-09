<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		// phpcs:ignore Squiz.PHP.EmbeddedPhp.ContentBeforeOpen ?>
		<time class="updated" datetime="<?php the_time( 'c' ); ?>"><?php
			/* translators: %1$s: current date, %2$s: current time */
			sprintf( __( 'Posted on %1$s at %2$s.', 'foundationpress' ), get_the_date(), get_the_time() );
		// phpcs:ignore Squiz.PHP.EmbeddedPhp.ContentAfterEnd
		?></time>
		<p class="byline author"><?php esc_html__( 'Written by', 'foundationpress' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn"><?php the_author(); ?></a></p>
		<?php
	}
endif;
