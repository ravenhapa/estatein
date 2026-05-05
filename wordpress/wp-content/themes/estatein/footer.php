<?php
/**
 * Footer template.
 *
 * @package Estatein
 */
?>
	</main>

	<footer class="site-footer">
		<section class="footer-cta container">
			<div class="footer-cta__content">
				<h2><?php esc_html_e( 'Start Your Real Estate Journey Today', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Your dream property is just a click away. Whether you\'re looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.', 'estatein' ); ?></p>
			</div>
			<a class="button button--accent" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Explore Properties', 'estatein' ); ?></a>
		</section>

		<div class="footer-main container">
			<div class="footer-newsletter">
				<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="site-brand__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Estatein', 'estatein' ); ?>" width="151" height="47" loading="lazy" decoding="async">
				</a>
					<form class="newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
						<input type="hidden" name="action" value="estatein_lead">
						<input type="hidden" name="lead_interest" value="<?php esc_attr_e( 'Newsletter signup', 'estatein' ); ?>">
						<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
						<label class="screen-reader-text" for="footer-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
						<div class="newsletter-form__field">
							<img class="newsletter-form__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/email_icon.svg' ); ?>" alt="" width="20" height="20" loading="lazy" decoding="async" aria-hidden="true">
							<input id="footer-email" type="email" name="lead_email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'estatein' ); ?>" required>
						</div>
						<button class="newsletter-form__submit" type="submit" aria-label="<?php esc_attr_e( 'Send', 'estatein' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/send_icon.svg' ); ?>" alt="" width="24" height="24" loading="lazy" decoding="async" aria-hidden="true">
						</button>
					</form>
				</div>

			<div class="footer-navs">
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Home', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Hero Section', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#features' ) ); ?>"><?php esc_html_e( 'Features', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>"><?php esc_html_e( 'Testimonials', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/#faqs' ) ); ?>"><?php esc_html_e( 'FAQs', 'estatein' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'About Us', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Our Story', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#works' ) ); ?>"><?php esc_html_e( 'Our Works', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#how-it-works' ) ); ?>"><?php esc_html_e( 'How It Works', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#team' ) ); ?>"><?php esc_html_e( 'Our Team', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#clients' ) ); ?>"><?php esc_html_e( 'Our Clients', 'estatein' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Properties', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Categories', 'estatein' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Services', 'estatein' ); ?></h3>
					<ul>
						<li><span><?php esc_html_e( 'Valuation Mastery', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Strategic Marketing', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Negotiation Wizardry', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Closing Success', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Property Management', 'estatein' ); ?></span></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Contact Us', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Form', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Our Offices', 'estatein' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container footer-bottom__inner">
				<div class="footer-bottom__meta">
					<span><?php printf( esc_html__( '@%1$s Estatein. All Rights Reserved.', 'estatein' ), esc_html( gmdate( 'Y' ) ) ); ?></span>
					<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'estatein' ); ?></a>
				</div>
				<div class="social-links" aria-label="<?php esc_attr_e( 'Social links', 'estatein' ); ?>">
					<a href="https://www.facebook.com" aria-label="<?php esc_attr_e( 'Facebook', 'estatein' ); ?>">f</a>
					<a href="https://www.linkedin.com" aria-label="<?php esc_attr_e( 'LinkedIn', 'estatein' ); ?>">in</a>
					<a href="https://x.com" aria-label="<?php esc_attr_e( 'X', 'estatein' ); ?>">t</a>
					<a href="https://www.youtube.com" aria-label="<?php esc_attr_e( 'YouTube', 'estatein' ); ?>">o</a>
				</div>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
