<?php
/**
 * Custom post types and taxonomies.
 *
 * @package Estatein
 */

/**
 * Registers all Estatein content models.
 */
function estatein_register_content_types() {
	estatein_register_property_post_type();
	estatein_register_simple_post_type( 'service', __( 'Services', 'estatein' ), __( 'Service', 'estatein' ), 'dashicons-admin-tools', 'services-list' );
	estatein_register_simple_post_type( 'team_member', __( 'Team Members', 'estatein' ), __( 'Team Member', 'estatein' ), 'dashicons-groups', 'team' );
	estatein_register_simple_post_type( 'testimonial', __( 'Testimonials', 'estatein' ), __( 'Testimonial', 'estatein' ), 'dashicons-format-quote', 'testimonials' );
	estatein_register_simple_post_type( 'faq', __( 'FAQs', 'estatein' ), __( 'FAQ', 'estatein' ), 'dashicons-editor-help', 'faqs' );
}
add_action( 'init', 'estatein_register_content_types' );

/**
 * Registers the Property post type and taxonomies.
 */
function estatein_register_property_post_type() {
	$labels = array(
		'name'                  => __( 'Properties', 'estatein' ),
		'singular_name'         => __( 'Property', 'estatein' ),
		'menu_name'             => __( 'Properties', 'estatein' ),
		'name_admin_bar'        => __( 'Property', 'estatein' ),
		'add_new'               => __( 'Add New', 'estatein' ),
		'add_new_item'          => __( 'Add New Property', 'estatein' ),
		'new_item'              => __( 'New Property', 'estatein' ),
		'edit_item'             => __( 'Edit Property', 'estatein' ),
		'view_item'             => __( 'View Property', 'estatein' ),
		'all_items'             => __( 'All Properties', 'estatein' ),
		'search_items'          => __( 'Search Properties', 'estatein' ),
		'not_found'             => __( 'No properties found.', 'estatein' ),
		'not_found_in_trash'    => __( 'No properties found in Trash.', 'estatein' ),
		'featured_image'        => __( 'Property Image', 'estatein' ),
		'set_featured_image'    => __( 'Set property image', 'estatein' ),
		'remove_featured_image' => __( 'Remove property image', 'estatein' ),
	);

	register_post_type( 'property', array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => 'properties',
		'menu_icon'    => 'dashicons-building',
		'rewrite'      => array( 'slug' => 'properties' ),
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
	) );

	register_taxonomy( 'property_type', 'property', array(
		'labels'            => array(
			'name'          => __( 'Property Types', 'estatein' ),
			'singular_name' => __( 'Property Type', 'estatein' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'rewrite'           => array( 'slug' => 'property-type' ),
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	register_taxonomy( 'property_status', 'property', array(
		'labels'            => array(
			'name'          => __( 'Property Statuses', 'estatein' ),
			'singular_name' => __( 'Property Status', 'estatein' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'rewrite'           => array( 'slug' => 'property-status' ),
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );
}

/**
 * Registers a REST-enabled content post type with a simple editorial surface.
 *
 * @param string $post_type Post type key.
 * @param string $plural Plural label.
 * @param string $singular Singular label.
 * @param string $icon Dashicon.
 * @param string $slug URL slug.
 */
function estatein_register_simple_post_type( $post_type, $plural, $singular, $icon, $slug ) {
	register_post_type( $post_type, array(
		'labels'       => array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'menu_name'          => $plural,
			'add_new_item'       => sprintf( __( 'Add New %s', 'estatein' ), $singular ),
			'edit_item'          => sprintf( __( 'Edit %s', 'estatein' ), $singular ),
			'new_item'           => sprintf( __( 'New %s', 'estatein' ), $singular ),
			'view_item'          => sprintf( __( 'View %s', 'estatein' ), $singular ),
			'search_items'       => sprintf( __( 'Search %s', 'estatein' ), $plural ),
			'not_found'          => sprintf( __( 'No %s found.', 'estatein' ), strtolower( $plural ) ),
			'not_found_in_trash' => sprintf( __( 'No %s found in Trash.', 'estatein' ), strtolower( $plural ) ),
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => $icon,
		'rewrite'      => array( 'slug' => $slug ),
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ),
	) );
}

/**
 * Flushes rewrite rules after switching to the theme.
 */
function estatein_rewrite_flush() {
	estatein_register_content_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'estatein_rewrite_flush' );
