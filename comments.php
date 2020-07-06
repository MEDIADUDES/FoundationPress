<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/*
Do not delete these lines.
Prevent access to this file directly
*/

defined( 'ABSPATH' ) || die( esc_html__( 'Please do not load this page directly. Thanks!', 'foundationpress' ) );

if ( have_comments() ) :
	?>
	<section id="comments">
		<?php
		wp_list_comments(
			[
				'walker'            => new Foundationpress_Comments(),
				'max_depth'         => '',
				'style'             => 'ol',
				'callback'          => null,
				'end-callback'      => null,
				'type'              => 'all',
				'reply_text'        => __( 'Reply', 'foundationpress' ),
				'page'              => '',
				'per_page'          => '',
				'avatar_size'       => 48,
				'reverse_top_level' => null,
				'reverse_children'  => '',
				'format'            => 'html5',
				'short_ping'        => false,
				'echo'              => true,
				'moderation'        => __( 'Your comment is awaiting moderation.', 'foundationpress' ),
			]
		);

		foundationpress_the_comments_pagination();
		?>
	</section>
	<?php
endif;

if ( post_password_required() ) {
	?>
	<section id="comments">
		<div class="notice">
			<p class="bottom"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'foundationpress' ); ?></p>
		</div>
	</section>
	<?php
	return;
}

if ( comments_open() ) :
	?>
	<section id="respond">
		<?php
			comment_form(
				[
					'class_submit' => 'button',
				]
			);
		?>
	</section>
	<?php
endif;
