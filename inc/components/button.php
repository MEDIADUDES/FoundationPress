<?php
/**
 * Button Component
 *
 * @package FoundationPress
 */

/**
 * Button Component
 *
 * @param string|array $args if string, get_field methode is called.
 *                           if array: arguments used for the button.
 * @param array        $modifier modifier classes added to the button. use 'large'
 *                               to get the class 'button--large' added.
 * @param string       $icon FontAwesome icon classes.
 *
 * $args:
 * 'title'          => string,
 * 'is_custom_link' => bool,
 * 'custom_link'    => string,
 * 'page'           => string - URL of a page,
 * 'target'         => link target.
 */
function fopr_button( $args, $modifier = [], $icon = '' ) {
	$button = $args;
	if ( is_string( $button ) ) {
		$button = get_field( $button );
	}

	// abort if field not found.
	if ( ! $button ) {
		return;
	}

	// remove empty array keys.
	$button = array_filter( $button );

	// abort if array is empty now, because no data is available.
	if ( ! $button ) {
		return;
	}

	$title          = array_key_exists( 'title', $button ) ? $button['title'] : false;
	$is_custom_link = array_key_exists( 'is_custom_link', $button ) ? $button['is_custom_link'] : false;
	$custom_link    = array_key_exists( 'custom_link', $button ) ? $button['custom_link'] : false;
	$page           = array_key_exists( 'page', $button ) ? $button['page'] : false;
	$target         = array_key_exists( 'target', $button ) ? $button['target'] : '_self';
	$modifier       = array_key_exists( 'modifier', $button ) ? array_merge( $button['modifier'], $modifier ) : $modifier;
	$icon           = array_key_exists( 'icon', $button ) ? $button['icon'] : $icon;

	// title is mandatory for a button.
	if ( ! $title ) {
		return;
	}

	$modifier_classes = '';
	foreach ( $modifier as $item ) {
		if ( 'hollow' === $item ) {
			$modifier_classes .= 'hollow ';
		} else {
			$modifier_classes .= 'button--' . $item . ' ';
		}
	}

	$link = $is_custom_link ? $custom_link : $page;
	?>
	<a class="button <?php echo esc_attr( $modifier_classes ); ?>"
		data-smooth-scroll
		href="<?php echo esc_url( $link ); ?>"
		target="<?php echo esc_attr( $target ); ?>"
		>
		<?php
		echo esc_html( $title ? $title : '' );

		if ( ! empty( $icon ) ) :
			?>
			<i class="<?php echo esc_attr( $icon ); ?> button__icon"></i>
			<?php
		endif;
		?>
	</a>
	<?php
}
