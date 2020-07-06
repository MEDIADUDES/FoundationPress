<?php
/**
 * Configure responsive images sizes
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 2.6.0
 */

// Add featured image sizes
//
// Sizes are optimized and cropped for landscape aspect ratio
// and optimized for HiDPI displays on 'small' and 'medium' screen sizes.
add_image_size( 'featured-small', 640, 200, true ); // name, width, height, crop
add_image_size( 'featured-medium', 1280, 400, true );
add_image_size( 'featured-large', 1440, 400, true );
add_image_size( 'featured-xlarge', 1920, 400, true );

// Add additional image sizes
add_image_size( 'fp-small', 640 );
add_image_size( 'fp-medium', 1024 );
add_image_size( 'fp-large', 1200 );
add_image_size( 'fp-xlarge', 1920 );

/**
 * Register the new image sizes for use in the add media modal in wp-admin
 *
 * @param array $sizes existing sizes.
 */
function foundationpress_custom_sizes( $sizes ) {
	return array_merge(
		$sizes,
		[
			'fp-small'  => __( 'FP Small', 'foundationpress' ),
			'fp-medium' => __( 'FP Medium', 'foundationpress' ),
			'fp-large'  => __( 'FP Large', 'foundationpress' ),
			'fp-xlarge' => __( 'FP XLarge', 'foundationpress' ),
		]
	);
}
add_filter( 'image_size_names_choose', 'foundationpress_custom_sizes' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality for content images
 *
 * @param string $sizes responsive image sizes.
 * @param array  $size image size array.
 */
function foundationpress_adjust_image_sizes_attr( $sizes, $size ) {

	// Actual width of image
	$width = $size[0];

	// Full width page template
	if ( is_page_template( 'page-templates/page-full-width.php' ) ) {
		if ( 1200 < $width ) {
			$sizes = '(max-width: 1199px) 98vw, 1200px';
		} else {
			$sizes = '(max-width: 1199px) 98vw, ' . $width . 'px';
		}
	} else { // Default 3/4 column post/page layout
		if ( 770 < $width ) {
			$sizes = '(max-width: 639px) 98vw, (max-width: 1199px) 64vw, 770px';
		} else {
			$sizes = '(max-width: 639px) 98vw, (max-width: 1199px) 64vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'foundationpress_adjust_image_sizes_attr', 10, 2 );

/**
 * Remove inline width and height attributes for post thumbnails
 *
 * @param string $html html of post thumbnail.
 * @param int    $post_id post id.
 * @param int    $post_image_id post image id.
 */
function foundationpress_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	if ( ! strpos( $html, 'attachment-shop_single' ) ) {
		$html = preg_replace( '/^(width|height)=\"\d*\"\s/', '', $html );
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'foundationpress_remove_thumbnail_dimensions', 10, 3 );
