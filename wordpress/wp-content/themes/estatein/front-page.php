<?php
/**
 * Front page template.
 *
 * @package Estatein
 */

get_header();

$featured_query = new WP_Query( array(
	'post_type'      => 'property',
	'posts_per_page' => -1,
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
		'posts_per_page' => -1,
	) );
}

$featured_count = $featured_query->have_posts() ? (int) $featured_query->post_count : count( estatein_demo_properties() );

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

<section class="hero" id="hero">
	<div class="container hero__grid">
		<div class="hero__content">
			<div class="hero__intro">
				<h1><?php esc_html_e( 'Discover Your Dream Property with Estatein', 'estatein' ); ?></h1>
				<p><?php esc_html_e( 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'estatein' ); ?></p>
			</div>
			<div class="hero__actions">
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
				<a class="button button--accent" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Browse Properties', 'estatein' ); ?></a>
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

		<div class="hero-media" aria-hidden="true">
			<img class="hero-media__image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/front-page-image.png' ); ?>" alt="" fetchpriority="high" decoding="async">
		</div>
		<img alt="badge" loading="lazy" width="175" height="175" decoding="async" data-nimg="1" class="h-29 w-29 object-cover md:h-32 md:w-32 dt:h-[175px] dt:w-[175px]" srcset="https://estatein-seven.vercel.app/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fbadge.3e96fa19.png&w=256&q=75">
	</div>
</section>

<section class="features-strip" id="features">
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
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Featured Listings', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Featured Properties', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Explore handpicked properties that match a wide range of lifestyles, budgets, and investment goals.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'View All Properties', 'estatein' ); ?></a>
		</div>

			<div class="property-slider" data-property-slider>
				<div class="property-slider__viewport">
					<div class="property-slider__track" data-property-slider-track>
						<?php if ( $featured_query->have_posts() ) : ?>
							<?php while ( $featured_query->have_posts() ) : ?>
								<?php $featured_query->the_post(); ?>
								<div class="property-slider__slide">
									<?php get_template_part( 'template-parts/property-card', null, array( 'post_id' => get_the_ID() ) ); ?>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						<?php else : ?>
							<?php foreach ( estatein_demo_properties() as $property ) : ?>
								<div class="property-slider__slide">
									<?php get_template_part( 'template-parts/property-card', null, array( 'property' => $property ) ); ?>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="property-slider__footer">
					<span class="property-slider__count"><span data-property-slider-current>01</span> of <span data-property-slider-total><?php echo esc_html( str_pad( (string) $featured_count, 2, '0', STR_PAD_LEFT ) ); ?></span></span>
					<div class="property-slider__actions">
						<button class="property-slider__button" type="button" data-property-slider-prev aria-label="<?php esc_attr_e( 'Previous featured properties', 'estatein' ); ?>">
							<span aria-hidden="true">&#8592;</span>
						</button>
						<button class="property-slider__button property-slider__button--active" type="button" data-property-slider-next aria-label="<?php esc_attr_e( 'Next featured properties', 'estatein' ); ?>">
							<span aria-hidden="true">&#8594;</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Testimonials', 'estatein' ); ?></span></span>
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
		<div class="testimonial-footer" aria-hidden="true">
			<span class="testimonial-footer__count">01 of 10</span>
			<div class="testimonial-footer__actions">
				<button class="testimonial-footer__button" type="button">
					<span aria-hidden="true">&#8592;</span>
				</button>
				<button class="testimonial-footer__button testimonial-footer__button--active" type="button">
					<span aria-hidden="true">&#8594;</span>
				</button>
			</div>
		</div>
	</div>
</section>

<section class="section section--border">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'FAQs', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Find answers to common questions about Estatein\'s services, property listings, and the real estate process. We\'re here to provide clarity and assist you every step of the way.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'View All FAQ’s', 'estatein' ); ?></a>
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
