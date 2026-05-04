<?php
/**
 * Main template.
 *
 * @package Estatein
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'Insights', 'estatein' ); ?></span>
		<h1><?php echo esc_html( get_the_archive_title() ? wp_strip_all_tags( get_the_archive_title() ) : get_bloginfo( 'name' ) ); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
			<p><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="content-area">
	<div class="container blog-layout">
		<div>
			<?php if ( have_posts() ) : ?>
				<div class="property-grid property-grid--blog">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<article <?php post_class( 'property-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="property-card__image" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'estatein-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
								</a>
							<?php endif; ?>
							<div class="property-card__body">
								<span class="property-card__eyebrow"><?php echo esc_html( get_the_date() ); ?></span>
								<div>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
								</div>
								<a class="button button--small" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'estatein' ); ?></a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="empty-state">
					<h2><?php esc_html_e( 'No posts yet', 'estatein' ); ?></h2>
					<p><?php esc_html_e( 'Add your first post in WordPress to start publishing Estatein insights.', 'estatein' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</section>

<?php
get_footer();
