<?php
/**
 * Property archive template.
 *
 * @package Estatein
 */

get_header();

global $wp_query;

$property_type_terms = get_terms( array(
	'taxonomy'   => 'property_type',
	'hide_empty' => true,
) );

$property_status_terms = get_terms( array(
	'taxonomy'   => 'property_status',
	'hide_empty' => true,
) );

$location_options = array();

if ( have_posts() ) {
	foreach ( $wp_query->posts as $property_post ) {
		$address = estatein_property_meta( $property_post->ID, 'address' );

		if ( $address ) {
			$location_options[] = $address;
		}
	}
}

if ( empty( $location_options ) ) {
	foreach ( estatein_demo_properties() as $property ) {
		if ( ! empty( $property['address'] ) ) {
			$location_options[] = $property['address'];
		}
	}
}

$location_options = array_values( array_unique( $location_options ) );
$archive_count    = have_posts() ? (int) $wp_query->post_count : count( estatein_demo_properties() );
?>

<section class="archive-hero">
	<div class="container">
		<div class="archive-hero__copy">
			<h1><?php esc_html_e( 'Find Your Dream Property', 'estatein' ); ?></h1>
			<p><?php esc_html_e( 'Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every dreamer, your journey starts here.', 'estatein' ); ?></p>
		</div>

		<form class="archive-search-shell" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="hidden" name="post_type" value="property">
			<div class="archive-search-shell__bar">
				<label class="screen-reader-text" for="property-keyword"><?php esc_html_e( 'Search for a property', 'estatein' ); ?></label>
				<input id="property-keyword" type="search" name="s" placeholder="<?php esc_attr_e( 'Search For A Property', 'estatein' ); ?>">
				<button class="button button--accent" type="submit"><?php esc_html_e( 'Find Property', 'estatein' ); ?></button>
			</div>
			<div class="archive-filter-row">
				<div class="archive-filter">
					<span class="archive-filter__icon" aria-hidden="true">&#9679;</span>
					<select name="location">
						<option value=""><?php esc_html_e( 'Location', 'estatein' ); ?></option>
						<?php foreach ( $location_options as $location ) : ?>
							<option value="<?php echo esc_attr( $location ); ?>"><?php echo esc_html( $location ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="archive-filter">
					<span class="archive-filter__icon" aria-hidden="true">&#9638;</span>
					<select name="property_type">
						<option value=""><?php esc_html_e( 'Property Type', 'estatein' ); ?></option>
						<?php if ( ! is_wp_error( $property_type_terms ) ) : ?>
							<?php foreach ( $property_type_terms as $term ) : ?>
								<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
				<div class="archive-filter">
					<span class="archive-filter__icon" aria-hidden="true">$</span>
					<select name="price_range">
						<option value=""><?php esc_html_e( 'Pricing Range', 'estatein' ); ?></option>
						<option value="under-500k"><?php esc_html_e( 'Under $500,000', 'estatein' ); ?></option>
						<option value="500k-1m"><?php esc_html_e( '$500,000 - $1,000,000', 'estatein' ); ?></option>
						<option value="1m-plus"><?php esc_html_e( '$1,000,000+', 'estatein' ); ?></option>
					</select>
				</div>
				<div class="archive-filter">
					<span class="archive-filter__icon" aria-hidden="true">&#9635;</span>
					<select name="property_size">
						<option value=""><?php esc_html_e( 'Property Size', 'estatein' ); ?></option>
						<option value="compact"><?php esc_html_e( 'Compact', 'estatein' ); ?></option>
						<option value="mid"><?php esc_html_e( 'Mid Size', 'estatein' ); ?></option>
						<option value="large"><?php esc_html_e( 'Large', 'estatein' ); ?></option>
					</select>
				</div>
				<div class="archive-filter">
					<span class="archive-filter__icon" aria-hidden="true">&#9711;</span>
					<select name="build_year">
						<option value=""><?php esc_html_e( 'Build Year', 'estatein' ); ?></option>
						<option value="2020s"><?php esc_html_e( '2020+', 'estatein' ); ?></option>
						<option value="2010s"><?php esc_html_e( '2010 - 2019', 'estatein' ); ?></option>
						<option value="older"><?php esc_html_e( 'Before 2010', 'estatein' ); ?></option>
					</select>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="section archive-showcase">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Property Showcase', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Discover a World of Possibilities', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Our portfolio of properties is as diverse as your dreams. Explore the featured categories to find the perfect property that resonates with your vision of home.', 'estatein' ); ?></p>
			</div>
		</div>

		<div class="property-slider" data-property-slider>
			<div class="property-slider__viewport">
				<div class="property-slider__track" data-property-slider-track>
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>
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
				<span class="property-slider__count"><span data-property-slider-current>01</span> of <span data-property-slider-total><?php echo esc_html( str_pad( (string) $archive_count, 2, '0', STR_PAD_LEFT ) ); ?></span></span>
				<div class="property-slider__actions">
					<button class="property-slider__button" type="button" data-property-slider-prev aria-label="<?php esc_attr_e( 'Previous properties', 'estatein' ); ?>">
						<span aria-hidden="true">&#8592;</span>
					</button>
					<button class="property-slider__button property-slider__button--active" type="button" data-property-slider-next aria-label="<?php esc_attr_e( 'Next properties', 'estatein' ); ?>">
						<span aria-hidden="true">&#8594;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section archive-inquiry">
	<div class="container">
		<div class="section-heading">
			<div>
				<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Property Inquiry', 'estatein' ); ?></span></span>
				<h2><?php esc_html_e( 'Let\'s Make it Happen', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'Ready to take the first step toward your dream property? Fill out the form below, and our real estate experts will work to match you with the right next move. Let\'s embark on this exciting journey together.', 'estatein' ); ?></p>
			</div>
		</div>

		<div class="archive-inquiry__panel">
			<form class="form-grid archive-inquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="estatein_lead">
				<input type="hidden" name="lead_interest" value="<?php esc_attr_e( 'Property archive inquiry', 'estatein' ); ?>">
				<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
				<div class="form-row form-row--split archive-inquiry-form__quad">
					<div>
						<label for="archive-first-name"><?php esc_html_e( 'First Name', 'estatein' ); ?></label>
						<input id="archive-first-name" type="text" name="lead_name" placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein' ); ?>" required>
					</div>
					<div>
						<label for="archive-last-name"><?php esc_html_e( 'Last Name', 'estatein' ); ?></label>
						<input id="archive-last-name" type="text" name="lead_last_name" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein' ); ?>">
					</div>
					<div>
						<label for="archive-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
						<input id="archive-email" type="email" name="lead_email" placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein' ); ?>" required>
					</div>
					<div>
						<label for="archive-phone"><?php esc_html_e( 'Phone', 'estatein' ); ?></label>
						<input id="archive-phone" type="tel" name="lead_phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein' ); ?>">
					</div>
				</div>

				<div class="form-row form-row--split archive-inquiry-form__quad">
					<div>
						<label for="archive-location"><?php esc_html_e( 'Preferred Location', 'estatein' ); ?></label>
						<select id="archive-location" name="preferred_location">
							<option value=""><?php esc_html_e( 'Select Location', 'estatein' ); ?></option>
							<?php foreach ( $location_options as $location ) : ?>
								<option value="<?php echo esc_attr( $location ); ?>"><?php echo esc_html( $location ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div>
						<label for="archive-property-type"><?php esc_html_e( 'Property Type', 'estatein' ); ?></label>
						<select id="archive-property-type" name="archive_property_type">
							<option value=""><?php esc_html_e( 'Select Property Type', 'estatein' ); ?></option>
							<?php if ( ! is_wp_error( $property_type_terms ) ) : ?>
								<?php foreach ( $property_type_terms as $term ) : ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</div>
					<div>
						<label for="archive-bathrooms"><?php esc_html_e( 'No. of Bathrooms', 'estatein' ); ?></label>
						<select id="archive-bathrooms" name="bathrooms">
							<option value=""><?php esc_html_e( 'Select no. of Bathrooms', 'estatein' ); ?></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4-plus"><?php esc_html_e( '4+', 'estatein' ); ?></option>
						</select>
					</div>
					<div>
						<label for="archive-bedrooms"><?php esc_html_e( 'No. of Bedrooms', 'estatein' ); ?></label>
						<select id="archive-bedrooms" name="bedrooms">
							<option value=""><?php esc_html_e( 'Select no. of Bedrooms', 'estatein' ); ?></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4-plus"><?php esc_html_e( '4+', 'estatein' ); ?></option>
						</select>
					</div>
				</div>

				<div class="form-row form-row--split archive-inquiry-form__budget-row">
					<div>
						<label for="archive-budget"><?php esc_html_e( 'Budget', 'estatein' ); ?></label>
						<select id="archive-budget" name="budget">
							<option value=""><?php esc_html_e( 'Select Budget', 'estatein' ); ?></option>
							<option value="under-500k"><?php esc_html_e( 'Under $500,000', 'estatein' ); ?></option>
							<option value="500k-1m"><?php esc_html_e( '$500,000 - $1,000,000', 'estatein' ); ?></option>
							<option value="1m-plus"><?php esc_html_e( '$1,000,000+', 'estatein' ); ?></option>
						</select>
					</div>
					<div>
						<label><?php esc_html_e( 'Preferred Contact Method', 'estatein' ); ?></label>
						<div class="archive-contact-options">
							<label class="archive-contact-option">
								<input type="radio" name="preferred_contact" value="phone" checked>
								<span><?php esc_html_e( 'Enter Your Number', 'estatein' ); ?></span>
							</label>
							<label class="archive-contact-option">
								<input type="radio" name="preferred_contact" value="email">
								<span><?php esc_html_e( 'Enter Your Email', 'estatein' ); ?></span>
							</label>
						</div>
					</div>
				</div>

				<div class="form-row">
					<label for="archive-message"><?php esc_html_e( 'Message', 'estatein' ); ?></label>
					<textarea id="archive-message" name="lead_message" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein' ); ?>"></textarea>
				</div>

				<div class="archive-inquiry-form__footer">
					<label class="archive-agreement">
						<input type="checkbox" required>
						<span><?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'estatein' ); ?></span>
					</label>
					<button class="button button--accent" type="submit"><?php esc_html_e( 'Send Your Message', 'estatein' ); ?></button>
				</div>
			</form>
		</div>
	</div>
</section>

<?php
get_footer();
