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
			<div>
				<h2><?php esc_html_e( 'Start Your Real Estate Journey Today', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Your dream property is just a click away. Explore available homes or get tailored guidance from the Estatein team.', 'estatein' ); ?></p>
			</div>
			<a class="button button--accent" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Explore Properties', 'estatein' ); ?></a>
		</section>

		<div class="footer-main container">
			<div class="footer-newsletter">
				<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="site-brand__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php esc_attr_e( 'Estatein', 'estatein' ); ?>" width="151" height="47" loading="lazy" decoding="async">
				</a>
				<p><?php esc_html_e( 'Our team will contact you ASAP with market insight, property matches, and practical next steps.', 'estatein' ); ?></p>
				<form class="newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="estatein_lead">
					<input type="hidden" name="lead_interest" value="<?php esc_attr_e( 'Newsletter signup', 'estatein' ); ?>">
					<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
					<label class="screen-reader-text" for="footer-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
					<input id="footer-email" type="email" name="lead_email" placeholder="<?php esc_attr_e( 'Enter your email', 'estatein' ); ?>" required>
					<button class="button button--accent" type="submit"><?php esc_html_e( 'Send', 'estatein' ); ?></button>
				</form>
			</div>

			<div class="footer-navs">
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Home', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Hero Section', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'estatein' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'About Us', 'estatein' ); ?></h3>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Our Story', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#values' ) ); ?>"><?php esc_html_e( 'Our Values', 'estatein' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/#team' ) ); ?>"><?php esc_html_e( 'Our Team', 'estatein' ); ?></a></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Services', 'estatein' ); ?></h3>
					<ul>
						<li><span><?php esc_html_e( 'Valuation Mastery', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Strategic Marketing', 'estatein' ); ?></span></li>
						<li><span><?php esc_html_e( 'Property Management', 'estatein' ); ?></span></li>
					</ul>
				</div>
				<div class="footer-nav">
					<h3><?php esc_html_e( 'Contact', 'estatein' ); ?></h3>
					<ul>
						<li><a href="mailto:hello@estatein.example">hello@estatein.example</a></li>
						<li><a href="tel:+1234567890">+1 234 567 890</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Form', 'estatein' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container footer-bottom__inner">
				<span><?php printf( esc_html__( '@%1$s Estatein. All Rights Reserved.', 'estatein' ), esc_html( gmdate( 'Y' ) ) ); ?></span>
				<div class="social-links" aria-label="<?php esc_attr_e( 'Social links', 'estatein' ); ?>">
					<a href="https://www.facebook.com" aria-label="<?php esc_attr_e( 'Facebook', 'estatein' ); ?>">f</a>
					<a href="https://www.linkedin.com" aria-label="<?php esc_attr_e( 'LinkedIn', 'estatein' ); ?>">in</a>
					<a href="https://x.com" aria-label="<?php esc_attr_e( 'X', 'estatein' ); ?>">x</a>
					<a href="https://www.youtube.com" aria-label="<?php esc_attr_e( 'YouTube', 'estatein' ); ?>">yt</a>
				</div>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
