<?php
/**
 * Optional Advanced Custom Fields registration.
 *
 * The theme works without ACF through fallback meta boxes. When ACF is active,
 * these local field groups provide a more polished editing interface.
 *
 * @package Estatein
 */

/**
 * Registers ACF local field groups when ACF is installed.
 */
function estatein_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'      => 'group_estatein_property',
		'title'    => __( 'Property Details', 'estatein' ),
		'fields'   => array(
			estatein_acf_text_field( 'price', __( 'Price', 'estatein' ), 'property' ),
			estatein_acf_text_field( 'address', __( 'Address', 'estatein' ), 'property' ),
			estatein_acf_text_field( 'beds', __( 'Bedrooms', 'estatein' ), 'property' ),
			estatein_acf_text_field( 'baths', __( 'Bathrooms', 'estatein' ), 'property' ),
			estatein_acf_text_field( 'area', __( 'Area', 'estatein' ), 'property' ),
			estatein_acf_text_field( 'label', __( 'Listing Label', 'estatein' ), 'property' ),
			array(
				'key'           => 'field_estatein_featured',
				'label'         => __( 'Featured Property', 'estatein' ),
				'name'          => 'estatein_featured',
				'type'          => 'true_false',
				'ui'            => 1,
				'return_format' => 'value',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'property',
				),
			),
		),
	) );

	acf_add_local_field_group( array(
		'key'      => 'group_estatein_service',
		'title'    => __( 'Service Settings', 'estatein' ),
		'fields'   => array(
			estatein_acf_text_field( 'icon', __( 'Icon Letter or Symbol', 'estatein' ), 'service' ),
			estatein_acf_url_field( 'cta_url', __( 'CTA URL', 'estatein' ), 'service' ),
			estatein_acf_text_field( 'cta_label', __( 'CTA Label', 'estatein' ), 'service' ),
		),
		'location' => estatein_acf_location( 'service' ),
	) );

	acf_add_local_field_group( array(
		'key'      => 'group_estatein_team',
		'title'    => __( 'Team Member Details', 'estatein' ),
		'fields'   => array(
			estatein_acf_text_field( 'initials', __( 'Initials', 'estatein' ), 'team' ),
			estatein_acf_text_field( 'role', __( 'Role', 'estatein' ), 'team' ),
			estatein_acf_text_field( 'location', __( 'Location', 'estatein' ), 'team' ),
			estatein_acf_email_field( 'email', __( 'Email', 'estatein' ), 'team' ),
			estatein_acf_url_field( 'linkedin', __( 'LinkedIn URL', 'estatein' ), 'team' ),
		),
		'location' => estatein_acf_location( 'team_member' ),
	) );

	acf_add_local_field_group( array(
		'key'      => 'group_estatein_testimonial',
		'title'    => __( 'Testimonial Details', 'estatein' ),
		'fields'   => array(
			estatein_acf_text_field( 'rating', __( 'Rating', 'estatein' ), 'testimonial' ),
			estatein_acf_text_field( 'name', __( 'Client Name', 'estatein' ), 'testimonial' ),
			estatein_acf_text_field( 'location', __( 'Client Location', 'estatein' ), 'testimonial' ),
			estatein_acf_text_field( 'initials', __( 'Client Initials', 'estatein' ), 'testimonial' ),
		),
		'location' => estatein_acf_location( 'testimonial' ),
	) );
}
add_action( 'acf/init', 'estatein_register_acf_fields' );

/**
 * Builds a text field definition.
 *
 * @param string $name Field name without prefix.
 * @param string $label Field label.
 * @param string $scope Unique field scope.
 * @return array
 */
function estatein_acf_text_field( $name, $label, $scope ) {
	return array(
		'key'   => 'field_estatein_' . $scope . '_' . $name,
		'label' => $label,
		'name'  => 'estatein_' . $name,
		'type'  => 'text',
	);
}

/**
 * Builds a URL field definition.
 *
 * @param string $name Field name without prefix.
 * @param string $label Field label.
 * @param string $scope Unique field scope.
 * @return array
 */
function estatein_acf_url_field( $name, $label, $scope ) {
	$field         = estatein_acf_text_field( $name, $label, $scope );
	$field['type'] = 'url';
	return $field;
}

/**
 * Builds an email field definition.
 *
 * @param string $name Field name without prefix.
 * @param string $label Field label.
 * @param string $scope Unique field scope.
 * @return array
 */
function estatein_acf_email_field( $name, $label, $scope ) {
	$field         = estatein_acf_text_field( $name, $label, $scope );
	$field['type'] = 'email';
	return $field;
}

/**
 * Builds a simple ACF post type location rule.
 *
 * @param string $post_type Post type key.
 * @return array
 */
function estatein_acf_location( $post_type ) {
	return array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => $post_type,
			),
		),
	);
}
