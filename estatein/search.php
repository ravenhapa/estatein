<?php
/**
 * Search results template.
 *
 * @package Estatein
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( 'Search', 'estatein' ); ?></span>
		<h1><?php printf( esc_html__( 'Search Results for "%s"', 'estatein' ), esc_html( get_search_query() ) ); ?></h1>
	</div>
</section>

<section class="content-area">
	<div class="container blog-layout">
		<div>
			<?php get_search_form(); ?>
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
								<span class="property-card__eyebrow"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
								<div>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="empty-state">
					<h2><?php esc_html_e( 'No matching results', 'estatein' ); ?></h2>
					<p><?php esc_html_e( 'Try another search term or browse the properties archive.', 'estatein' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</section>

<?php
get_footer();
