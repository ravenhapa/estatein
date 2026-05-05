<?php
/**
 * Team card template.
 *
 * @package Estatein
 */

$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$item    = isset( $args['team_member'] ) && is_array( $args['team_member'] ) ? $args['team_member'] : array();

if ( $post_id ) {
	$name       = get_the_title( $post_id );
	$role       = estatein_meta( $post_id, 'role', __( 'Estatein Advisor', 'estatein' ) );
	$initials   = estatein_meta( $post_id, 'initials', strtoupper( substr( $name, 0, 2 ) ) );
	$email      = estatein_meta( $post_id, 'email' );
	$linkedin   = estatein_meta( $post_id, 'linkedin' );
	$image      = get_the_post_thumbnail_url( $post_id, 'estatein-card' );
} else {
	$name       = isset( $item['name'] ) ? $item['name'] : '';
	$role       = isset( $item['role'] ) ? $item['role'] : '';
	$initials   = isset( $item['initials'] ) ? $item['initials'] : 'EA';
	$email      = isset( $item['email'] ) ? $item['email'] : '';
	$linkedin   = isset( $item['linkedin'] ) ? $item['linkedin'] : '';
	$image      = isset( $item['image'] ) ? $item['image'] : '';
}
?>

<article class="team-card">
	<div class="team-card__media">
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy" decoding="async">
		<?php else : ?>
			<div class="team-card__placeholder" aria-hidden="true"><?php echo esc_html( $initials ); ?></div>
		<?php endif; ?>
	</div>
	<div class="team-card__body">
		<h3><?php echo esc_html( $name ); ?></h3>
		<p><?php echo esc_html( $role ); ?></p>
	</div>
		<div class="team-card__footer">
			<a class="team-card__hello" href="<?php echo esc_url( $email ? 'mailto:' . $email : home_url( '/contact/' ) ); ?>">
				<?php esc_html_e( 'Say Hello', 'estatein' ); ?> <span aria-hidden="true">&nbsp; &#128075;</span>
			</a>
			<a class="team-card__icon" href="<?php echo esc_url( $linkedin ? $linkedin : home_url( '/contact/' ) ); ?>" aria-label="<?php esc_attr_e( 'Open team profile', 'estatein' ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/send_icon.svg' ); ?>" alt="" width="18" height="18" loading="lazy" decoding="async" aria-hidden="true">
			</a>
		</div>
	</article>
