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
 * Enqueue the app-nav active-state JS shim.
 *
 * `core/list` doesn't add `current-menu-item` to its descendants the way
 * `core/navigation` would, so this small script walks the rendered
 * `.is-style-app-nav` list and marks the link whose href matches the
 * current pathname. Loaded only for logged-in users (the only audience
 * who sees the app nav).
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_user_logged_in() ) {
		return;
	}

	wp_enqueue_script(
		'perihelion-app-nav',
		get_theme_file_uri( 'assets/js/app-nav.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
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
			'name'         => 'footer-links-inline',
			'label'        => __( 'Inline Footer Links', 'perihelion' ),
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

/**
 * Give public pages useful search titles and descriptions without requiring
 * an SEO plugin or mutable editor metadata.
 */
function perihelion_public_description() {
	if ( is_front_page() ) {
		return __( 'Make casual plans with the friends you already have, without feeds, group-chat pressure, or another attention trap.', 'perihelion' );
	}

	$descriptions = array(
		'why'     => __( 'Why Perihelion makes invitations easier for organizers and invited friends.', 'perihelion' ),
		'contact' => __( 'Contact Sarah Lewis about Perihelion accounts, privacy, notifications, or technical issues.', 'perihelion' ),
		'privacy' => __( 'How Perihelion collects, uses, protects, and retains account, notification, and consent information.', 'perihelion' ),
		'terms'   => __( 'The terms for using Perihelion and its email and notification services.', 'perihelion' ),
		'sign-up' => __( 'Create a Perihelion account and start sharing plans with friends you already know.', 'perihelion' ),
	);

	foreach ( $descriptions as $slug => $description ) {
		if ( is_page( $slug ) ) {
			return $description;
		}
	}

	return '';
}

/**
 * Return the code-owned homepage title.
 *
 * @return string
 */
function perihelion_public_title() {
	return __( 'Perihelion — More time with the friends you already have', 'perihelion' );
}

add_filter( 'document_title_parts', function ( $parts ) {
	if ( is_front_page() ) {
		$parts['title'] = perihelion_public_title();
		unset( $parts['tagline'] );
	}
	return $parts;
} );

/**
 * Give Yoast the same code-owned metadata used by the theme fallback.
 *
 * Yoast short-circuits WordPress's document title and owns the social tags
 * when active, so filtering its presentation prevents stale settings from
 * replacing the reviewed public copy.
 */
add_filter( 'wpseo_title', function ( $title ) {
	return is_front_page() ? perihelion_public_title() : $title;
} );

add_filter( 'wpseo_opengraph_title', function ( $title ) {
	return is_front_page() ? perihelion_public_title() : $title;
} );

add_filter( 'wpseo_metadesc', function ( $description ) {
	$public_description = perihelion_public_description();
	return $public_description ? $public_description : $description;
} );

add_filter( 'wpseo_opengraph_desc', function ( $description ) {
	$public_description = perihelion_public_description();
	return $public_description ? $public_description : $description;
} );

add_action( 'wp_head', function () {
	$description = perihelion_public_description();
	if ( defined( 'WPSEO_VERSION' ) || ! $description || ! apply_filters( 'perihelion_emit_public_metadata', true ) ) {
		return;
	}
	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	$canonical_url = is_singular() ? get_permalink() : home_url( '/' );
	echo '<meta property="og:url" content="' . esc_url( $canonical_url ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
}, 2 );

/**
 * Keep code-owned marketing template parts authoritative across theme releases.
 *
 * Saving a template part in the Site Editor creates a database override that
 * otherwise shadows the reviewed file forever. On a new theme version, remove
 * overrides only for the marketing header/footer that this theme explicitly
 * owns; application template parts and unrelated customizations are untouched.
 */
function perihelion_reconcile_code_owned_template_parts() {
	$version = wp_get_theme()->get( 'Version' );
	if ( $version === get_option( 'perihelion_code_owned_template_parts_version' ) ) {
		return;
	}

	$templates = get_block_templates(
		array( 'slug__in' => array( 'header-marketing', 'footer-marketing' ) ),
		'wp_template_part'
	);
	$succeeded = true;

	foreach ( $templates as $template ) {
		if ( 'custom' !== $template->source || ! in_array( $template->slug, array( 'header-marketing', 'footer-marketing' ), true ) ) {
			continue;
		}

		if ( ! $template->wp_id || ! wp_delete_post( $template->wp_id, true ) ) {
			$succeeded = false;
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( sprintf( 'Perihelion: could not remove the stale code-owned template-part override for %s.', $template->slug ) );
		}
	}

	if ( $succeeded ) {
		update_option( 'perihelion_code_owned_template_parts_version', $version, false );
	}
}
add_action( 'init', 'perihelion_reconcile_code_owned_template_parts', 20 );

/**
 * Hide capability-gated nav items in `header-app.html` from users who
 * can't reach the destination they point at.
 *
 * The header-app template renders for everyone — including anonymous
 * visitors on `/@slug/` and `/activity/{id}` virtual pages — so the
 * nav must hide items those visitors can't actually use:
 *
 *  - `is-authenticated-only` — Dashboard, Subscriptions, Settings.
 *    Hidden from logged-out visitors. Clicking them otherwise just
 *    bounces to login, which is friction without value.
 *
 *  - `is-poster-only` — Manage, New Activity, Subscribers, Profile.
 *    Hidden from anyone without the `orbit_create_activity` capability
 *    (which includes anonymous visitors as well as subscriber-role
 *    accounts).
 *
 * The Log in / Log out toggle is rendered by core/loginout and flips
 * automatically based on auth state — no class needed.
 *
 * Plugin dependency: the `is-poster-only` branch relies on the
 * `orbit_create_activity` capability, which is registered by the orbit
 * plugin. When the plugin is deactivated `current_user_can()` returns
 * false for everyone and the poster-only items hide silently — that's
 * acceptable graceful degradation, not a bug.
 *
 * Filter scope: only `core/list-item` is filtered — these classNames
 * on a `core/paragraph` or `core/group` would not be stripped.
 *
 * Editor preview: short-circuited during REST requests so a non-poster
 * admin editing `parts/header-app.html` in the Site Editor sees the
 * full nav structure (no items hidden by role). The front-end render
 * path is unchanged.
 *
 * @param string $block_content The block's rendered HTML.
 * @param array  $block         The parsed block, including attrs.
 * @return string Empty string to hide the item, or the original content.
 */
function perihelion_filter_app_nav_list_item( $block_content, $block ) {
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return $block_content;
	}

	$class_name = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';
	$classes    = $class_name ? preg_split( '/\s+/', $class_name ) : array();

	if ( in_array( 'is-authenticated-only', $classes, true ) && ! is_user_logged_in() ) {
		return '';
	}

	if ( in_array( 'is-poster-only', $classes, true ) && ! current_user_can( 'orbit_create_activity' ) ) {
		return '';
	}

	return $block_content;
}
add_filter( 'render_block_core/list-item', 'perihelion_filter_app_nav_list_item', 10, 2 );

/**
 * Hide signup/login affordances once the visitor is authenticated.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block attributes.
 * @return string
 */
function perihelion_filter_anonymous_only_block( $block_content, $block ) {
	if ( ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ! is_user_logged_in() ) {
		return $block_content;
	}

	$class_name = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';
	$classes    = $class_name ? preg_split( '/\s+/', $class_name ) : array();

	return in_array( 'is-anonymous-only', $classes, true ) ? '' : $block_content;
}

foreach ( array( 'list-item', 'navigation-link', 'paragraph' ) as $perihelion_block_name ) {
	add_filter( 'render_block_core/' . $perihelion_block_name, 'perihelion_filter_anonymous_only_block', 20, 2 );
}
