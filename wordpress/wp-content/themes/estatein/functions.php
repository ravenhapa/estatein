<?php
/**
 * Estatein theme functions.
 *
 * @package Estatein
 */

if ( ! defined( 'ESTATEIN_VERSION' ) ) {
	define( 'ESTATEIN_VERSION', '1.0.0' );
}

require get_template_directory() . '/inc/content-types.php';
require get_template_directory() . '/inc/property-meta.php';
require get_template_directory() . '/inc/content-meta.php';
require get_template_directory() . '/inc/acf-fields.php';

if ( ! function_exists( 'estatein_setup' ) ) {
	/**
	 * Sets up theme defaults and support.
	 */
	function estatein_setup() {
		load_theme_textdomain( 'estatein', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_image_size( 'estatein-card', 720, 520, true );
		add_image_size( 'estatein-hero', 1200, 860, true );

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'estatein' ),
			'footer'  => __( 'Footer Menu', 'estatein' ),
		) );
	}
}
add_action( 'after_setup_theme', 'estatein_setup' );

/**
 * Enqueues theme assets.
 */
function estatein_enqueue_assets() {
	wp_enqueue_style(
		'estatein-fonts',
		'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'estatein-style', get_stylesheet_uri(), array(), ESTATEIN_VERSION );
	wp_enqueue_script( 'estatein-main', get_template_directory_uri() . '/assets/js/main.js', array(), ESTATEIN_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'estatein_enqueue_assets' );

/**
 * Registers reusable widget areas.
 */
function estatein_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'estatein' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets shown beside blog and search listings.', 'estatein' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'estatein_register_sidebars' );

/**
 * Outputs the Estatein favicon when no WordPress site icon is configured.
 */
function estatein_favicon() {
	if ( has_site_icon() ) {
		return;
	}

	$favicon_url = get_template_directory_uri() . '/assets/images/favicon.ico';
	?>
	<link rel="icon" href="<?php echo esc_url( $favicon_url ); ?>" sizes="any">
	<link rel="shortcut icon" href="<?php echo esc_url( $favicon_url ); ?>" type="image/x-icon">
	<?php
}
add_action( 'wp_head', 'estatein_favicon', 1 );
add_action( 'admin_head', 'estatein_favicon', 1 );

/**
 * Customizes document titles for the Estatein brand.
 *
 * @param array $parts Title parts.
 * @return array
 */
function estatein_document_title_parts( $parts ) {
	if ( is_front_page() || is_home() ) {
		$parts['title'] = __( 'Estatein - Discover Your Dream Property', 'estatein' );
		unset( $parts['site'], $parts['tagline'] );
		return $parts;
	}

	$parts['site'] = __( 'Estatein', 'estatein' );
	return $parts;
}
add_filter( 'document_title_parts', 'estatein_document_title_parts' );

/**
 * Outputs lightweight SEO and social meta tags.
 */
function estatein_meta_tags() {
	$description = get_bloginfo( 'description' );

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$description = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 28 );
		}
	} elseif ( is_post_type_archive( 'property' ) ) {
		$description = __( 'Browse Estatein properties, featured homes, and real estate opportunities.', 'estatein' );
	} elseif ( is_search() ) {
		$description = sprintf( __( 'Search results for %s on Estatein.', 'estatein' ), get_search_query() );
	}

	if ( ! $description ) {
		$description = __( 'Estatein helps buyers, sellers, and investors discover better real estate opportunities.', 'estatein' );
	}

	$description = wp_strip_all_tags( $description );
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>">
	<?php
}
add_action( 'wp_head', 'estatein_meta_tags', 2 );

/**
 * Fallback primary menu used before a menu is assigned.
 */
function estatein_primary_menu_fallback() {
	$current_path = trim( wp_parse_url( home_url( add_query_arg( null, null ) ), PHP_URL_PATH ), '/' );
	?>
	<ul id="primary-menu">
		<li class="<?php echo ( '' === $current_path ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'estatein' ); ?></a></li>
		<li class="<?php echo ( 'about' === $current_path ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'estatein' ); ?></a></li>
		<li class="<?php echo ( 'properties' === $current_path ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
		<li class="<?php echo ( 'services' === $current_path ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'estatein' ); ?></a></li>
	</ul>
	<?php
}

/**
 * Registers the Property post type and taxonomies.
 */
/**
 * Returns a reusable image URL for theme sections.
 *
 * @param string $key Image key.
 * @return string
 */
function estatein_image_url( $key ) {
	$theme_images = trailingslashit( get_template_directory_uri() ) . 'assets/images/';
	$images = array(
		'hero'      => $theme_images . 'front-page-image.png',
		'feature'   => $theme_images . 'feature-image-1.png',
		'property1' => $theme_images . 'feature-image-1.png',
		'property2' => $theme_images . 'feature-image-2.png',
		'property3' => $theme_images . 'feature-image-3.png',
	);

	return isset( $images[ $key ] ) ? $images[ $key ] : $images['hero'];
}

/**
 * Reads a property meta value with a fallback.
 *
 * @param int    $post_id Post ID.
 * @param string $key Meta key without theme prefix.
 * @param string $default Default value.
 * @return string
 */
function estatein_property_meta( $post_id, $key, $default = '' ) {
	$value = estatein_meta( $post_id, $key, '' );
	return '' !== $value ? $value : $default;
}

/**
 * Reads theme meta values from ACF or fallback custom meta boxes.
 *
 * @param int    $post_id Post ID.
 * @param string $key Meta key without prefix.
 * @param string $default Default value.
 * @return string
 */
function estatein_meta( $post_id, $key, $default = '' ) {
	$keys = array( '_estatein_' . $key, 'estatein_' . $key );

	foreach ( $keys as $meta_key ) {
		$value = get_post_meta( $post_id, $meta_key, true );
		if ( '' !== $value ) {
			return $value;
		}
	}

	return $default;
}

/**
 * Demo cards shown before editors add Property posts.
 *
 * @return array[]
 */
function estatein_demo_properties() {
	return array(
		array(
			'title'   => __( 'Seaside Serenity Villa', 'estatein' ),
			'excerpt' => __( 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood', 'estatein' ),
			'price'   => '$1,250,000',
			'address' => 'Malibu, California',
			'beds'    => '4',
			'baths'   => '3',
			'area'    => '2,500 sq ft',
			'image'   => estatein_image_url( 'property1' ),
			'url'     => home_url( '/properties/' ),
			'label'   => __( 'For Sale', 'estatein' ),
		),
		array(
			'title'   => __( 'Metropolitan Haven', 'estatein' ),
			'excerpt' => __( 'A chic and fully-furnished 2-bedroom apartment with panoramic city views', 'estatein' ),
			'price'   => '$850,000',
			'address' => 'New York, New York',
			'beds'    => '2',
			'baths'   => '2',
			'area'    => '1,450 sq ft',
			'image'   => estatein_image_url( 'property2' ),
			'url'     => home_url( '/properties/' ),
			'label'   => __( 'Featured', 'estatein' ),
		),
		array(
			'title'   => __( 'Rustic Retreat Cottage', 'estatein' ),
			'excerpt' => __( 'An elegant 3-bedroom, 2.5-bathroom townhouse in a gated community', 'estatein' ),
			'price'   => '$540,000',
			'address' => 'Aspen, Colorado',
			'beds'    => '3',
			'baths'   => '2',
			'area'    => '1,900 sq ft',
			'image'   => estatein_image_url( 'property3' ),
			'url'     => home_url( '/properties/' ),
			'label'   => __( 'New Listing', 'estatein' ),
		),
	);
}

/**
 * Default property content used for test and fallback rendering.
 *
 * @return array
 */
function estatein_property_defaults() {
	return array(
		'price'               => '$1,250,000',
		'address'             => 'Malibu, California',
		'beds'                => '04',
		'baths'               => '03',
		'area'                => '2,500 Square Feet',
		'label'               => __( 'Villa', 'estatein' ),
		'property_type'       => __( 'Villa', 'estatein' ),
		'property_status'     => __( 'For Sale', 'estatein' ),
		'year_built'          => '2023',
		'inquiry_intro'       => __( 'Interested in this property? Fill out the form below, and our real estate specialists will get back to you with more details, scheduling options, and tailored recommendations.', 'estatein' ),
		'pricing_details'     => __( 'At Estatein, transparency is key. Explore the estimated purchase and ownership costs below so your planning feels straightforward from day one.', 'estatein' ),
		'pricing_note'        => __( 'The figures below are estimated to help you understand the purchase and monthly costs associated with this property. Adjust the content later if you need market-specific numbers.', 'estatein' ),
		'gallery_images'      => array(
			estatein_image_url( 'property1' ),
			estatein_image_url( 'property2' ),
			estatein_image_url( 'property3' ),
			estatein_image_url( 'property1' ),
			estatein_image_url( 'property2' ),
			estatein_image_url( 'property3' ),
		),
		'amenities'           => array(
			__( 'Expansive oceanfront terrace for outdoor entertaining', 'estatein' ),
			__( 'Gourmet kitchen with top-of-the-line appliances', 'estatein' ),
			__( 'Private infinity pool and spa with landscaped deck', 'estatein' ),
			__( 'Primary suite with spa-inspired bathroom and walk-in closet', 'estatein' ),
			__( 'Smart home system for lighting, climate, and security', 'estatein' ),
		),
		'additional_fees'     => array(
			array(
				'label' => __( 'Property Transfer Tax', 'estatein' ),
				'value' => '$25,000',
				'note'  => __( 'Estimated based on the final purchase price.', 'estatein' ),
			),
			array(
				'label' => __( 'Legal Fees', 'estatein' ),
				'value' => '$3,000',
				'note'  => __( 'Approximate rate for purchase contract review and closing support.', 'estatein' ),
			),
			array(
				'label' => __( 'Home Inspection', 'estatein' ),
				'value' => '$500',
				'note'  => __( 'Recommended before finalizing the purchase.', 'estatein' ),
			),
			array(
				'label' => __( 'Property Insurance', 'estatein' ),
				'value' => '$1,200',
				'note'  => __( 'An annual premium estimate based on comparable coverage.', 'estatein' ),
			),
		),
		'monthly_costs'       => array(
			array(
				'label' => __( 'Property Taxes', 'estatein' ),
				'value' => '$1,250',
				'note'  => __( 'Approximate monthly portion of local property taxes.', 'estatein' ),
			),
			array(
				'label' => __( 'Homeowners Association Fee', 'estatein' ),
				'value' => '$300',
				'note'  => __( 'Monthly dues for shared amenities and community upkeep.', 'estatein' ),
			),
		),
		'total_initial_costs' => array(
			array(
				'label' => __( 'Listing Price', 'estatein' ),
				'value' => '$1,250,000',
				'note'  => __( 'Primary purchase amount.', 'estatein' ),
			),
			array(
				'label' => __( 'Additional Fees', 'estatein' ),
				'value' => '$29,700',
				'note'  => __( 'Transfer tax, legal fees, inspection, and insurance.', 'estatein' ),
			),
			array(
				'label' => __( 'Down Payment', 'estatein' ),
				'value' => '$250,000',
				'note'  => __( 'Estimated at 20% for planning purposes.', 'estatein' ),
			),
			array(
				'label' => __( 'Mortgage Amount', 'estatein' ),
				'value' => '$1,000,000',
				'note'  => __( 'Approximate financed amount after down payment.', 'estatein' ),
			),
		),
		'monthly_expenses'    => array(
			array(
				'label' => __( 'Property Taxes', 'estatein' ),
				'value' => '$1,250',
				'note'  => __( 'Estimated monthly property tax allocation.', 'estatein' ),
			),
			array(
				'label' => __( 'Homeowners Association Fee', 'estatein' ),
				'value' => '$300',
				'note'  => __( 'Monthly community fee.', 'estatein' ),
			),
			array(
				'label' => __( 'Mortgage Payment', 'estatein' ),
				'value' => '$4,700',
				'note'  => __( 'Sample estimate based on terms and interest rate.', 'estatein' ),
			),
			array(
				'label' => __( 'Property Insurance', 'estatein' ),
				'value' => '$100',
				'note'  => __( 'Approximate monthly share of annual insurance.', 'estatein' ),
			),
		),
	);
}

/**
 * Returns a property field default formatted for editor fields.
 *
 * @param string $key Property field key.
 * @return string
 */
function estatein_property_editor_default( $key ) {
	$defaults = estatein_property_defaults();

	if ( ! isset( $defaults[ $key ] ) ) {
		return '';
	}

	$value = $defaults[ $key ];

	if ( is_array( $value ) ) {
		$lines = array();

		foreach ( $value as $item ) {
			if ( is_array( $item ) ) {
				$lines[] = implode(
					' | ',
					array_filter(
						array(
							isset( $item['label'] ) ? $item['label'] : '',
							isset( $item['value'] ) ? $item['value'] : '',
							isset( $item['note'] ) ? $item['note'] : '',
						),
						'strlen'
					)
				);
			} else {
				$lines[] = $item;
			}
		}

		return implode( "\n", $lines );
	}

	return (string) $value;
}

/**
 * Parses a multi-line property meta value.
 *
 * @param int    $post_id Post ID.
 * @param string $key Meta key without prefix.
 * @param array  $default Default lines.
 * @return array
 */
function estatein_property_lines_meta( $post_id, $key, $default = array() ) {
	$raw = trim( estatein_meta( $post_id, $key, '' ) );

	if ( '' === $raw ) {
		return $default;
	}

	$lines = preg_split( '/\r\n|\r|\n/', $raw );
	$lines = array_map( 'trim', $lines );
	$lines = array_values( array_filter( $lines, 'strlen' ) );

	return $lines ? $lines : $default;
}

/**
 * Parses line-based property table rows in the format "Label | Value | Note".
 *
 * @param int    $post_id Post ID.
 * @param string $key Meta key without prefix.
 * @param array  $default Default rows.
 * @return array[]
 */
function estatein_property_table_meta( $post_id, $key, $default = array() ) {
	$lines = estatein_property_lines_meta( $post_id, $key, array() );

	if ( empty( $lines ) ) {
		return $default;
	}

	$rows = array();

	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line ) );
		$rows[] = array(
			'label' => isset( $parts[0] ) ? $parts[0] : '',
			'value' => isset( $parts[1] ) ? $parts[1] : '',
			'note'  => isset( $parts[2] ) ? $parts[2] : '',
		);
	}

	return $rows ? $rows : $default;
}

/**
 * Demo services shown before Service posts are added.
 *
 * @return array[]
 */
function estatein_demo_services() {
	return array(
		array(
			'icon'    => 'H',
			'title'   => __( 'Find Your Dream Home', 'estatein' ),
			'excerpt' => __( 'Match your goals with curated homes, local insight, and clear next steps.', 'estatein' ),
			'url'     => home_url( '/properties/' ),
		),
		array(
			'icon'    => '$',
			'title'   => __( 'Unlock Property Value', 'estatein' ),
			'excerpt' => __( 'Price, present, and negotiate your sale with a stronger market strategy.', 'estatein' ),
			'url'     => home_url( '/services/#selling' ),
		),
		array(
			'icon'    => 'B',
			'title'   => __( 'Effortless Property Management', 'estatein' ),
			'excerpt' => __( 'Simplify ownership with tenant, maintenance, finance, and compliance support.', 'estatein' ),
			'url'     => home_url( '/services/#management' ),
		),
		array(
			'icon'    => '%',
			'title'   => __( 'Smart Investments, Informed Decisions', 'estatein' ),
			'excerpt' => __( 'Use market analysis and ROI planning to make more confident decisions.', 'estatein' ),
			'url'     => home_url( '/services/#investments' ),
		),
	);
}

/**
 * Demo testimonials shown before Testimonial posts are added.
 *
 * @return array[]
 */
function estatein_demo_testimonials() {
	$theme_images = trailingslashit( get_template_directory_uri() ) . 'assets/images/';

	return array(
		array(
			'title'    => __( 'Exceptional Service!', 'estatein' ),
			'quote'    => __( 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'estatein' ),
			'name'     => 'Wade Warren',
			'location' => 'USA, California',
			'initials' => 'WW',
			'rating'   => '5/5',
			'avatar'   => $theme_images . 'testimonial_1.webp',
		),
		array(
			'title'    => __( 'Efficient and Reliable', 'estatein' ),
			'quote'    => __( 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'estatein' ),
			'name'     => 'Emelie Thomson',
			'location' => 'USA, Florida',
			'initials' => 'ET',
			'rating'   => '5/5',
			'avatar'   => $theme_images . 'testimonial_2.webp',
		),
		array(
			'title'    => __( 'Trusted Advisors', 'estatein' ),
			'quote'    => __( 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!', 'estatein' ),
			'name'     => 'John Mans',
			'location' => 'USA, Nevada',
			'initials' => 'JM',
			'rating'   => '5/5',
			'avatar'   => $theme_images . 'testimonial_3.webp',
		),
	);
}

/**
 * Demo FAQs shown before FAQ posts are added.
 *
 * @return array[]
 */
function estatein_demo_faqs() {
	return array(
		array(
			'title' => __( 'How do I start searching for a property with Estatein?', 'estatein' ),
			'body'  => __( 'Begin with the properties archive or send an inquiry. The team can help refine your budget, location, and must-have features.', 'estatein' ),
		),
		array(
			'title' => __( 'Can Estatein help sell my current property?', 'estatein' ),
			'body'  => __( 'Yes. Estatein supports valuation, marketing, negotiation, and closing so your sale has a clear strategy from the start.', 'estatein' ),
		),
		array(
			'title' => __( 'Do you support investment planning?', 'estatein' ),
			'body'  => __( 'Estatein can help compare opportunities, assess potential returns, and plan a more balanced real estate portfolio.', 'estatein' ),
		),
	);
}

/**
 * Demo team members shown before Team Member posts are added.
 *
 * @return array[]
 */
function estatein_demo_team_members() {
	return array(
		array(
			'initials' => 'BA',
			'name'     => __( 'Buyer Advisors', 'estatein' ),
			'role'     => __( 'Property Discovery', 'estatein' ),
			'excerpt'  => __( 'Guidance for shortlists, showings, offers, and local comparisons.', 'estatein' ),
		),
		array(
			'initials' => 'SS',
			'name'     => __( 'Seller Strategists', 'estatein' ),
			'role'     => __( 'Sales Strategy', 'estatein' ),
			'excerpt'  => __( 'Pricing, positioning, and launch plans designed to earn stronger offers.', 'estatein' ),
		),
		array(
			'initials' => 'IG',
			'name'     => __( 'Investment Guides', 'estatein' ),
			'role'     => __( 'Portfolio Planning', 'estatein' ),
			'excerpt'  => __( 'Market analysis and portfolio direction for long-term property growth.', 'estatein' ),
		),
	);
}

/**
 * Demo client stories used on the About page before content is managed.
 *
 * @return array[]
 */
function estatein_demo_clients() {
	return array(
		array(
			'since'      => 'Since 2019',
			'name'       => 'ABC Corporation',
			'category'   => __( 'Commercial Real Estate', 'estatein' ),
			'domain'     => __( 'Luxury Home Development', 'estatein' ),
			'quote'      => __( 'Estatein helped us identify a new segment for expansion and present investment opportunities with more clarity. Their process was sharp, responsive, and grounded in market reality.', 'estatein' ),
			'advisor'    => 'John M.',
			'cta_label'  => __( 'Visit Website', 'estatein' ),
			'cta_url'    => home_url( '/contact/' ),
		),
		array(
			'since'      => 'Since 2018',
			'name'       => 'GreenTech Enterprises',
			'category'   => __( 'Commercial Real Estate', 'estatein' ),
			'domain'     => __( 'Retail Spaces', 'estatein' ),
			'quote'      => __( 'The Estatein team balanced speed with careful guidance. We secured a better location than expected and felt supported from shortlist through signing.', 'estatein' ),
			'advisor'    => 'Sarah J.',
			'cta_label'  => __( 'Visit Website', 'estatein' ),
			'cta_url'    => home_url( '/contact/' ),
		),
		array(
			'since'      => 'Since 2020',
			'name'       => 'UrbanNest Group',
			'category'   => __( 'Residential Real Estate', 'estatein' ),
			'domain'     => __( 'Mixed-Use Communities', 'estatein' ),
			'quote'      => __( 'Estatein gave our expansion team a much clearer view of market opportunities. Their guidance helped us shortlist better properties and move faster with confidence.', 'estatein' ),
			'advisor'    => 'David R.',
			'cta_label'  => __( 'Visit Website', 'estatein' ),
			'cta_url'    => home_url( '/contact/' ),
		),
		array(
			'since'      => 'Since 2021',
			'name'       => 'BluePeak Holdings',
			'category'   => __( 'Investment Real Estate', 'estatein' ),
			'domain'     => __( 'Office and Commercial Assets', 'estatein' ),
			'quote'      => __( 'We appreciated how practical the Estatein team was throughout the process. Their market summaries, negotiation support, and responsiveness made a real difference.', 'estatein' ),
			'advisor'    => 'Michael T.',
			'cta_label'  => __( 'Visit Website', 'estatein' ),
			'cta_url'    => home_url( '/contact/' ),
		),
	);
}

/**
 * Sends lightweight lead form emails.
 */
function estatein_handle_lead_form() {
	if ( ! isset( $_POST['estatein_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['estatein_lead_nonce'] ) ), 'estatein_lead' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'estatein' ) );
	}

	$name      = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
	$last_name = isset( $_POST['lead_last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_last_name'] ) ) : '';
	$email     = isset( $_POST['lead_email'] ) ? sanitize_email( wp_unslash( $_POST['lead_email'] ) ) : '';
	$phone     = isset( $_POST['lead_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) : '';
	$message   = isset( $_POST['lead_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lead_message'] ) ) : '';
	$interest  = isset( $_POST['lead_interest'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_interest'] ) ) : __( 'General inquiry', 'estatein' );

	if ( '' !== $last_name ) {
		$name = trim( $name . ' ' . $last_name );
	}

	if ( ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'estatein_status', 'invalid', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
		exit;
	}

	$body = sprintf(
		"Name: %s\nEmail: %s\nPhone: %s\nInterest: %s\n\nMessage:\n%s",
		$name,
		$email,
		$phone,
		$interest,
		$message
	);

	wp_mail( get_option( 'admin_email' ), __( 'New Estatein inquiry', 'estatein' ), $body );

	wp_safe_redirect( add_query_arg( 'estatein_status', 'sent', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
	exit;
}
add_action( 'admin_post_estatein_lead', 'estatein_handle_lead_form' );
add_action( 'admin_post_nopriv_estatein_lead', 'estatein_handle_lead_form' );
