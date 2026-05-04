<?php
/**
 * Testimonial card template.
 *
 * @package Estatein
 */

$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$item    = isset( $args['testimonial'] ) && is_array( $args['testimonial'] ) ? $args['testimonial'] : array();

if ( $post_id ) {
	$title    = get_the_title( $post_id );
	$quote    = get_the_excerpt( $post_id );
	$name     = estatein_meta( $post_id, 'name', $title );
	$location = estatein_meta( $post_id, 'location', __( 'Estatein Client', 'estatein' ) );
	$initials = estatein_meta( $post_id, 'initials', strtoupper( substr( $name, 0, 2 ) ) );
	$rating   = estatein_meta( $post_id, 'rating', '5/5' );
} else {
	$title    = isset( $item['title'] ) ? $item['title'] : '';
	$quote    = isset( $item['quote'] ) ? $item['quote'] : '';
	$name     = isset( $item['name'] ) ? $item['name'] : '';
	$location = isset( $item['location'] ) ? $item['location'] : '';
	$initials = isset( $item['initials'] ) ? $item['initials'] : 'EC';
	$rating   = isset( $item['rating'] ) ? $item['rating'] : '5/5';
}
?>

<article class="testimonial-card">
	<div>
		<div class="rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %s', 'estatein' ), $rating ) ); ?>"><?php echo esc_html( $rating ); ?></div>
		<h3><?php echo esc_html( $title ); ?></h3>
		<p><?php echo esc_html( wp_trim_words( $quote, 28 ) ); ?></p>
	</div>
	<div class="testimonial-person">
		<span class="testimonial-person__avatar" aria-hidden="true"><?php echo esc_html( $initials ); ?></span>
		<div>
			<strong><?php echo esc_html( $name ); ?></strong>
			<span><?php echo esc_html( $location ); ?></span>
		</div>
	</div>
</article>
