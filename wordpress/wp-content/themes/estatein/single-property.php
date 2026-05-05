<?php
/**
 * Single property template.
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();

	$defaults            = estatein_property_defaults();
	$price               = estatein_property_meta( get_the_ID(), 'price', $defaults['price'] );
	$address             = estatein_property_meta( get_the_ID(), 'address', $defaults['address'] );
	$beds                = estatein_property_meta( get_the_ID(), 'beds', $defaults['beds'] );
	$baths               = estatein_property_meta( get_the_ID(), 'baths', $defaults['baths'] );
	$area                = estatein_property_meta( get_the_ID(), 'area', $defaults['area'] );
	$label               = estatein_property_meta( get_the_ID(), 'label', $defaults['label'] );
	$property_type       = estatein_property_meta( get_the_ID(), 'property_type', $defaults['property_type'] );
	$property_status     = estatein_property_meta( get_the_ID(), 'property_status', $defaults['property_status'] );
	$year_built          = estatein_property_meta( get_the_ID(), 'year_built', $defaults['year_built'] );
	$inquiry_intro       = estatein_property_meta( get_the_ID(), 'inquiry_intro', $defaults['inquiry_intro'] );
	$pricing_details     = estatein_property_meta( get_the_ID(), 'pricing_details', $defaults['pricing_details'] );
	$pricing_note        = estatein_property_meta( get_the_ID(), 'pricing_note', $defaults['pricing_note'] );
	$gallery_images      = estatein_property_lines_meta( get_the_ID(), 'gallery_images', $defaults['gallery_images'] );
	$amenities           = estatein_property_lines_meta( get_the_ID(), 'amenities', $defaults['amenities'] );
	$additional_fees     = estatein_property_table_meta( get_the_ID(), 'additional_fees', $defaults['additional_fees'] );
	$monthly_costs       = estatein_property_table_meta( get_the_ID(), 'monthly_costs', $defaults['monthly_costs'] );
	$total_initial_costs = estatein_property_table_meta( get_the_ID(), 'total_initial_costs', $defaults['total_initial_costs'] );
	$monthly_expenses    = estatein_property_table_meta( get_the_ID(), 'monthly_expenses', $defaults['monthly_expenses'] );
	$description         = has_excerpt() ? get_the_excerpt() : __( 'A beautifully designed property with balanced indoor-outdoor living, considered finishes, and flexible space for entertaining, family life, or a long-term investment.', 'estatein' );
	$content             = trim( get_the_content() );
	$faqs                = estatein_demo_faqs();
	$featured_image      = get_the_post_thumbnail_url( get_the_ID(), 'estatein-hero' );

	if ( $featured_image ) {
		array_unshift( $gallery_images, $featured_image );
		$gallery_images = array_values( array_unique( $gallery_images ) );
	}

	$gallery_pool = ! empty( $gallery_images ) ? $gallery_images : $defaults['gallery_images'];
	$gallery_pool = array_slice( array_values( array_unique( $gallery_pool ) ), 0, 8 );
	$gallery_main = ! empty( $gallery_pool[0] ) ? $gallery_pool[0] : estatein_image_url( 'property1' );
	$gallery_side = ! empty( $gallery_pool[1] ) ? $gallery_pool[1] : estatein_image_url( 'property2' );
	$thumb_images = $gallery_pool;
	?>

		<section class="content-area">
			<div class="container single-property-page">
				<article class="single-property-page__content">
					<header class="single-property__header">
						<div>
							<div class="single-property__eyebrow">
								<span><?php the_title(); ?></span>
								<span><?php echo esc_html( $address ); ?></span>
							</div>
						</div>
						<div class="single-property__price">
							<span><?php esc_html_e( 'Price', 'estatein' ); ?></span>
							<strong><?php echo esc_html( $price ); ?></strong>
						</div>
					</header>
					<div class="single-property__gallery">
						<div class="single-property__thumbs">
							<?php foreach ( $thumb_images as $index => $gallery_image ) : ?>
								<img src="<?php echo esc_url( $gallery_image ); ?>" alt="<?php echo esc_attr( sprintf( __( '%1$s preview %2$s', 'estatein' ), get_the_title(), $index + 1 ) ); ?>" loading="lazy" decoding="async">
							<?php endforeach; ?>
						</div>
						<div class="single-property__gallery-grid">
							<img src="<?php echo esc_url( $gallery_main ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" fetchpriority="high" decoding="async">
							<img src="<?php echo esc_url( $gallery_side ); ?>" alt="<?php echo esc_attr( sprintf( __( '%s interior', 'estatein' ), get_the_title() ) ); ?>" loading="lazy" decoding="async">
						</div>
						<div class="single-property__gallery-controls" aria-hidden="true">
							<button class="single-property__gallery-button" type="button">
								<span aria-hidden="true">&#8592;</span>
							</button>
							<button class="single-property__gallery-button single-property__gallery-button--active" type="button">
								<span aria-hidden="true">&#8594;</span>
							</button>
						</div>
					</div>
					<div class="single-property__details">
						<section class="single-property__section">
							<h2><?php esc_html_e( 'Description', 'estatein' ); ?></h2>
							<p><?php echo esc_html( $description ); ?></p>
							<div class="single-property__meta" aria-label="<?php esc_attr_e( 'Property details', 'estatein' ); ?>">
								<span><strong><?php echo esc_html( $beds ); ?></strong><em><?php esc_html_e( 'Bedrooms', 'estatein' ); ?></em></span>
								<span><strong><?php echo esc_html( $baths ); ?></strong><em><?php esc_html_e( 'Bathrooms', 'estatein' ); ?></em></span>
								<span><strong><?php echo esc_html( $area ); ?></strong><em><?php esc_html_e( 'Area', 'estatein' ); ?></em></span>
								<span><strong><?php echo esc_html( $year_built ); ?></strong><em><?php esc_html_e( 'Year Built', 'estatein' ); ?></em></span>
							</div>
							<?php if ( '' !== $content ) : ?>
								<div class="single-property__content entry-content">
									<?php the_content(); ?>
								</div>
							<?php endif; ?>
						</section>
						<section class="single-property__section">
							<h2><?php esc_html_e( 'Key Features and Amenities', 'estatein' ); ?></h2>
							<ul class="property-amenities">
								<?php foreach ( $amenities as $amenity ) : ?>
									<li><?php echo esc_html( $amenity ); ?></li>
								<?php endforeach; ?>
							</ul>
						</section>
					</div>
					<section class="single-property__inquiry">
						<div class="section-heading">
							<div>
								<span class="section-kicker section-kicker--icon-only"><span class="screen-reader-text"><?php esc_html_e( 'Property Inquiry', 'estatein' ); ?></span></span>
								<h2><?php esc_html_e( 'Inquire About', 'estatein' ); ?> <?php the_title(); ?></h2>
								<p><?php echo esc_html( $inquiry_intro ); ?></p>
							</div>
						</div>
						<div class="archive-inquiry__panel single-property__inquiry-panel">
							<form class="form-grid archive-inquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
								<input type="hidden" name="action" value="estatein_lead">
								<input type="hidden" name="lead_interest" value="<?php echo esc_attr( get_the_title() ); ?>">
								<?php wp_nonce_field( 'estatein_lead', 'estatein_lead_nonce' ); ?>
								<div class="form-row form-row--split archive-inquiry-form__quad">
									<div>
										<label for="lead-first-name"><?php esc_html_e( 'First Name', 'estatein' ); ?></label>
										<input id="lead-first-name" type="text" name="lead_name" placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein' ); ?>" required>
									</div>
									<div>
										<label for="lead-last-name"><?php esc_html_e( 'Last Name', 'estatein' ); ?></label>
										<input id="lead-last-name" type="text" name="lead_last_name" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein' ); ?>">
									</div>
									<div>
										<label for="lead-email"><?php esc_html_e( 'Email', 'estatein' ); ?></label>
										<input id="lead-email" type="email" name="lead_email" placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein' ); ?>" required>
									</div>
									<div>
										<label for="lead-phone"><?php esc_html_e( 'Phone', 'estatein' ); ?></label>
										<input id="lead-phone" type="tel" name="lead_phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein' ); ?>">
									</div>
								</div>
								<div class="form-row form-row--split archive-inquiry-form__quad">
									<div>
										<label for="lead-interest"><?php esc_html_e( 'Selected Property', 'estatein' ); ?></label>
										<input id="lead-interest" type="text" value="<?php echo esc_attr( get_the_title() . ', ' . $address ); ?>" readonly>
									</div>
									<div>
										<label for="lead-property-type"><?php esc_html_e( 'Property Type', 'estatein' ); ?></label>
										<input id="lead-property-type" type="text" value="<?php echo esc_attr( $property_type ); ?>" readonly>
									</div>
									<div>
										<label for="lead-bathrooms"><?php esc_html_e( 'No. of Bathrooms', 'estatein' ); ?></label>
										<input id="lead-bathrooms" type="text" value="<?php echo esc_attr( $baths ); ?>" readonly>
									</div>
									<div>
										<label for="lead-bedrooms"><?php esc_html_e( 'No. of Bedrooms', 'estatein' ); ?></label>
										<input id="lead-bedrooms" type="text" value="<?php echo esc_attr( $beds ); ?>" readonly>
									</div>
								</div>
								<div class="form-row">
									<label for="lead-message"><?php esc_html_e( 'Message', 'estatein' ); ?></label>
									<textarea id="lead-message" name="lead_message" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein' ); ?>"><?php esc_html_e( 'I would like to know more about this property.', 'estatein' ); ?></textarea>
								</div>
								<div class="archive-inquiry-form__footer">
									<label class="archive-agreement">
										<input id="lead-terms" type="checkbox" required>
										<span><?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'estatein' ); ?></span>
									</label>
									<button class="button button--accent" type="submit"><?php esc_html_e( 'Send Your Message', 'estatein' ); ?></button>
								</div>
							</form>
						</div>
					</section>
					<section class="single-property__pricing">
						<div class="section-heading">
								<div>
									<span class="section-kicker"></span>
									<h2><?php esc_html_e( 'Comprehensive Pricing Details', 'estatein' ); ?></h2>
									<p><?php echo esc_html( $pricing_details ); ?></p>
								</div>
							</div>
						<div class="pricing-note">
							<span><?php esc_html_e( 'Note', 'estatein' ); ?></span>
							<p><?php echo esc_html( $pricing_note ); ?></p>
						</div>
						<div class="pricing-section">
							<div class="pricing-section__intro">
								<span><?php esc_html_e( 'Listing Price', 'estatein' ); ?></span>
								<strong><?php echo esc_html( $price ); ?></strong>
							</div>
							<div class="pricing-card">
								<div class="pricing-card__header">
									<h3><?php esc_html_e( 'Additional Fees', 'estatein' ); ?></h3>
									<span><?php echo esc_html( $property_status ); ?></span>
								</div>
								<div class="pricing-grid">
									<?php foreach ( $additional_fees as $row ) : ?>
										<div class="pricing-row">
											<h4><?php echo esc_html( $row['label'] ); ?></h4>
											<strong><?php echo esc_html( $row['value'] ); ?></strong>
											<p><?php echo esc_html( $row['note'] ); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="pricing-card">
								<div class="pricing-card__header">
									<h3><?php esc_html_e( 'Monthly Costs', 'estatein' ); ?></h3>
									<span><?php echo esc_html( $label ); ?></span>
								</div>
								<div class="pricing-grid pricing-grid--two">
									<?php foreach ( $monthly_costs as $row ) : ?>
										<div class="pricing-row">
											<h4><?php echo esc_html( $row['label'] ); ?></h4>
											<strong><?php echo esc_html( $row['value'] ); ?></strong>
											<p><?php echo esc_html( $row['note'] ); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="pricing-card">
								<div class="pricing-card__header">
									<h3><?php esc_html_e( 'Total Initial Costs', 'estatein' ); ?></h3>
									<span><?php esc_html_e( 'Estimate', 'estatein' ); ?></span>
								</div>
								<div class="pricing-grid pricing-grid--two">
									<?php foreach ( $total_initial_costs as $row ) : ?>
										<div class="pricing-row">
											<h4><?php echo esc_html( $row['label'] ); ?></h4>
											<strong><?php echo esc_html( $row['value'] ); ?></strong>
											<p><?php echo esc_html( $row['note'] ); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="pricing-card">
								<div class="pricing-card__header">
									<h3><?php esc_html_e( 'Monthly Expenses', 'estatein' ); ?></h3>
									<span><?php esc_html_e( 'Estimate', 'estatein' ); ?></span>
								</div>
								<div class="pricing-grid pricing-grid--two">
									<?php foreach ( $monthly_expenses as $row ) : ?>
										<div class="pricing-row">
											<h4><?php echo esc_html( $row['label'] ); ?></h4>
											<strong><?php echo esc_html( $row['value'] ); ?></strong>
											<p><?php echo esc_html( $row['note'] ); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</section>
					<section class="single-property__faq">
						<div class="section-heading">
							<div>
								<span class="section-kicker"></span>
								<h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein' ); ?></h2>
								<p><?php esc_html_e( 'Get answers to common questions about Estatein, our process, and next steps for buyers.', 'estatein' ); ?></p>
							</div>
							<a class="button button--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'View All FAQs', 'estatein' ); ?></a>
						</div>
						<div class="faq-grid">
							<?php foreach ( $faqs as $faq ) : ?>
								<?php get_template_part( 'template-parts/faq-card', null, array( 'faq' => $faq ) ); ?>
							<?php endforeach; ?>
							</div>
						</section>
				</article>
			</div>
		</section>
		<?php
	endwhile;

get_footer();
