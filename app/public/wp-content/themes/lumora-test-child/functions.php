<?php
/**
 * Lumora Test Child theme setup, second concept (cinematic contemporary).
 *
 * @package LumoraTestChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOVA_CHILD_VERSION', '1.1.4' );

/**
 * Enqueue parent + child styles, brand stylesheet and Google Fonts.
 *
 * Fonts (no plugin):
 * - Space Grotesk (display)
 * - Inter (body / navigation)
 */
function nova_child_enqueue_assets() {
	wp_enqueue_style(
		'hello-elementor',
		get_template_directory_uri() . '/assets/css/reset.css',
		[],
		'3.5.1'
	);

	wp_enqueue_style(
		'hello-elementor-theme-style',
		get_template_directory_uri() . '/assets/css/theme.css',
		[ 'hello-elementor' ],
		'3.5.1'
	);

	wp_enqueue_style(
		'nova-child-style',
		get_stylesheet_uri(),
		[ 'hello-elementor-theme-style' ],
		NOVA_CHILD_VERSION
	);

	wp_enqueue_style(
		'nova-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'nova-brand',
		get_stylesheet_directory_uri() . '/assets/css/nova.css',
		[ 'nova-child-style', 'nova-fonts' ],
		NOVA_CHILD_VERSION
	);

	wp_enqueue_script(
		'nova-slider',
		get_stylesheet_directory_uri() . '/assets/js/nova-slider.js',
		[],
		NOVA_CHILD_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nova_child_enqueue_assets', 20 );

/**
 * Preconnect to Google Fonts.
 */
function nova_child_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = 'https://fonts.gstatic.com';
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'nova_child_resource_hints', 10, 2 );

/**
 * Canvas pages bypass theme header/footer; in-page Elementor header/footer wins.
 */
function nova_child_hide_theme_header_footer( $display ) {
	if ( is_page_template( 'elementor_canvas' ) ) {
		return false;
	}
	return $display;
}
add_filter( 'hello_elementor_header_footer', 'nova_child_hide_theme_header_footer' );

/**
 * Live-Link-safe frontend asset URLs: rewrite same-site absolute URLs to
 * root-relative so Local Live Links resolve on any host.
 */
function nova_use_relative_frontend_urls() {
	if ( is_admin() ) {
		return false;
	}
	if ( is_feed() ) {
		return false;
	}
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return false;
	}
	return true;
}

function nova_maybe_relative_url( $url ) {
	if ( ! is_string( $url ) || '' === $url || '/' === $url[0] ) {
		return $url;
	}
	$url_host = wp_parse_url( $url, PHP_URL_HOST );
	if ( ! $url_host ) {
		return $url;
	}
	$home_host   = wp_parse_url( home_url(), PHP_URL_HOST );
	$local_hosts = array_filter( [ $home_host, 'localhost', 'lumora-test.local' ] );
	$match       = false;
	foreach ( $local_hosts as $host ) {
		if ( 0 === strcasecmp( (string) $url_host, (string) $host ) ) {
			$match = true;
			break;
		}
	}
	if ( ! $match ) {
		return $url;
	}
	$path     = wp_parse_url( $url, PHP_URL_PATH );
	$query    = wp_parse_url( $url, PHP_URL_QUERY );
	$fragment = wp_parse_url( $url, PHP_URL_FRAGMENT );
	if ( ! $path ) {
		return $url;
	}
	$relative = $path;
	if ( $query ) {
		$relative .= '?' . $query;
	}
	if ( $fragment ) {
		$relative .= '#' . $fragment;
	}
	return $relative;
}

function nova_relative_attachment_image_src( $image, $attachment_id, $size, $icon ) {
	if ( ! nova_use_relative_frontend_urls() || ! is_array( $image ) || empty( $image[0] ) ) {
		return $image;
	}
	$image[0] = nova_maybe_relative_url( $image[0] );
	return $image;
}
add_filter( 'wp_get_attachment_image_src', 'nova_relative_attachment_image_src', 10, 4 );

function nova_relative_image_srcset( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {
	if ( ! nova_use_relative_frontend_urls() || ! is_array( $sources ) ) {
		return $sources;
	}
	foreach ( $sources as $width => $source ) {
		if ( isset( $source['url'] ) ) {
			$sources[ $width ]['url'] = nova_maybe_relative_url( $source['url'] );
		}
	}
	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'nova_relative_image_srcset', 10, 5 );

function nova_relative_loader_src( $src, $handle ) {
	if ( ! nova_use_relative_frontend_urls() || ! is_string( $src ) ) {
		return $src;
	}
	return nova_maybe_relative_url( $src );
}
add_filter( 'script_loader_src', 'nova_relative_loader_src', 10, 2 );
add_filter( 'style_loader_src', 'nova_relative_loader_src', 10, 2 );
