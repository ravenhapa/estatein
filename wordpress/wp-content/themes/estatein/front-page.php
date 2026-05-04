<?php
/**
 * Front page template.
 *
 * @package Estatein
 */

get_header();

$featured_query = new WP_Query( array(
	'post_type'      => 'property',
	'posts_per_page' => 3,
	'meta_query'     => array(
		'relation' => 'OR',
		array(
			'key'   => '_estatein_featured',
			'value' => '1',
		),
		array(
			'key'   => 'estatein_featured',
			'value' => '1',
		),
	),
) );

if ( ! $featured_query->have_posts() ) {
	wp_reset_postdata();
	$featured_query = new WP_Query( array(
		'post_type'      => 'property',
		'posts_per_page' => 3,
	) );
}

$services_query = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => 4,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );

$testimonials_query = new WP_Query( array(
	'post_type'      => 'testimonial',
	'posts_per_page' => 3,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );

$faqs_query = new WP_Query( array(
	'post_type'      => 'faq',
	'posts_per_page' => 3,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );
?>

<section class="hero">
	<div class="container hero__grid">
		<div class="hero__content">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Estatein Real Estate Agency', 'estatein' ); ?></span>
				<h1><?php esc_html_e( '✨Discover Your Dream Property with Estatein', 'estatein' ); ?></h1>
			</div>
			<p><?php esc_html_e( 'Your journey to finding the perfect property begins here. Explore listings, expert guidance, and services built around your next move.', 'estatein' ); ?></p>
			<div class="hero__actions">
				<a class="button button--accent" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Browse Properties', 'estatein' ); ?></a>
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
			</div>
			<div class="hero-stats" aria-label="<?php esc_attr_e( 'Estatein stats', 'estatein' ); ?>">
				<div class="hero-stat">
					<strong>200+</strong>
					<span><?php esc_html_e( 'Happy Customers', 'estatein' ); ?></span>
				</div>
				<div class="hero-stat">
					<strong>10k+</strong>
					<span><?php esc_html_e( 'Properties For Clients', 'estatein' ); ?></span>
				</div>
				<div class="hero-stat">
					<strong>16+</strong>
					<span><?php esc_html_e( 'Years of Experience', 'estatein' ); ?></span>
				</div>
			</div>
		</div>

		<div class="hero-media">
			<img src="<?php echo esc_url( estatein_image_url( 'hero' ) ); ?>" alt="<?php esc_attr_e( 'Modern luxury home interior', 'estatein' ); ?>" fetchpriority="high" decoding="async">
			<div class="hero-badge">
				<span class="hero-badge__icon" aria-hidden="true">01</span>
				<div>
					<strong><?php esc_html_e( 'Personalized property discovery', 'estatein' ); ?></strong>
					<span><?php esc_html_e( 'Curated homes, trusted advisors, and a smoother buying path.', 'estatein' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--tight">
	<div class="container quick-links">
		<?php if ( $services_query->have_posts() ) : ?>
			<?php while ( $services_query->have_posts() ) : ?>
				<?php $services_query->the_post(); ?>
				<?php
				$service_icon = estatein_meta( get_the_ID(), 'icon', strtoupper( substr( get_the_title(), 0, 1 ) ) );
				$service_url  = estatein_meta( get_the_ID(), 'cta_url', get_permalink() );
				?>
				<a class="mini-link" href="<?php echo esc_url( $service_url ); ?>">
					<span class="mini-link__top">
						<span class="mini-link__icon" aria-hidden="true"><?php echo esc_html( $service_icon ); ?></span>
						<span class="mini-link__arrow" aria-hidden="true">&gt;</span>
					</span>
					<strong><?php the_title(); ?></strong>
				</a>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php $services_query->rewind_posts(); ?>
		<?php else : ?>
			<?php foreach ( estatein_demo_services() as $service ) : ?>
				<a class="mini-link" href="<?php echo esc_url( $service['url'] ); ?>">
					<span class="mini-link__top">
						<span class="mini-link__icon" aria-hidden="true"><?php echo esc_html( $service['icon'] ); ?></span>
						<span class="mini-link__arrow" aria-hidden="true">&gt;</span>
					</span>
					<strong><?php echo esc_html( $service['title'] ); ?></strong>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Featured Listings', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Featured Properties', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Explore handpicked properties that match a wide range of lifestyles, budgets, and investment goals.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'View All Properties', 'estatein' ); ?></a>
		</div>

		<div class="property-grid">
			<?php if ( $featured_query->have_posts() ) : ?>
				<?php while ( $featured_query->have_posts() ) : ?>
					<?php $featured_query->the_post(); ?>
					<?php get_template_part( 'template-parts/property-card', null, array( 'post_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_properties() as $property ) : ?>
					<?php get_template_part( 'template-parts/property-card', null, array( 'property' => $property ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Services', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Elevate Your Real Estate Experience', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'From finding your next home to managing investments, Estatein gives each client precise guidance at every stage.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View Services', 'estatein' ); ?></a>
		</div>

		<div class="service-grid">
			<?php if ( $services_query->have_posts() ) : ?>
				<?php while ( $services_query->have_posts() ) : ?>
					<?php $services_query->the_post(); ?>
					<?php get_template_part( 'template-parts/service-card', null, array( 'post_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_services() as $service ) : ?>
					<?php get_template_part( 'template-parts/service-card', null, array( 'service' => $service ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container feature-band">
		<div class="feature-band__copy">
			<span class="section-kicker"><?php esc_html_e( 'Smart Investments', 'estatein' ); ?></span>
			<h2><?php esc_html_e( 'Informed Decisions for Long-Term Property Growth', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Build a resilient real estate portfolio with market insight, ROI assessment, customized strategy, and diversification support.', 'estatein' ); ?></p>
		</div>
		<div class="feature-band__image">
			<img src="<?php echo esc_url( estatein_image_url( 'feature' ) ); ?>" alt="<?php esc_attr_e( 'Contemporary home exterior with pool', 'estatein' ); ?>" loading="lazy" decoding="async">
		</div>
	</div>
</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Testimonials', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'What Our Clients Say', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Real stories from buyers, sellers, and investors who trusted Estatein with important decisions.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="testimonial-grid">
			<?php if ( $testimonials_query->have_posts() ) : ?>
				<?php while ( $testimonials_query->have_posts() ) : ?>
					<?php $testimonials_query->the_post(); ?>
					<?php get_template_part( 'template-parts/testimonial-card', null, array( 'post_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_testimonials() as $testimonial ) : ?>
					<?php get_template_part( 'template-parts/testimonial-card', null, array( 'testimonial' => $testimonial ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'FAQs', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Helpful answers for buyers, sellers, and investors getting started with Estatein.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Ask a Question', 'estatein' ); ?></a>
		</div>
		<div class="faq-grid">
			<?php if ( $faqs_query->have_posts() ) : ?>
				<?php while ( $faqs_query->have_posts() ) : ?>
					<?php $faqs_query->the_post(); ?>
					<?php get_template_part( 'template-parts/faq-card', null, array( 'post_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_faqs() as $faq ) : ?>
					<?php get_template_part( 'template-parts/faq-card', null, array( 'faq' => $faq ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
