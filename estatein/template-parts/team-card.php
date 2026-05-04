<?php
/**
 * Team card template.
 *
 * @package Estatein
 */

$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$item    = isset( $args['team_member'] ) && is_array( $args['team_member'] ) ? $args['team_member'] : array();

if ( $post_id ) {
	$name     = get_the_title( $post_id );
	$excerpt  = get_the_excerpt( $post_id );
	$role     = estatein_meta( $post_id, 'role', __( 'Estatein Advisor', 'estatein' ) );
	$initials = estatein_meta( $post_id, 'initials', strtoupper( substr( $name, 0, 2 ) ) );
	$email    = estatein_meta( $post_id, 'email' );
	$linkedin = estatein_meta( $post_id, 'linkedin' );
} else {
	$name     = isset( $item['name'] ) ? $item['name'] : '';
	$excerpt  = isset( $item['excerpt'] ) ? $item['excerpt'] : '';
	$role     = isset( $item['role'] ) ? $item['role'] : '';
	$initials = isset( $item['initials'] ) ? $item['initials'] : 'EA';
	$email    = isset( $item['email'] ) ? $item['email'] : '';
	$linkedin = isset( $item['linkedin'] ) ? $item['linkedin'] : '';
}
?>

<article class="service-card team-card">
	<span class="testimonial-person__avatar" aria-hidden="true"><?php echo esc_html( $initials ); ?></span>
	<div>
		<h3><?php echo esc_html( $name ); ?></h3>
		<p><?php echo esc_html( $role ); ?></p>
	</div>
	<p><?php echo esc_html( wp_trim_words( $excerpt, 24 ) ); ?></p>
	<?php if ( $email || $linkedin ) : ?>
		<div class="team-card__links">
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php esc_html_e( 'Email', 'estatein' ); ?></a>
			<?php endif; ?>
			<?php if ( $linkedin ) : ?>
				<a href="<?php echo esc_url( $linkedin ); ?>"><?php esc_html_e( 'LinkedIn', 'estatein' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</article>
