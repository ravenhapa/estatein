<?php
/**
 * 404 template.
 *
 * @package Estatein
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<span class="section-kicker"><?php esc_html_e( '404', 'estatein' ); ?></span>
		<h1><?php esc_html_e( 'This Page Is Off the Market', 'estatein' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for may have moved, but your next property search can continue.', 'estatein' ); ?></p>
	</div>
</section>

<section class="content-area">
	<div class="container">
		<a class="button button--accent" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return Home', 'estatein' ); ?></a>
	</div>
</section>

<?php
get_footer();
