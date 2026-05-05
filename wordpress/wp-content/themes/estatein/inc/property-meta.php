<?php
/**
 * Property admin meta fields.
 *
 * @package Estatein
 */

/**
 * Adds the property details meta box.
 */
function estatein_add_property_meta_box() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	add_meta_box(
		'estatein_property_details',
		__( 'Property Details', 'estatein' ),
		'estatein_render_property_meta_box',
		'property',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'estatein_add_property_meta_box' );

/**
 * Renders the property details meta box.
 *
 * @param WP_Post $post Current post object.
 */
function estatein_render_property_meta_box( $post ) {
	wp_nonce_field( 'estatein_save_property_meta', 'estatein_property_meta_nonce' );

	$text_fields = array(
		'price'           => __( 'Price', 'estatein' ),
		'address'         => __( 'Address', 'estatein' ),
		'beds'            => __( 'Bedrooms', 'estatein' ),
		'baths'           => __( 'Bathrooms', 'estatein' ),
		'area'            => __( 'Area', 'estatein' ),
		'label'           => __( 'Listing Label', 'estatein' ),
		'property_type'   => __( 'Property Type', 'estatein' ),
		'property_status' => __( 'Property Status', 'estatein' ),
		'year_built'      => __( 'Year Built', 'estatein' ),
	);

	$textarea_fields = array(
		'gallery_images'      => __( 'Gallery Image URLs (one per line)', 'estatein' ),
		'amenities'           => __( 'Amenities (one per line)', 'estatein' ),
		'inquiry_intro'       => __( 'Inquiry Intro', 'estatein' ),
		'pricing_details'     => __( 'Pricing Details', 'estatein' ),
		'pricing_note'        => __( 'Pricing Note', 'estatein' ),
		'additional_fees'     => __( 'Additional Fees (Label | Value | Note)', 'estatein' ),
		'monthly_costs'       => __( 'Monthly Costs (Label | Value | Note)', 'estatein' ),
		'total_initial_costs' => __( 'Total Initial Costs (Label | Value | Note)', 'estatein' ),
		'monthly_expenses'    => __( 'Monthly Expenses (Label | Value | Note)', 'estatein' ),
	);
	?>
	<table class="form-table">
		<tbody>
			<?php foreach ( $text_fields as $key => $label ) : ?>
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
								value="<?php echo esc_attr( estatein_property_meta( $post->ID, $key, estatein_property_editor_default( $key ) ) ); ?>"
							/>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php foreach ( $textarea_fields as $key => $label ) : ?>
					<tr>
						<th scope="row">
							<label for="estatein_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
					</th>
					<td>
						<textarea
							class="large-text"
							rows="5"
							id="estatein_<?php echo esc_attr( $key ); ?>"
							name="estatein_<?php echo esc_attr( $key ); ?>"
							><?php echo esc_textarea( estatein_property_meta( $post->ID, $key, estatein_property_editor_default( $key ) ) ); ?></textarea>
						</td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<th scope="row"><?php esc_html_e( 'Featured Property', 'estatein' ); ?></th>
					<td>
						<label>
							<input
								type="checkbox"
							name="estatein_featured"
							value="1"
							<?php checked( get_post_meta( $post->ID, '_estatein_featured', true ), '1' ); ?>
						/>
							<?php esc_html_e( 'Show this property in featured sections.', 'estatein' ); ?>
						</label>
					</td>
				</tr>
		</tbody>
	</table>
	<?php
}

/**
 * Saves property details.
 *
 * @param int $post_id Current post ID.
 */
function estatein_save_property_meta( $post_id ) {
	if ( ! isset( $_POST['estatein_property_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['estatein_property_meta_nonce'] ) ), 'estatein_save_property_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array( 'price', 'address', 'beds', 'baths', 'area', 'label', 'property_type', 'property_status', 'year_built' );
	$textarea_fields = array( 'gallery_images', 'amenities', 'inquiry_intro', 'pricing_details', 'pricing_note', 'additional_fees', 'monthly_costs', 'total_initial_costs', 'monthly_expenses' );

	foreach ( $text_fields as $field ) {
		if ( isset( $_POST[ 'estatein_' . $field ] ) ) {
			update_post_meta( $post_id, '_estatein_' . $field, sanitize_text_field( wp_unslash( $_POST[ 'estatein_' . $field ] ) ) );
		}
	}

	foreach ( $textarea_fields as $field ) {
		if ( isset( $_POST[ 'estatein_' . $field ] ) ) {
			update_post_meta( $post_id, '_estatein_' . $field, sanitize_textarea_field( wp_unslash( $_POST[ 'estatein_' . $field ] ) ) );
		}
	}

	$featured = isset( $_POST['estatein_featured'] ) ? '1' : '0';
	update_post_meta( $post_id, '_estatein_featured', $featured );
}
add_action( 'save_post_property', 'estatein_save_property_meta' );
