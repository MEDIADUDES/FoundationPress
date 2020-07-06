<?php
/**
 * FoundationPress Comments
 *
 * @package FoundationPress
 */

if ( ! class_exists( 'Foundationpress_Comments' ) ) :
	class Foundationpress_Comments extends Walker_Comment {

		/**
		 * Init classwide variables.
		 *
		 * @var string
		 */
		public $tree_type = 'comment';

		/**
		 * Comment ID
		 *
		 * @var array
		 */
		public $db_fields = [
			'parent' => 'comment_parent',
			'id'     => 'comment_ID',
		];

		/** CONSTRUCTOR
		 * You'll have to use this if you plan to get to the top of the comments list, as
		 * start_lvl() only goes as high as 1 deep nested comments */
		public function __construct() { ?>

			<h3><?php comments_number( __( 'No Responses to', 'foundationpress' ), __( 'One Response to', 'foundationpress' ), __( '% Responses to', 'foundationpress' ) ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
			<ol class="comment-list">

			<?php
		}

		/** START_LVL
		 * Starts the list before the CHILD elements are added. */
		public function start_lvl( &$output, $depth = 0, $args = [] ) {
			$GLOBALS['comment_depth'] = $depth + 1; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			?>

					<ul class="children">
			<?php
		}

		/** END_LVL
		 * Ends the children list of after the elements are added. */
		public function end_lvl( &$output, $depth = 0, $args = [] ) {
			$GLOBALS['comment_depth'] = $depth + 1; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			?>

			</ul><!-- /.children -->

			<?php
		}

		/** START_EL */
		public function start_el( &$output, $comment, $depth = 0, $args = [], $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$GLOBALS['comment']       = $comment; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$parent_class             = ( empty( $args['has_children'] ) ? '' : 'parent' );
			?>

			<li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-body-<?php comment_ID(); ?>" class="comment-body">



			<header class="comment-author">

				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>

				<div class="author-meta vcard author">

				<?php
				printf(
					// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
					// translators: %s: comment author link
					'<cite class="fn">%s</cite>',
					// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
					get_comment_author_link()
				);
				?>
				<time datetime="<?php echo esc_html( comment_date( 'c' ) ); ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?></a></time>

			</div><!-- /.comment-author -->

			</header>

				<section id="comment-content-<?php comment_ID(); ?>" class="comment">
					<?php if ( ! $comment->comment_approved ) : ?>
							<div class="notice">
					<p class="bottom"><?php esc_html_e( 'Your comment is awaiting moderation.', 'foundationpress' ); ?></p>
				</div>
						<?php
					else :
						comment_text();
						?>
					<?php endif; ?>
				</section><!-- /.comment-content -->

				<div class="comment-meta comment-meta-data hide">
					<a href="<?php echo esc_url( get_comment_link( get_comment_ID() ) ); ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
				</div><!-- /.comment-meta -->

				<div class="reply">
					<?php
					$reply_args = [
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					];

						comment_reply_link( array_merge( $args, $reply_args ) );
					?>
					</div><!-- /.reply -->
				</article><!-- /.comment-body -->

			<?php
		}

		public function end_el( &$output, $comment, $depth = 0, $args = [] ) {
			?>

			</li><!-- /#comment-' . get_comment_ID() . ' -->

			<?php
		}

		/** DESTRUCTOR */
		public function __destruct() {
			?>

			</ol><!-- /#comment-list -->

			<?php
		}
	}
endif;
