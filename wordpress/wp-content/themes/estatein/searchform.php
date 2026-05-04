<?php
/**
 * Search form template.
 *
 * @package Estatein
 */

$estatein_search_id = wp_unique_id( 'search-field-' );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $estatein_search_id ); ?>"><?php esc_html_e( 'Search for:', 'estatein' ); ?></label>
	<input id="<?php echo esc_attr( $estatein_search_id ); ?>" type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search Estatein', 'estatein' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button class="button button--accent" type="submit"><?php esc_html_e( 'Search', 'estatein' ); ?></button>
</form>
