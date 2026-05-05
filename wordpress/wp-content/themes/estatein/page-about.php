<?php
/**
 * About page template for the "about" slug.
 *
 * @package Estatein
 */

get_header();

$team_query = new WP_Query( array(
	'post_type'      => 'team_member',
	'posts_per_page' => -1,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'DESC',
	),
) );

$values = array(
	array(
		'title' => __( 'Trust', 'estatein' ),
		'body'  => __( 'We build relationships through clarity, honest guidance, and dependable follow-through.', 'estatein' ),
	),
	array(
		'title' => __( 'Excellence', 'estatein' ),
		'body'  => __( 'Every listing, recommendation, and negotiation is handled with care and precision.', 'estatein' ),
	),
	array(
		'title' => __( 'Client-Centric', 'estatein' ),
		'body'  => __( 'Your goals shape the search, communication style, and decisions we help you make.', 'estatein' ),
	),
	array(
		'title' => __( 'Our Commitment', 'estatein' ),
		'body'  => __( 'We stay invested in outcomes, not just transactions, so your next step feels grounded.', 'estatein' ),
	),
);

$achievements = array(
	array(
		'title' => __( '3+ Years of Excellence', 'estatein' ),
		'body'  => __( 'We have built a strong foundation with trusted guidance, carefully presented listings, and meaningful client wins.', 'estatein' ),
	),
	array(
		'title' => __( 'Happy Clients', 'estatein' ),
		'body'  => __( 'Our process stays personal, responsive, and focused on helping clients make well-informed decisions.', 'estatein' ),
	),
	array(
		'title' => __( 'Industry Recognition', 'estatein' ),
		'body'  => __( 'From modern marketing to smoother buyer journeys, our standards continue to earn confidence.', 'estatein' ),
	),
);

$steps = array(
	array(
		'step'  => 'Step 01',
		'title' => __( 'Discover a World of Possibilities', 'estatein' ),
		'body'  => __( 'Start by sharing the kind of property or outcome you are after. We align your needs, budget, and timing into a clearer search plan.', 'estatein' ),
	),
	array(
		'step'  => 'Step 02',
		'title' => __( 'Narrowing Down Your Choices', 'estatein' ),
		'body'  => __( 'We compare the strongest options, surface tradeoffs, and help you focus on what fits your goals best.', 'estatein' ),
	),
	array(
		'step'  => 'Step 03',
		'title' => __( 'Personalized Guidance', 'estatein' ),
		'body'  => __( 'Expect thoughtful recommendations, market context, and communication that stays easy to follow.', 'estatein' ),
	),
	array(
		'step'  => 'Step 04',
		'title' => __( 'See It for Yourself', 'estatein' ),
		'body'  => __( 'We coordinate viewings and walk-throughs so you can assess each opportunity with more confidence.', 'estatein' ),
	),
	array(
		'step'  => 'Step 05',
		'title' => __( 'Making Informed Decisions', 'estatein' ),
		'body'  => __( 'From pricing to positioning, we help interpret the details that influence a smart next move.', 'estatein' ),
	),
	array(
		'step'  => 'Step 06',
		'title' => __( 'Getting the Best Deal', 'estatein' ),
		'body'  => __( 'When it is time to move, we support negotiation and closing so the final stretch feels more manageable.', 'estatein' ),
	),
);

$clients = estatein_demo_clients();
?>

<section class="section section--border about-section about-journey" id="journey">
	<div class="container">
		<div class="about-journey__grid">
			<div class="about-journey__content">
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Our Journey', 'estatein' ); ?></span></span>
				<h1><?php esc_html_e( 'Our Journey', 'estatein' ); ?></h1>
				<p><?php esc_html_e( 'Our story is one of growth, partnership, and practical real estate guidance. Estatein was built to help modern buyers, sellers, and investors move with more confidence through every step of the property journey.', 'estatein' ); ?></p>
				<div class="about-journey__stats">
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
				<div class="about-journey__media">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/our-journey.png' ); ?>" alt="<?php esc_attr_e( 'Our Journey', 'estatein' ); ?>" loading="lazy" decoding="async">
				</div>
			</div>
		</div>
	</section>

<section class="section section--border about-section" id="values">
	<div class="container about-split">
		<div class="about-split__copy">
			<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Our Values', 'estatein' ); ?></span></span>
			<h2><?php esc_html_e( 'Our Values', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Guiding every interaction is a simple standard: thoughtful advice, measured execution, and service that keeps your priorities in view.', 'estatein' ); ?></p>
		</div>
		<div class="about-values-panel">
			<?php foreach ( $values as $value ) : ?>
				<article class="about-values-panel__item">
					<div class="about-icon-badge" aria-hidden="true">+</div>
					<div>
						<h3><?php echo esc_html( $value['title'] ); ?></h3>
						<p><?php echo esc_html( $value['body'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--border about-section" id="achievements">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Achievements', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Our Achievements', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Along the way, we have built a track record shaped by careful service, clear communication, and outcomes clients feel good about.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-achievements">
			<?php foreach ( $achievements as $achievement ) : ?>
				<article class="about-achievement-card">
					<h3><?php echo esc_html( $achievement['title'] ); ?></h3>
					<p><?php echo esc_html( $achievement['body'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--border about-section" id="how-it-works">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'How It Works', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Navigating the Estatein Experience', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'A smooth, informed process matters. Here is how we help you move from early questions to confident decisions.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-steps">
			<?php foreach ( $steps as $step ) : ?>
				<article class="about-step-card">
					<span class="about-step-card__eyebrow"><?php echo esc_html( $step['step'] ); ?></span>
					<div class="about-step-card__body">
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['body'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--border about-section" id="team">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Team', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Meet the Estatein Team', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Our team brings together local knowledge, strategic thinking, and hands-on support for every kind of real estate goal.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-team-grid">
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

<section class="section section--border about-section" id="clients">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Clients', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Our Valued Clients', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Estatein works with people and teams who value clarity, strong presentation, and steady support through important property decisions.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-clients-grid">
			<?php foreach ( $clients as $client ) : ?>
				<article class="about-client-card">
					<div class="about-client-card__header">
						<div>
							<span class="about-client-card__since"><?php echo esc_html( $client['since'] ); ?></span>
							<h3><?php echo esc_html( $client['name'] ); ?></h3>
						</div>
						<a class="button button--small" href="<?php echo esc_url( $client['cta_url'] ); ?>"><?php echo esc_html( $client['cta_label'] ); ?></a>
					</div>
					<div class="about-client-card__meta">
						<div>
							<span><?php esc_html_e( 'Industry', 'estatein' ); ?></span>
							<strong><?php echo esc_html( $client['category'] ); ?></strong>
						</div>
						<div>
							<span><?php esc_html_e( 'Area', 'estatein' ); ?></span>
							<strong><?php echo esc_html( $client['domain'] ); ?></strong>
						</div>
					</div>
					<div class="about-client-card__quote">
						<span><?php esc_html_e( 'What They Said', 'estatein' ); ?></span>
						<p><?php echo esc_html( $client['quote'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="testimonial-footer about-clients-footer" aria-hidden="true">
			<span class="testimonial-footer__count">01 of <?php echo esc_html( str_pad( (string) count( $clients ), 2, '0', STR_PAD_LEFT ) ); ?></span>
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

<?php
get_footer();
