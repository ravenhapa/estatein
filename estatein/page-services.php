<?php
/**
 * Services page template for the "services" slug.
 *
 * @package Estatein
 */

get_header();

$services_query = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => 4,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'Our Services', 'estatein' ); ?></span>
		<h1><?php esc_html_e( 'The Widest Range of Services in the Real Estate Market', 'estatein' ); ?></h1>
		<p><?php esc_html_e( 'Explore services designed for buyers, sellers, property owners, and investors who want expert guidance and smoother outcomes.', 'estatein' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Assistance', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Assistance in Selecting Real Estate', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Estatein helps clients find the right property, unlock value, manage ownership, and make smarter investment decisions.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="quick-links">
			<?php if ( $services_query->have_posts() ) : ?>
				<?php while ( $services_query->have_posts() ) : ?>
					<?php $services_query->the_post(); ?>
					<?php
					$service_icon = estatein_meta( get_the_ID(), 'icon', strtoupper( substr( get_the_title(), 0, 1 ) ) );
					$service_url  = estatein_meta( get_the_ID(), 'cta_url', get_permalink() );
					?>
					<a class="mini-link" href="<?php echo esc_url( $service_url ); ?>">
						<span class="mini-link__top"><span class="mini-link__icon" aria-hidden="true"><?php echo esc_html( $service_icon ); ?></span><span class="mini-link__arrow" aria-hidden="true">&gt;</span></span>
						<strong><?php the_title(); ?></strong>
					</a>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_services() as $service ) : ?>
					<a class="mini-link" href="<?php echo esc_url( $service['url'] ); ?>">
						<span class="mini-link__top"><span class="mini-link__icon" aria-hidden="true"><?php echo esc_html( $service['icon'] ); ?></span><span class="mini-link__arrow" aria-hidden="true">&gt;</span></span>
						<strong><?php echo esc_html( $service['title'] ); ?></strong>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section section--border" id="selling">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Selling', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Unlock Property Value', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Selling should feel rewarding, not confusing. Estatein helps maximize value with careful pricing, presentation, negotiation, and closing support.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
		</div>
		<div class="service-grid">
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">V</span>
				<h3><?php esc_html_e( 'Valuation Mastery', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Discover the true worth of your property with expert valuation services.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">M</span>
				<h3><?php esc_html_e( 'Strategic Marketing', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Bring your listing to market with strong positioning and targeted exposure.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">N</span>
				<h3><?php esc_html_e( 'Negotiation Wizardry', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Negotiate with a clear strategy built around your strongest outcome.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">C</span>
				<h3><?php esc_html_e( 'Closing Success', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Move through closing details with organized support and fewer surprises.', 'estatein' ); ?></p>
			</article>
		</div>
	</div>
</section>

<section class="section section--border" id="management">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Management', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Effortless Property Management', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Estatein takes the stress out of property ownership with tenant coordination, maintenance planning, financial oversight, and legal awareness.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="service-grid">
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">T</span>
				<h3><?php esc_html_e( 'Tenant Harmony', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Support tenant relationships while reducing vacancies and operational friction.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">R</span>
				<h3><?php esc_html_e( 'Maintenance Ease', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Coordinate upkeep and property maintenance before small issues become costly.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">F</span>
				<h3><?php esc_html_e( 'Financial Peace of Mind', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Organize rent collection, statements, and ownership reporting.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">L</span>
				<h3><?php esc_html_e( 'Legal Guardian', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Stay aligned with property requirements and reduce avoidable compliance risks.', 'estatein' ); ?></p>
			</article>
		</div>
	</div>
</section>

<section class="section section--border" id="investments">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Investments', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Smart Investments, Informed Decisions', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Build your real estate portfolio with market insight, return assessment, customized strategy, and diversification planning.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start Planning', 'estatein' ); ?></a>
		</div>
		<div class="service-grid">
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">M</span>
				<h3><?php esc_html_e( 'Market Insight', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Stay ahead of shifts with practical market analysis and neighborhood context.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">R</span>
				<h3><?php esc_html_e( 'ROI Assessment', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Evaluate potential returns and risks before committing capital.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">S</span>
				<h3><?php esc_html_e( 'Customized Strategies', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Shape investment plans around your goals, timing, and appetite for risk.', 'estatein' ); ?></p>
			</article>
			<article class="service-card">
				<span class="service-card__icon" aria-hidden="true">D</span>
				<h3><?php esc_html_e( 'Diversification Mastery', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Spread investments across property types and locations with more intention.', 'estatein' ); ?></p>
			</article>
		</div>
	</div>
</section>

<?php
get_footer();
