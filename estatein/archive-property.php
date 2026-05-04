<?php
/**
 * Property archive template.
 *
 * @package Estatein
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'Explore Properties', 'estatein' ); ?></span>
		<h1><?php esc_html_e( 'Find a Property That Fits Your Next Chapter', 'estatein' ); ?></h1>
		<p><?php esc_html_e( 'Browse available homes, investment spaces, and standout listings curated by the Estatein team.', 'estatein' ); ?></p>
	</div>
</section>

<section class="content-area">
	<div class="container archive-layout">
		<aside class="filter-panel" aria-label="<?php esc_attr_e( 'Property filters', 'estatein' ); ?>">
			<h2><?php esc_html_e( 'Property Types', 'estatein' ); ?></h2>
			<ul class="filter-list">
				<li><a href="<?php echo esc_url( get_post_type_archive_link( 'property' ) ); ?>"><span><?php esc_html_e( 'All Properties', 'estatein' ); ?></span></a></li>
				<?php
				$terms = get_terms( array(
					'taxonomy'   => 'property_type',
					'hide_empty' => true,
				) );

				if ( ! is_wp_error( $terms ) ) :
					foreach ( $terms as $term ) :
						?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
								<span><?php echo esc_html( $term->name ); ?></span>
								<span><?php echo esc_html( $term->count ); ?></span>
							</a>
						</li>
						<?php
					endforeach;
				endif;
				?>
			</ul>
		</aside>

		<div>
			<?php if ( have_posts() ) : ?>
				<div class="property-grid">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php get_template_part( 'template-parts/property-card', null, array( 'post_id' => get_the_ID() ) ); ?>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="property-grid">
					<?php foreach ( estatein_demo_properties() as $property ) : ?>
						<?php get_template_part( 'template-parts/property-card', null, array( 'property' => $property ) ); ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
