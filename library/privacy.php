<?php
/**
 * Functionality to improve privacy of users.
 *
 * @package FoundationPress
 * @since FoundationPress 3.0.0
 */

/**
 * Replaces normal YouTube embeds with nocookie embeds
 * in the_content to improve privacy of users.
 *
 * @param string $content the content.
 */
function foundationpress_replace_youtube_nocookie( $content ) {
	return str_replace( 'youtube.com/embed', 'youtube-nocookie.com/embed', $content );
}
add_filter( 'the_content', 'foundationpress_replace_youtube_nocookie', 99999 );


/**
 * Remove IPs from comments.
 *
 * @param string $comment_author_ip the ip of the comment author.
 */
function foundationpress_remove_commentsip( $comment_author_ip ) {
	return '';
}
add_filter( 'pre_comment_user_ip', 'foundationpress_remove_commentsip' );
