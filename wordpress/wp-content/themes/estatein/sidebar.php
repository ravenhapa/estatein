<?php
/**
 * Sidebar template.
 *
 * @package Estatein
 */
?>

<aside class="site-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'estatein' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'Explore Estatein', 'estatein' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'estatein' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'estatein' ); ?></a></li>
			</ul>
		</section>
		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'Search', 'estatein' ); ?></h2>
			<?php get_search_form(); ?>
		</section>
	<?php endif; ?>
</aside>
