<?php
/**
 * Service card template.
 *
 * @package Estatein
 */

$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$item    = isset( $args['service'] ) && is_array( $args['service'] ) ? $args['service'] : array();

if ( $post_id ) {
	$title   = get_the_title( $post_id );
	$excerpt = get_the_excerpt( $post_id );
	$icon    = estatein_meta( $post_id, 'icon', strtoupper( substr( $title, 0, 1 ) ) );
	$url     = estatein_meta( $post_id, 'cta_url', get_permalink( $post_id ) );
	$label   = estatein_meta( $post_id, 'cta_label', __( 'Learn More', 'estatein' ) );
} else {
	$title   = isset( $item['title'] ) ? $item['title'] : '';
	$excerpt = isset( $item['excerpt'] ) ? $item['excerpt'] : '';
	$icon    = isset( $item['icon'] ) ? $item['icon'] : 'E';
	$url     = isset( $item['url'] ) ? $item['url'] : home_url( '/services/' );
	$label   = isset( $item['label'] ) ? $item['label'] : __( 'Learn More', 'estatein' );
}
?>

<article class="service-card">
	<span class="service-card__icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></span>
	<h3><?php echo esc_html( $title ); ?></h3>
	<p><?php echo esc_html( wp_trim_words( $excerpt, 24 ) ); ?></p>
	<a class="button button--small" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
</article>
