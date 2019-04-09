<?php
/**
 * Add Custom Post Type to store content which is shared among different pages.
 *
 * @package FoundationPress
 */

/**
 * Register Shared Content CPT.
 */
function fp_register_shared_content_cpt() {
	$args = [
		'label'              => __( 'Shared Content', 'foundationpress' ),
		'description'        => __( 'Wird genutzt, um geteilte Inhalte auf verschiedenen Seiten zentral zu verwalten. ', 'foundationpress' ),
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
add_action( 'init', 'fp_register_shared_content_cpt', 0 );


function fp_shared_content_info_after_title() {
	$current_screen = get_current_screen();
	if ( 'shared_content' !== $current_screen->id ) {
		return;
	}

	esc_html_e( 'Felder mit Advanced Custom Fields hinzufügen, um geteilten Inhalt zu verwenden.', 'foundationpress' );
}
add_action( 'edit_form_after_title', 'fp_shared_content_info_after_title' );
