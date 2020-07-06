<?php
/**
 * Add Custom Post Type to store content which is shared among different pages.
 *
 * @package FoundationPress
 */

/**
 * Register Shared Content CPT.
 */
function fopr_register_shared_content_cpt() {
	$args = [
		'label'              => __( 'Shared Content', 'foundationpress' ),
		'description'        => __( 'Used to manage shared content from different pages on a central place.', 'foundationpress' ),
		'labels'             => [
			'name' => _x( 'Shared Content', 'Post Type General Name', 'foundationpress' ),
		],
		'supports'           => ['title'],
		'hierarchical'       => false,
		'public'             => false,
		'show_ui'            => true,
		'publicly_queryable' => false,
		'show_in_menu'       => true,
		'menu_position'      => 20, // decimal to decrease probability of conflicts.
		'capability_type'    => 'page',
	];
	register_post_type( 'shared_content', $args );

}
add_action( 'init', 'fopr_register_shared_content_cpt', 0 );


function fopr_shared_content_info_after_title() {
	$current_screen = get_current_screen();
	if ( 'shared_content' !== $current_screen->id ) {
		return;
	}

	esc_html_e( 'Add fields with Advanced Custom Fields to use shared content.', 'foundationpress' );
}
add_action( 'edit_form_after_title', 'fopr_shared_content_info_after_title' );
