<?php
/**
 * Foundation PHP template
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/**
 * Pagination.
 *
 * To use the pagination for custom loops:
 * 1) pass paged argument to it:
 *   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 *   $loop  = new WP_Query(
 *       [
 *           'paged'          => $paged,
 *           'post_type'      => 'my_cpt',
 *           'posts_per_page' => 10,
 *       ]
 *   );
 *
 * 2) display pagination after your while loop:
 *   foundationpress_pagination( $paged, $loop->max_num_pages );
 *
 * @param string $paged
 * @param string $max_page
 * @return void
 */
if ( ! function_exists( 'foundationpress_pagination' ) ) :
	function foundationpress_pagination( $paged = '', $max_page = '' ) {
		global $wp_query;

		$big = 999999999; // This needs to be an unlikely integer

		if ( ! $paged ) {
			$paged = get_query_var( 'paged' );
		}
		if ( ! $max_page ) {
			$max_page = $wp_query->max_num_pages;
		}

		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links(
			[
				'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $max_page,
				'mid_size'  => 5,
				'prev_next' => true,
				'prev_text' => '',
				'next_text' => '',
				'type'      => 'list',
			]
		);

		// Display the pagination if more than one page is found.
		if ( $paginate_links ) {

			// Match patterns for preg_replace
			$preg_find = [
				'/\s*page-numbers\s*/', // Captures string 'page-numbers' and any whitespace before and after
				"/\s*class=''/", // Captures any empty class attributes
				'/<li><a class="prev" href="(\S+)">/', // '(\S+)' Captures href value for backreference
				'/<li><a class="next" href="(\S+)">/', // '(\S+)' Captures href value for backreference
				"/<li><span aria-current='page' class='current'>(\d+)<\/span><\/li>/", // '(\d+)' Captures page number for backreference
				"/<li><a href='(\S+)'>(\d+)<\/a><\/li>/", // '(\S+)' Captures href value for backreference, (\d+)' Captures page number for backreference
			];

			// preg_replace replacements
			$preg_replace = [
				'',
				'',
				'<li class="pagination-previous"><a href="$1" aria-label="Previous page">', // '$1' Outputs backreference href value
				'<li class="pagination-next"><a href="$1" aria-label="Next page">', // '$1' Outputs backreference href value
				'<li class="current" aria-current="page"><span class="show-for-sr">You\'re on page </span>$1</li>', // '$1' Outputs backreference page number
				'<li><a href="$1" aria-label="Page $2">$2</a></li>', // '$1' Ouputs backreference href, '$2' outputs backreference page number
			];

			// Match patterns for str_replace
			$str_find = [
				'<ul>',
				'<li><span class="dots">&hellip;</span></li>',
			];

			// str_replace replacements
			$str_replace = [
				'<ul class="pagination text-center">',
				'<li class="ellipsis" aria-hidden="true"></li>',
			];

			$paginate_links = preg_replace( $preg_find, $preg_replace, $paginate_links );
			$paginate_links = str_replace( $str_find, $str_replace, $paginate_links );

			$paginate_links = '<nav aria-label="Pagination">' . $paginate_links . '</nav>';

			echo $paginate_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

// Custom Comments Pagination.
if ( ! function_exists( 'foundationpress_get_the_comments_pagination' ) ) :
	function foundationpress_get_the_comments_pagination( $args = [] ) {
		$navigation   = '';
		$args         = wp_parse_args(
			$args,
			[
				'prev_text'     => __( '&laquo;', 'foundationpress' ),
				'next_text'     => __( '&raquo;', 'foundationpress' ),
				'size'          => 'default',
				'show_disabled' => true,
			]
		);
		$args['type'] = 'array';
		$args['echo'] = false;
		$links        = paginate_comments_links( $args );
		if ( $links ) {
			$link_count       = count( $links );
			$pagination_class = 'pagination';
			if ( 'large' === $args['size'] ) {
				$pagination_class .= ' pagination-lg';
			} elseif ( 'small' === $args['size'] ) {
				$pagination_class .= ' pagination-sm';
			}
			$current     = get_query_var( 'cpage' ) ? intval( get_query_var( 'cpage' ) ) : 1;
			$total       = get_comment_pages_count();
			$navigation .= '<ul class="' . $pagination_class . '">';
			if ( $args['show_disabled'] && 1 === $current ) {
				$navigation .= '<li class="page-item disabled">' . $args['prev_text'] . '</li>';
			}
			foreach ( $links as $index => $link ) {
				if ( 0 === $index && 0 === strpos( $link, '<a class="prev' ) ) {
					$navigation .= '<li class="page-item">' . str_replace( 'prev page-numbers', 'page-link', $link ) . '</li>';
				} elseif ( $link_count - 1 === $index && 0 === strpos( $link, '<a class="next' ) ) {
					$navigation .= '<li class="page-item">' . str_replace( 'next page-numbers', 'page-link', $link ) . '</li>';
				} else {
					$link = preg_replace( "/(class|href)='(.*)'/U", '$1="$2"', $link );
					if ( 0 === strpos( $link, '<span class="page-numbers current' ) ) {
						$navigation .= '<li class="page-item active">' . str_replace( [ '<span class="page-numbers current">', '</span>' ], [ '<a class="page-link" href="#">', '</a>' ], $link ) . '</li>';
					} elseif ( 0 === strpos( $link, '<span class="page-numbers dots' ) ) {
						$navigation .= '<li class="page-item disabled">' . str_replace( [ '<span class="page-numbers dots">', '</span>' ], [ '<a class="page-link" href="#">', '</a>' ], $link ) . '</li>';
					} else {
						$navigation .= '<li class="page-item">' . str_replace( 'class="page-numbers', 'class="page-link', $link ) . '</li>';
					}
				}
			}
			if ( $args['show_disabled'] && $current === $total ) {
				$navigation .= '<li class="page-item disabled">' . $args['next_text'] . '</li>';
			}
			$navigation .= '</ul>';
			$navigation  = _navigation_markup( $navigation, 'comments-pagination' );
		}
		return $navigation;
	}
endif;

// Custom Comments Pagination.
if ( ! function_exists( 'foundationpress_the_comments_pagination' ) ) :
	function foundationpress_the_comments_pagination( $args = [] ) {
		echo foundationpress_get_the_comments_pagination( $args );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


/**
 * A fallback when no navigation is selected by default.
 */

if ( ! function_exists( 'foundationpress_menu_fallback' ) ) :
	function foundationpress_menu_fallback() {
		echo '<div class="alert-box secondary">';
		printf(
			/* translators: %1$s: link to menus, %2$s: link to customize. */
			esc_html__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'foundationpress' ),
			sprintf(
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				/* translators: %s: menu url */
				__( '<a href="%s">Menus</a>', 'foundationpress' ),
				// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
				esc_url( get_admin_url( get_current_blog_id(), 'nav-menus.php' ) )
			),
			sprintf(
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				/* translators: %s: customize url */
				__( '<a href="%s">Customize</a>', 'foundationpress' ),
				// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
				esc_url( get_admin_url( get_current_blog_id(), 'customize.php' ) )
			)
		);
		echo '</div>';
	}
endif;

// Add Foundation 'is-active' class for the current menu item.
if ( ! function_exists( 'foundationpress_active_nav_class' ) ) :
	function foundationpress_active_nav_class( $classes, $item ) {
		if ( 1 === $item->current || $item->current_item_ancestor ) {
			$classes[] = 'is-active';
		}
		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'foundationpress_active_nav_class', 10, 2 );
endif;

/**
 * Use the is-active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch.
 */
if ( ! function_exists( 'foundationpress_active_list_pages_class' ) ) :
	function foundationpress_active_list_pages_class( $input ) {

		$pattern = '/current_page_item/';
		$replace = 'current_page_item is-active';

		$output = preg_replace( $pattern, $replace, $input );

		return $output;
	}
	add_filter( 'wp_list_pages', 'foundationpress_active_list_pages_class', 10, 2 );
endif;



/**
 * Get mobile menu ID
 */

if ( ! function_exists( 'foundationpress_mobile_menu_id' ) ) :
	function foundationpress_mobile_menu_id() {
		if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) {
			echo 'off-canvas-menu';
		} else {
			echo 'mobile-menu';
		}
	}
endif;

/**
 * Get title bar responsive toggle attribute
 */

if ( ! function_exists( 'foundationpress_title_bar_responsive_toggle' ) ) :
	function foundationpress_title_bar_responsive_toggle() {
		if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) {
			echo 'data-responsive-toggle="mobile-menu"';
		}
	}
endif;

/**
 * Custom markup for WordPress gallery
 */
if ( ! function_exists( 'foundationpress_gallery' ) ) :
	function foundationpress_gallery( $attr ) {

		$post            = get_post();
		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}

		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters( 'foundationpress_post_gallery', '', $attr, $instance );
		if ( '' !== $output ) {
			return $output;
		}

		// Let's make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		$atts = shortcode_atts(
			[
				'order'          => 'ASC',
				'orderby'        => 'menu_order ID',
				'id'             => $post ? $post->ID : 0,
				'itemtag'        => 'figure',
				'icontag'        => 'div',
				'captiontag'     => 'figcaption',
				'columns-small'  => 2, // set default columns for small screen
				'columns-medium' => 4, // set default columns for medium screen
				'columns'        => 3, // set default columns for large screen (3 = wordpress default)
				'size'           => 'thumbnail',
				'include'        => '',
				'exclude'        => '',
			],
			$attr,
			'gallery'
		);

		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$_attachments = get_posts(
				[
					'include'        => $atts['include'],
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $atts['order'],
					'orderby'        => $atts['orderby'],
				]
			);

			$attachments = [];
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children(
				[
					'post_parent'    => $id,
					'exclude'        => $atts['exclude'],
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $atts['order'],
					'orderby'        => $atts['orderby'],
				]
			);
		} else {
			$attachments = get_children(
				[
					'post_parent'    => $id,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $atts['order'],
					'orderby'        => $atts['orderby'],
				]
			);
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
			}
			return $output;
		}

		$item_tag    = tag_escape( $atts['itemtag'] );
		$caption_tag = tag_escape( $atts['captiontag'] );
		$icon_tag    = tag_escape( $atts['icontag'] );
		$valid_tags  = wp_kses_allowed_html( 'post' );

		if ( ! isset( $valid_tags[ $item_tag ] ) ) {
			$item_tag = 'figure';
		}
		if ( ! isset( $valid_tags[ $caption_tag ] ) ) {
			$caption_tag = 'figcaption';
		}
		if ( ! isset( $valid_tags[ $icon_tag ] ) ) {
			$icon_tag = 'div';
		}

		$columns        = intval( $atts['columns'] );
		$columns_small  = intval( $atts['columns-small'] );
		$columns_medium = intval( $atts['columns-medium'] );
		$selector       = "gallery-{$instance}";
		$size_class     = sanitize_html_class( $atts['size'] );

		// Edit this line to modify the default number of grid columns for the small and medium sizes. The large size is passed in the WordPress gallery settings.
		$output = "<div id='$selector' class='fp-gallery galleryid-{$id} gallery-size-{$size_class} grid-x grid-margin-x small-up-{$columns_small} medium-up-{$columns_medium} large-up-{$columns}'>";

		foreach ( $attachments as $id => $attachment ) {

			// Check if destination is file, nothing or attachment page.
			if ( isset( $attr['link'] ) && 'file' === $attr['link'] ) {
				$link = wp_get_attachment_link(
					$id,
					$size_class,
					false,
					false,
					false,
					[
						'class' => '',
						'id'    => "imageid-$id",
					]
				);

				// Edit this line to implement your html params in <a> tag with use a custom lightbox plugin.
				$link = str_replace( '<a href', '<a class="thumbnail fp-gallery-lightbox" data-gall="fp-gallery-' . $post->ID . '" data-title="' . wptexturize( $attachment->post_excerpt ) . '" title="' . wptexturize( $attachment->post_excerpt ) . '" href', $link );

			} elseif ( isset( $attr['link'] ) && 'none' === $attr['link'] ) {
				$link = wp_get_attachment_image(
					$id,
					$size_class,
					false,
					[
						'class' => "thumbnail attachment-$size_class size-$size_class",
						'id'    => "imageid-$id",
					]
				);
			} else {
				$link = wp_get_attachment_link(
					$id,
					$size_class,
					true,
					false,
					false,
					[
						'class' => '',
						'id'    => "imageid-$id",
					]
				);
				$link = str_replace( '<a href', '<a class="thumbnail" title="' . wptexturize( $attachment->post_excerpt ) . '" href', $link );
			}

			$image_meta  = wp_get_attachment_metadata( $id );
			$orientation = '';
			if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
			}
			$output .= "<{$item_tag} class='fp-gallery-item cell'>";
			$output .= "
		        <{$icon_tag} class='fp-gallery-icon {$orientation}'>
		            $link
		        </{$icon_tag}>";

			// Uncomment if you wish to display captions inline on gallery.
			// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
			/*
			if ( $caption_tag && trim($attachment->post_excerpt) ) {
				$output .= "
					<{$caption_tag} class='wp-caption-text gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$caption_tag}>";
			}
			*/

			$output .= "</{$item_tag}>";

		}
		$output .= "</div>\n";

		return $output;
	}
	add_shortcode( 'gallery', 'foundationpress_gallery' );
endif;
