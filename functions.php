<?php
/**
 * Perihelion theme bootstrap.
 *
 * Kept intentionally minimal. theme.json owns all design tokens, color
 * palette, typography, spacing, and most block-level styles. This file
 * only handles things that theme.json cannot express.
 *
 * @package Perihelion
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the pattern category used by Perihelion's bundled patterns.
 *
 * Patterns themselves live as PHP files in patterns/ and are auto-discovered
 * by WordPress. They reference this category via their pattern header.
 */
add_action( 'init', function () {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'perihelion-marketing',
		array(
			'label'       => __( 'Perihelion — Marketing', 'perihelion' ),
			'description' => __( 'Patterns used on the public marketing surface (home, about, etc.).', 'perihelion' ),
		)
	);
} );

/**
 * Enqueue Google Fonts.
 *
 * Loaded via Google's CSS API URL rather than theme.json's fontFace
 * declarations because the canonical woff2 URLs change with each
 * Fraunces/Inter version and hard-coding them is fragile. The CSS API
 * resolves to the right woff2 files automatically.
 *
 * Uses preconnect hints to shave the initial DNS lookup off the load,
 * and font-display: swap so text remains visible during fetch.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'perihelion-google-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..700;1,9..144,400..600&family=Inter:wght@400..600&display=swap',
		array(),
		null
	);
}, 5 );

add_action( 'wp_head', function () {
	echo "\n" . '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );

/**
 * Enqueue the theme's custom stylesheet.
 *
 * style.css holds only the theme metadata header; all actual styles live
 * either in theme.json (for what it can express) or in assets/css/custom.css
 * (for what it can't — the cream-paper noise overlay, focus-visible
 * outlines, the numbered step circles, the eyebrow style, etc.).
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'perihelion-custom',
		get_theme_file_uri( 'assets/css/custom.css' ),
		array( 'perihelion-google-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
} );

/**
 * Register the eyebrow paragraph style and footer-links list style.
 *
 * Block styles are picked up by the editor and frontend; the actual
 * declarations live in custom.css.
 */
add_action( 'init', function () {
	if ( ! function_exists( 'register_block_style' ) ) {
		return;
	}

	register_block_style(
		'core/paragraph',
		array(
			'name'         => 'eyebrow',
			'label'        => __( 'Eyebrow', 'perihelion' ),
			'inline_style' => '',
		)
	);

	register_block_style(
		'core/list',
		array(
			'name'         => 'footer-links',
			'label'        => __( 'Footer links', 'perihelion' ),
			'inline_style' => '',
		)
	);

	register_block_style(
		'core/list',
		array(
			'name'         => 'app-nav',
			'label'        => __( 'App nav', 'perihelion' ),
			'inline_style' => '',
		)
	);
} );

/**
 * Style the WordPress login screen to match the brand.
 *
 * Per the content-architecture spec: WP core handles auth; the theme
 * provides custom CSS via login_enqueue_scripts. No template replacement.
 */
add_action( 'login_enqueue_scripts', function () {
	wp_enqueue_style(
		'perihelion-login',
		get_theme_file_uri( 'assets/css/login.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
} );

/**
 * Filter the login logo URL so it points at the site root rather than
 * wordpress.org.
 */
add_filter( 'login_headerurl', function () {
	return home_url( '/' );
} );

/**
 * Filter the login logo title text.
 */
add_filter( 'login_headertext', function () {
	return get_bloginfo( 'name' );
} );
