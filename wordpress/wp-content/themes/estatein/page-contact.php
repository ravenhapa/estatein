<?php
/**
 * Contact page template for the "contact" slug.
 *
 * @package Estatein
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'Contact Estatein', 'estatein' ); ?></span>
		<h1><?php esc_html_e( 'Get in Touch With Our Real Estate Experts', 'estatein' ); ?></h1>
		<p><?php esc_html_e( 'Tell us what you are looking for and the Estatein team will help you take the next clear step.', 'estatein' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container contact-grid">
		<article class="contact-method">
			<span class="contact-method__icon" aria-hidden="true">@</span>
			<h3><?php esc_html_e( 'Email', 'estatein' ); ?></h3>
			<p><a href="mailto:hello@estatein.example">hello@estatein.example</a></p>
		</article>
		<article class="contact-method">
			<span class="contact-method__icon" aria-hidden="true">P</span>
			<h3><?php esc_html_e( 'Phone', 'estatein' ); ?></h3>
			<p><a href="tel:+1234567890">+1 234 567 890</a></p>
		</article>
		<article class="contact-method">
			<span class="contact-method__icon" aria-hidden="true">L</span>
			<h3><?php esc_html_e( 'Location', 'estatein' ); ?></h3>
			<p><?php esc_html_e( '123 Estatein Avenue, New York, NY', 'estatein' ); ?></p>
		</article>
	</div>
</section>

<section class="section section--border">
	<div class="container single-property">
		<div>
			<div class="section-heading">
				<div>
					<span class="section-kicker"><?php esc_html_e( 'Message Us', 'estatein' ); ?></span>
					<h2><?php esc_html_e( 'We Will Contact You ASAP', 'estatein' ); ?></h2>
					<p><?php esc_html_e( 'Share your property goals, timeline, and preferred contact method. We will route your inquiry to the right Estatein advisor.', 'estatein' ); ?></p>
				</div>
			</div>
			<div class="feature-band__image">
				<img src="<?php echo esc_url( estatein_image_url( 'hero' ) ); ?>" alt="<?php esc_attr_e( 'Luxury real estate living room', 'estatein' ); ?>" loading="lazy" decoding="async">
			</div>
		</div>

		<aside class="lead-panel">
			<?php if ( isset( $_GET['estatein_status'] ) && 'sent' === sanitize_key( wp_unslash( $_GET['estatein_status'] ) ) ) : ?>
				<div class="notice"><?php esc_html_e( 'Thank you. The Estatein team will contact you ASAP.', 'estatein' ); ?></div>
			<?php elseif ( isset( $_GET['estatein_status'] ) && 'invalid' === sanitize_key( wp_unslash( $_GET['estatein_status'] ) ) ) : ?>
				<div class="notice"><?php esc_html_e( 'Please enter a valid email address.', 'estatein' ); ?></div>
			<?php endif; ?>
			<h2><?php esc_html_e( 'Send an Inquiry', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Use this form for buying, selling, management, or investment guidance.', 'estatein' ); ?></p>
			<form class="form-grid" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="estatein_lead">
				<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
				<div class="form-row">
					<label for="contact-name"><?php esc_html_e( 'Name', 'estatein' ); ?></label>
					<input id="contact-name" type="text" name="lead_name" required>
				</div>
				<div class="form-row">
					<label for="contact-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
					<input id="contact-email" type="email" name="lead_email" required>
				</div>
				<div class="form-row">
					<label for="contact-phone"><?php esc_html_e( 'Phone', 'estatein' ); ?></label>
					<input id="contact-phone" type="tel" name="lead_phone">
				</div>
				<div class="form-row">
					<label for="contact-interest"><?php esc_html_e( 'Interest', 'estatein' ); ?></label>
					<select id="contact-interest" name="lead_interest">
						<option><?php esc_html_e( 'Buying a property', 'estatein' ); ?></option>
						<option><?php esc_html_e( 'Selling a property', 'estatein' ); ?></option>
						<option><?php esc_html_e( 'Property management', 'estatein' ); ?></option>
						<option><?php esc_html_e( 'Investment advisory', 'estatein' ); ?></option>
					</select>
				</div>
				<div class="form-row">
					<label for="contact-message"><?php esc_html_e( 'Message', 'estatein' ); ?></label>
					<textarea id="contact-message" name="lead_message" required></textarea>
				</div>
				<button class="button button--accent" type="submit"><?php esc_html_e( 'Send Message', 'estatein' ); ?></button>
			</form>
		</aside>
	</div>
</section>

<?php
get_footer();
