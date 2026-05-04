<?php
/**
 * Meta boxes for editable content when ACF is not active.
 *
 * @package Estatein
 */

/**
 * Field definitions shared by fallback meta boxes.
 *
 * @return array[]
 */
function estatein_content_meta_fields() {
	return array(
		'service'     => array(
			'title'  => __( 'Service Settings', 'estatein' ),
			'fields' => array(
				'icon'      => __( 'Icon Letter or Symbol', 'estatein' ),
				'cta_url'   => __( 'CTA URL', 'estatein' ),
				'cta_label' => __( 'CTA Label', 'estatein' ),
			),
		),
		'team_member' => array(
			'title'  => __( 'Team Member Details', 'estatein' ),
			'fields' => array(
				'initials' => __( 'Initials', 'estatein' ),
				'role'     => __( 'Role', 'estatein' ),
				'location' => __( 'Location', 'estatein' ),
				'email'    => __( 'Email', 'estatein' ),
				'linkedin' => __( 'LinkedIn URL', 'estatein' ),
			),
		),
		'testimonial' => array(
			'title'  => __( 'Testimonial Details', 'estatein' ),
			'fields' => array(
				'rating'   => __( 'Rating', 'estatein' ),
				'name'     => __( 'Client Name', 'estatein' ),
				'location' => __( 'Client Location', 'estatein' ),
				'initials' => __( 'Client Initials', 'estatein' ),
			),
		),
	);
}

/**
 * Adds fallback meta boxes.
 */
function estatein_add_content_meta_boxes() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	foreach ( estatein_content_meta_fields() as $post_type => $config ) {
		add_meta_box(
			'estatein_' . $post_type . '_details',
			$config['title'],
			'estatein_render_content_meta_box',
			$post_type,
			'normal',
			'high',
			array( 'fields' => $config['fields'] )
		);
	}
}
add_action( 'add_meta_boxes', 'estatein_add_content_meta_boxes' );

/**
 * Renders fallback meta boxes.
 *
 * @param WP_Post $post Current post object.
 * @param array   $box Meta box data.
 */
function estatein_render_content_meta_box( $post, $box ) {
	$fields = isset( $box['args']['fields'] ) ? $box['args']['fields'] : array();

	wp_nonce_field( 'estatein_save_content_meta', 'estatein_content_meta_nonce' );
	?>
	<table class="form-table">
		<tbody>
			<?php foreach ( $fields as $key => $label ) : ?>
				<tr>
					<th scope="row">
						<label for="estatein_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
					</th>
					<td>
						<input
							type="text"
							class="regular-text"
							id="estatein_<?php echo esc_attr( $key ); ?>"
							name="estatein_<?php echo esc_attr( $key ); ?>"
							value="<?php echo esc_attr( estatein_meta( $post->ID, $key ) ); ?>"
						/>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php
}

/**
 * Saves fallback content meta.
 *
 * @param int $post_id Current post ID.
 */
function estatein_save_content_meta( $post_id ) {
	if ( ! isset( $_POST['estatein_content_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['estatein_content_meta_nonce'] ) ), 'estatein_save_content_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_type = get_post_type( $post_id );
	$configs   = estatein_content_meta_fields();

	if ( ! isset( $configs[ $post_type ] ) ) {
		return;
	}

	foreach ( array_keys( $configs[ $post_type ]['fields'] ) as $field ) {
		if ( isset( $_POST[ 'estatein_' . $field ] ) ) {
			update_post_meta( $post_id, '_estatein_' . $field, sanitize_text_field( wp_unslash( $_POST[ 'estatein_' . $field ] ) ) );
		}
	}
}
add_action( 'save_post_service', 'estatein_save_content_meta' );
add_action( 'save_post_team_member', 'estatein_save_content_meta' );
add_action( 'save_post_testimonial', 'estatein_save_content_meta' );
