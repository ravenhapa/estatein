<?php
/**
 * Single post template.
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="page-hero">
		<div class="container">
			<span class="section-kicker"><?php echo esc_html( get_the_date() ); ?></span>
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="content-area">
		<div class="container">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="single-property__gallery">
					<?php the_post_thumbnail( 'estatein-hero', array( 'decoding' => 'async', 'fetchpriority' => 'high' ) ); ?>
				</div>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
