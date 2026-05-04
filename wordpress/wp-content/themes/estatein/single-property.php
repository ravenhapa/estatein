<?php
/**
 * Single property template.
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();

	$price   = estatein_property_meta( get_the_ID(), 'price', __( 'Price on request', 'estatein' ) );
	$address = estatein_property_meta( get_the_ID(), 'address', __( 'Prime location', 'estatein' ) );
	$beds    = estatein_property_meta( get_the_ID(), 'beds', '-' );
	$baths   = estatein_property_meta( get_the_ID(), 'baths', '-' );
	$area    = estatein_property_meta( get_the_ID(), 'area', '-' );
	$image   = get_the_post_thumbnail_url( get_the_ID(), 'estatein-hero' );

	if ( ! $image ) {
		$image = estatein_image_url( 'property1' );
	}
	?>

	<section class="page-hero">
		<div class="container">
			<span class="section-kicker"><?php echo esc_html( $address ); ?></span>
			<h1><?php the_title(); ?></h1>
			<p><?php echo esc_html( $price ); ?></p>
		</div>
	</section>

	<section class="content-area">
		<div class="container single-property">
			<article>
				<div class="single-property__gallery">
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" fetchpriority="high" decoding="async">
				</div>
				<div class="single-property__meta" aria-label="<?php esc_attr_e( 'Property details', 'estatein' ); ?>">
					<span><?php printf( esc_html__( '%s Beds', 'estatein' ), esc_html( $beds ) ); ?></span>
					<span><?php printf( esc_html__( '%s Baths', 'estatein' ), esc_html( $baths ) ); ?></span>
					<span><?php echo esc_html( $area ); ?></span>
					<span><?php echo esc_html( $price ); ?></span>
				</div>
				<div class="single-property__content entry-content">
					<?php the_content(); ?>
				</div>
			</article>

			<aside class="lead-panel">
				<?php if ( isset( $_GET['estatein_status'] ) && 'sent' === sanitize_key( wp_unslash( $_GET['estatein_status'] ) ) ) : ?>
					<div class="notice"><?php esc_html_e( 'Thank you. The Estatein team will contact you ASAP.', 'estatein' ); ?></div>
				<?php endif; ?>
				<h2><?php esc_html_e( 'Ask About This Property', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Share your details and our team will help you schedule a viewing or compare similar listings.', 'estatein' ); ?></p>
				<form class="form-grid" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="estatein_lead">
					<input type="hidden" name="lead_interest" value="<?php echo esc_attr( get_the_title() ); ?>">
					<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
					<div class="form-row">
						<label for="lead-name"><?php esc_html_e( 'Name', 'estatein' ); ?></label>
						<input id="lead-name" type="text" name="lead_name" required>
					</div>
					<div class="form-row">
						<label for="lead-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
						<input id="lead-email" type="email" name="lead_email" required>
					</div>
					<div class="form-row">
						<label for="lead-phone"><?php esc_html_e( 'Phone', 'estatein' ); ?></label>
						<input id="lead-phone" type="tel" name="lead_phone">
					</div>
					<div class="form-row">
						<label for="lead-message"><?php esc_html_e( 'Message', 'estatein' ); ?></label>
						<textarea id="lead-message" name="lead_message"><?php esc_html_e( 'I would like to know more about this property.', 'estatein' ); ?></textarea>
					</div>
					<button class="button button--accent" type="submit"><?php esc_html_e( 'Send Inquiry', 'estatein' ); ?></button>
				</form>
			</aside>
		</div>
	</section>
	<?php
endwhile;

get_footer();
