<?php
/**
 * About page template for the "about" slug.
 *
 * @package Estatein
 */

get_header();

$team_query = new WP_Query( array(
	'post_type'      => 'team_member',
	'posts_per_page' => 4,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'About Estatein', 'estatein' ); ?></span>
		<h1><?php esc_html_e( 'Our Journey Is Rooted in Real Estate Trust', 'estatein' ); ?></h1>
		<p><?php esc_html_e( 'Estatein brings property search, selling strategy, and investment guidance into one clear experience for modern clients.', 'estatein' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container feature-band">
		<div class="feature-band__copy">
			<span class="section-kicker"><?php esc_html_e( 'Our Story', 'estatein' ); ?></span>
			<h2><?php esc_html_e( 'Helping People Move With Confidence', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'We combine local expertise, digital-first presentation, and careful client guidance so every buying, selling, or investment decision feels easier to navigate.', 'estatein' ); ?></p>
		</div>
		<div class="feature-band__image">
			<img src="<?php echo esc_url( estatein_image_url( 'feature' ) ); ?>" alt="<?php esc_attr_e( 'Modern home with outdoor living space', 'estatein' ); ?>" loading="lazy" decoding="async">
		</div>
	</div>
</section>

<section class="section section--border" id="values">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Values', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'The Principles That Shape Every Client Experience', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Estatein is built around clear advice, careful execution, and thoughtful service from first conversation to final signature.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="value-grid">
			<article class="value-card">
				<span class="value-card__number">01</span>
				<h3><?php esc_html_e( 'Trust', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'We keep guidance transparent, timely, and grounded in real market context.', 'estatein' ); ?></p>
			</article>
			<article class="value-card">
				<span class="value-card__number">02</span>
				<h3><?php esc_html_e( 'Excellence', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Every listing, valuation, and negotiation receives disciplined attention to detail.', 'estatein' ); ?></p>
			</article>
			<article class="value-card">
				<span class="value-card__number">03</span>
				<h3><?php esc_html_e( 'Client-Centric', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'Your goals define the strategy, pace, and property recommendations.', 'estatein' ); ?></p>
			</article>
			<article class="value-card">
				<span class="value-card__number">04</span>
				<h3><?php esc_html_e( 'Innovation', 'estatein' ); ?></h3>
				<p><?php esc_html_e( 'We use modern tools and presentation standards to make property decisions clearer.', 'estatein' ); ?></p>
			</article>
		</div>
	</div>
</section>

<section class="section section--border" id="team">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker"><?php esc_html_e( 'Team', 'estatein' ); ?></span>
				<h2><?php esc_html_e( 'A Focused Team for Buyers, Sellers, and Investors', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'From property discovery to closing, Estatein pairs each client with people who understand their priorities.', 'estatein' ); ?></p>
			</div>
			<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'estatein' ); ?></a>
		</div>
		<div class="service-grid">
			<?php if ( $team_query->have_posts() ) : ?>
				<?php while ( $team_query->have_posts() ) : ?>
					<?php $team_query->the_post(); ?>
					<?php get_template_part( 'template-parts/team-card', null, array( 'post_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( estatein_demo_team_members() as $team_member ) : ?>
					<?php get_template_part( 'template-parts/team-card', null, array( 'team_member' => $team_member ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
