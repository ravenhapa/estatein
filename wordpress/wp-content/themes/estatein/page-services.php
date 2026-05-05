<?php
/**
 * Services page template for the "services" slug.
 *
 * @package Estatein
 */

get_header();

$services_query = new WP_Query(
	array(
		'post_type'      => 'service',
		'posts_per_page' => 4,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	)
);

$service_links = array();

if ( $services_query->have_posts() ) {
	while ( $services_query->have_posts() ) {
		$services_query->the_post();

		$service_links[] = array(
			'icon'  => estatein_meta( get_the_ID(), 'icon', strtoupper( substr( get_the_title(), 0, 1 ) ) ),
			'title' => get_the_title(),
			'url'   => estatein_meta( get_the_ID(), 'cta_url', get_permalink() ),
		);
	}

	wp_reset_postdata();
} else {
	$service_links = estatein_demo_services();
}

$selling_services = array(
	array(
		'icon'    => 'V',
		'title'   => __( 'Valuation Mastery', 'estatein' ),
		'excerpt' => __( 'Discover the true worth of your property with our expert valuation services.', 'estatein' ),
	),
	array(
		'icon'    => 'S',
		'title'   => __( 'Strategic Marketing', 'estatein' ),
		'excerpt' => __( 'Selling a property requires more than just a listing; it demands a strategic marketing approach.', 'estatein' ),
	),
	array(
		'icon'    => 'N',
		'title'   => __( 'Negotiation Wizardry', 'estatein' ),
		'excerpt' => __( 'Negotiate the best deal with confidence as our negotiation experts champion your outcome.', 'estatein' ),
	),
	array(
		'icon'    => 'C',
		'title'   => __( 'Closing Success', 'estatein' ),
		'excerpt' => __( 'A successful sale is not complete until the closing. We guide you through the process with clarity.', 'estatein' ),
	),
);

$management_services = array(
	array(
		'icon'    => 'T',
		'title'   => __( 'Tenant Harmony', 'estatein' ),
		'excerpt' => __( 'Our tenant management services ensure smooth relationships and reduced vacancies.', 'estatein' ),
	),
	array(
		'icon'    => 'M',
		'title'   => __( 'Maintenance Ease', 'estatein' ),
		'excerpt' => __( 'Say goodbye to property maintenance headaches. We handle upkeep with reliable coordination.', 'estatein' ),
	),
	array(
		'icon'    => 'F',
		'title'   => __( 'Financial Peace of Mind', 'estatein' ),
		'excerpt' => __( 'Managing property finances can be complex. Our financial experts handle rent and reporting carefully.', 'estatein' ),
	),
	array(
		'icon'    => 'L',
		'title'   => __( 'Legal Guardian', 'estatein' ),
		'excerpt' => __( 'Stay compliant with property laws and regulations effortlessly through guided oversight.', 'estatein' ),
	),
	);

$investment_services = array(
	array(
		'icon'    => 'M',
		'title'   => __( 'Market Insight', 'estatein' ),
		'excerpt' => __( 'Stay ahead of market trends with our expert analysis. We provide in-depth insights into the real estate market.', 'estatein' ),
	),
	array(
		'icon'    => 'R',
		'title'   => __( 'ROI Assessment', 'estatein' ),
		'excerpt' => __( 'Make investment decisions with confidence. Our ROI assessments reveal potential returns and practical tradeoffs.', 'estatein' ),
	),
	array(
		'icon'    => 'C',
		'title'   => __( 'Customized Strategies', 'estatein' ),
		'excerpt' => __( 'Every investor is unique, and so are their goals. We create tailored strategies to fit your specific needs.', 'estatein' ),
	),
	array(
		'icon'    => 'D',
		'title'   => __( 'Diversification Mastery', 'estatein' ),
		'excerpt' => __( 'Diversify your portfolio effectively with guidance across property types, cycles, and locations.', 'estatein' ),
	),
);
?>

<section class="section">
	<div class="container services-page">
		<div class="services-page__hero">
			<h1><?php esc_html_e( 'Elevate Your Real Estate Experience', 'estatein' ); ?></h1>
			<p><?php esc_html_e( 'Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'estatein' ); ?></p>
		</div>

		<div class="services-page__quick-links">
			<?php foreach ( $service_links as $service_link ) : ?>
				<a class="services-quick-card" href="<?php echo esc_url( $service_link['url'] ); ?>">
					<span class="services-quick-card__arrow" aria-hidden="true">&#8599;</span>
					<span class="services-quick-card__icon" aria-hidden="true"><?php echo esc_html( $service_link['icon'] ); ?></span>
					<strong><?php echo esc_html( $service_link['title'] ); ?></strong>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section" id="selling">
	<div class="container">
		<div class="section-heading section-heading--stacked">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Selling Services', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Unlock Property Value', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Selling your property should be a rewarding experience, and at Estatein we make sure it is. Our Property Selling Service is designed to maximize the value of your property, ensuring you get the best deal possible.', 'estatein' ); ?></p>
			</div>
		</div>

		<div class="services-cluster">
			<?php foreach ( $selling_services as $index => $item ) : ?>
				<article class="services-detail-card<?php echo ( 3 === $index ) ? ' services-detail-card--short' : ''; ?>">
					<div class="services-detail-card__heading">
						<span class="services-detail-card__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
					</div>
					<p><?php echo esc_html( $item['excerpt'] ); ?></p>
				</article>
			<?php endforeach; ?>

			<article class="services-cta-card services-cta-card--wide">
				<div>
					<h3><?php esc_html_e( 'Unlock the Value of Your Property Today', 'estatein' ); ?></h3>
					<p><?php esc_html_e( 'Ready to unlock the true value of your property? Explore our Property Selling Service categories and let us help you achieve the best deal possible for your valuable asset.', 'estatein' ); ?></p>
				</div>
				<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
			</article>
		</div>
	</div>
</section>

<section class="section" id="management">
	<div class="container">
		<div class="section-heading section-heading--stacked">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Management Services', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Effortless Property Management', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Owning a property should be a pleasure, not a hassle. Estatein\'s Property Management Service takes the stress out of property ownership, offering comprehensive solutions tailored to your needs.', 'estatein' ); ?></p>
			</div>
		</div>

		<div class="services-cluster">
			<?php foreach ( $management_services as $index => $item ) : ?>
				<article class="services-detail-card<?php echo ( 3 === $index ) ? ' services-detail-card--short' : ''; ?>">
					<div class="services-detail-card__heading">
						<span class="services-detail-card__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
					</div>
					<p><?php echo esc_html( $item['excerpt'] ); ?></p>
				</article>
			<?php endforeach; ?>

			<article class="services-cta-card services-cta-card--wide">
				<div>
					<h3><?php esc_html_e( 'Experience Effortless Property Management', 'estatein' ); ?></h3>
					<p><?php esc_html_e( 'Ready to enjoy stress-free property management? Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.', 'estatein' ); ?></p>
				</div>
				<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
			</article>
		</div>
	</div>
</section>

<section class="section" id="investments">
	<div class="container">
		<div class="services-investments">
			<div class="services-investments__intro">
				<div class="section-heading section-heading--stacked">
					<div>
						<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Investment Services', 'estatein' ); ?></span></span>
						<h2><?php esc_html_e( 'Smart Investments, Informed Decisions', 'estatein' ); ?></h2>
						<p><?php esc_html_e( 'Building a real estate portfolio requires a strategic approach. Estatein\'s Investment Advisory Service empowers you to make smart investments and informed decisions.', 'estatein' ); ?></p>
					</div>
				</div>

				<article class="services-cta-card services-cta-card--stacked">
					<div>
						<h3><?php esc_html_e( 'Unlock Your Investment Potential', 'estatein' ); ?></h3>
						<p><?php esc_html_e( 'Explore our Property Management Service categories and let us help you navigate the complexities while enjoying the rewards of smarter ownership.', 'estatein' ); ?></p>
					</div>
					<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
				</article>
			</div>

			<div class="services-investments__grid">
				<?php foreach ( $investment_services as $item ) : ?>
					<article class="services-detail-card">
						<div class="services-detail-card__heading">
							<span class="services-detail-card__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
						</div>
						<p><?php echo esc_html( $item['excerpt'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
