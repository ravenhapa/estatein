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
	$avatar   = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
} else {
	$title    = isset( $item['title'] ) ? $item['title'] : '';
	$quote    = isset( $item['quote'] ) ? $item['quote'] : '';
	$name     = isset( $item['name'] ) ? $item['name'] : '';
	$location = isset( $item['location'] ) ? $item['location'] : '';
	$initials = isset( $item['initials'] ) ? $item['initials'] : 'EC';
	$rating   = isset( $item['rating'] ) ? $item['rating'] : '5/5';
	$avatar   = isset( $item['avatar'] ) ? $item['avatar'] : '';
}
?>

<article class="testimonial-card">
	<div class="testimonial-card__content">
		<div class="testimonial-stars" aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %s', 'estatein' ), $rating ) ); ?>">
			<?php for ( $i = 0; $i < 5; $i++ ) : ?>
				<span class="testimonial-stars__item" aria-hidden="true">&#9733;</span>
			<?php endfor; ?>
		</div>
		<h3><?php echo esc_html( $title ); ?></h3>
		<p><?php echo esc_html( wp_trim_words( $quote, 28 ) ); ?></p>
	</div>
	<div class="testimonial-person">
		<?php if ( $avatar ) : ?>
			<img class="testimonial-person__avatar-image" src="<?php echo esc_url( $avatar ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy" decoding="async">
		<?php else : ?>
			<span class="testimonial-person__avatar" aria-hidden="true"><?php echo esc_html( $initials ); ?></span>
		<?php endif; ?>
		<div>
			<strong><?php echo esc_html( $name ); ?></strong>
			<span><?php echo esc_html( $location ); ?></span>
		</div>
	</div>
</article>
