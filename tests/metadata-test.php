<?php
/**
 * Lightweight regression checks for public metadata ownership.
 *
 * Run with: php tests/metadata-test.php
 */

define( 'ABSPATH', __DIR__ );

$test_actions = array();
$test_filters = array();
$test_front   = true;
$test_page    = '';
$test_emit    = true;

function add_action( $hook, $callback, $priority = 10 ) {
	global $test_actions;
	$test_actions[ $hook ][ $priority ][] = $callback;
}

function add_filter( $hook, $callback, $priority = 10 ) {
	global $test_filters;
	$test_filters[ $hook ][ $priority ][] = $callback;
}

function __( $text ) {
	return $text;
}

function is_front_page() {
	global $test_front;
	return $test_front;
}

function is_page( $slug ) {
	global $test_page;
	return $slug === $test_page;
}

function apply_filters( $hook, $value ) {
	global $test_emit;
	return 'perihelion_emit_public_metadata' === $hook ? $test_emit : $value;
}

function esc_attr( $value ) {
	return htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' );
}

function esc_url( $value ) {
	return $value;
}

function wp_get_document_title() {
	return perihelion_public_title();
}

function is_singular() {
	return true;
}

function get_permalink() {
	return 'https://example.test/';
}

function home_url( $path = '' ) {
	return 'https://example.test' . $path;
}

require dirname( __DIR__ ) . '/functions.php';

function test_assert_same( $expected, $actual, $message ) {
	if ( $expected !== $actual ) {
		fwrite( STDERR, $message . "\nExpected: " . var_export( $expected, true ) . "\nActual: " . var_export( $actual, true ) . "\n" );
		exit( 1 );
	}
}

function test_callback( $registry, $hook, $priority = 10 ) {
	if ( empty( $registry[ $hook ][ $priority ][0] ) ) {
		fwrite( STDERR, "Missing callback for {$hook} at priority {$priority}.\n" );
		exit( 1 );
	}
	return $registry[ $hook ][ $priority ][0];
}

$title       = 'Perihelion — More time with the friends you already have';
$description = 'Make casual plans with the friends you already have, without feeds, group-chat pressure, or another attention trap.';

test_assert_same( $title, test_callback( $test_filters, 'wpseo_title' )( 'Perihelion -' ), 'Yoast homepage title was not replaced.' );
test_assert_same( $title, test_callback( $test_filters, 'wpseo_opengraph_title' )( 'Perihelion' ), 'Yoast Open Graph title was not replaced.' );
test_assert_same( $description, test_callback( $test_filters, 'wpseo_metadesc' )( '' ), 'Yoast description was not populated.' );
test_assert_same( $description, test_callback( $test_filters, 'wpseo_opengraph_desc' )( '' ), 'Yoast Open Graph description was not populated.' );

$test_front = false;
test_assert_same( 'Existing title', test_callback( $test_filters, 'wpseo_title' )( 'Existing title' ), 'A non-public title was unexpectedly replaced.' );
test_assert_same( 'Existing description', test_callback( $test_filters, 'wpseo_metadesc' )( 'Existing description' ), 'A non-public description was unexpectedly replaced.' );

$test_front = true;
ob_start();
test_callback( $test_actions, 'wp_head', 2 )();
$fallback = ob_get_clean();
test_assert_same( 1, substr_count( $fallback, '<meta name="description"' ), 'Fallback description should be emitted once.' );
test_assert_same( 1, substr_count( $fallback, '<meta property="og:title"' ), 'Fallback Open Graph title should be emitted once.' );

$test_emit = false;
ob_start();
test_callback( $test_actions, 'wp_head', 2 )();
test_assert_same( '', ob_get_clean(), 'The metadata opt-out did not suppress fallback tags.' );

$test_emit = true;
define( 'WPSEO_VERSION', 'test' );
ob_start();
test_callback( $test_actions, 'wp_head', 2 )();
test_assert_same( '', ob_get_clean(), 'Theme fallback tags were emitted while Yoast owned metadata.' );

fwrite( STDOUT, "Metadata regression checks passed.\n" );
