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
	?>
	<ul id="primary-menu">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'estatein' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'estatein' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'estatein' ); ?></a></li>
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
	$images = array(
		'hero'      => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=82',
		'feature'   => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=82',
		'property1' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=82',
		'property2' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=900&q=82',
		'property3' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=900&q=82',
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
			'excerpt' => __( 'A stunning coastal residence with open living areas, sunset views, and refined finishes.', 'estatein' ),
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
			'excerpt' => __( 'A polished city home near culture, dining, and everyday convenience.', 'estatein' ),
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
			'excerpt' => __( 'A warm private escape surrounded by nature with generous indoor and outdoor space.', 'estatein' ),
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
			'title'   => __( 'Smart Investments', 'estatein' ),
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
	return array(
		array(
			'title'    => __( 'Exceptional Service', 'estatein' ),
			'quote'    => __( 'Estatein helped us narrow the search quickly and guided us through every step with calm expertise.', 'estatein' ),
			'name'     => 'Emily Wilson',
			'location' => 'USA, California',
			'initials' => 'EW',
			'rating'   => '5/5',
		),
		array(
			'title'    => __( 'Efficient and Reliable', 'estatein' ),
			'quote'    => __( 'The selling plan was clear, the presentation was excellent, and the result exceeded expectations.', 'estatein' ),
			'name'     => 'Michael Wilson',
			'location' => 'USA, Florida',
			'initials' => 'MW',
			'rating'   => '5/5',
		),
		array(
			'title'    => __( 'Trusted Advisors', 'estatein' ),
			'quote'    => __( 'Their market insight helped us choose the right investment without feeling rushed.', 'estatein' ),
			'name'     => 'Sarah Lee',
			'location' => 'USA, Nevada',
			'initials' => 'SL',
			'rating'   => '5/5',
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
 * Sends lightweight lead form emails.
 */
function estatein_handle_lead_form() {
	if ( ! isset( $_POST['estatein_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['estatein_lead_nonce'] ) ), 'estatein_lead' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'estatein' ) );
	}

	$name     = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
	$email    = isset( $_POST['lead_email'] ) ? sanitize_email( wp_unslash( $_POST['lead_email'] ) ) : '';
	$phone    = isset( $_POST['lead_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) : '';
	$message  = isset( $_POST['lead_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lead_message'] ) ) : '';
	$interest = isset( $_POST['lead_interest'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_interest'] ) ) : __( 'General inquiry', 'estatein' );

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
