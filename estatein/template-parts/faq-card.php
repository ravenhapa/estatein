<?php
/**
 * FAQ card template.
 *
 * @package Estatein
 */

$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$item    = isset( $args['faq'] ) && is_array( $args['faq'] ) ? $args['faq'] : array();

if ( $post_id ) {
	$title = get_the_title( $post_id );
	$body  = wp_strip_all_tags( get_the_content( null, false, $post_id ) );
} else {
	$title = isset( $item['title'] ) ? $item['title'] : '';
	$body  = isset( $item['body'] ) ? $item['body'] : '';
}
?>

<article class="faq-item">
	<h3><?php echo esc_html( $title ); ?></h3>
	<p><?php echo esc_html( wp_trim_words( $body, 34 ) ); ?></p>
</article>
