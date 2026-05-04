<?php
/**
 * Property card template.
 *
 * @package Estatein
 */

$post_id  = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$property = isset( $args['property'] ) && is_array( $args['property'] ) ? $args['property'] : array();

if ( $post_id ) {
	$title   = get_the_title( $post_id );
	$excerpt = get_the_excerpt( $post_id );
	$price   = estatein_property_meta( $post_id, 'price', __( 'Price on request', 'estatein' ) );
	$address = estatein_property_meta( $post_id, 'address', __( 'Prime location', 'estatein' ) );
	$beds    = estatein_property_meta( $post_id, 'beds', '-' );
	$baths   = estatein_property_meta( $post_id, 'baths', '-' );
	$area    = estatein_property_meta( $post_id, 'area', '-' );
	$label   = estatein_property_meta( $post_id, 'label', __( 'Property', 'estatein' ) );
	$url     = get_permalink( $post_id );
	$image   = get_the_post_thumbnail_url( $post_id, 'estatein-card' );

	if ( ! $image ) {
		$image = estatein_image_url( 'property1' );
	}
} else {
	$title   = isset( $property['title'] ) ? $property['title'] : '';
	$excerpt = isset( $property['excerpt'] ) ? $property['excerpt'] : '';
	$price   = isset( $property['price'] ) ? $property['price'] : '';
	$address = isset( $property['address'] ) ? $property['address'] : '';
	$beds    = isset( $property['beds'] ) ? $property['beds'] : '-';
	$baths   = isset( $property['baths'] ) ? $property['baths'] : '-';
	$area    = isset( $property['area'] ) ? $property['area'] : '-';
	$label   = isset( $property['label'] ) ? $property['label'] : __( 'Property', 'estatein' );
	$url     = isset( $property['url'] ) ? $property['url'] : home_url( '/properties/' );
	$image   = isset( $property['image'] ) ? $property['image'] : estatein_image_url( 'property1' );
}
?>

<article class="property-card">
	<a class="property-card__image" href="<?php echo esc_url( $url ); ?>">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" decoding="async">
	</a>
	<div class="property-card__body">
		<span class="property-card__eyebrow"><?php echo esc_html( $label ); ?></span>
		<div>
			<h3><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h3>
			<p><?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?></p>
		</div>
		<div class="property-card__facts" aria-label="<?php esc_attr_e( 'Property facts', 'estatein' ); ?>">
			<span class="property-fact"><?php printf( esc_html__( '%s Beds', 'estatein' ), esc_html( $beds ) ); ?></span>
			<span class="property-fact"><?php printf( esc_html__( '%s Baths', 'estatein' ), esc_html( $baths ) ); ?></span>
			<span class="property-fact"><?php echo esc_html( $area ); ?></span>
		</div>
		<div class="property-card__footer">
			<div class="property-price">
				<span><?php echo esc_html( $address ); ?></span>
				<strong><?php echo esc_html( $price ); ?></strong>
			</div>
			<a class="button button--small" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'View Details', 'estatein' ); ?></a>
		</div>
	</div>
</article>
