<?php
/**
 * Title: Audience mirror
 * Slug: perihelion/audience-mirror
 * Categories: perihelion-marketing
 * Description: Section that names the audience by behavior so they self-identify ("if you're the friend who plans things…").
 * Keywords: audience, who, persona
 * Block Types: core/group
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

	<!-- wp:paragraph {"className":"is-style-eyebrow","style":{"color":{"text":"var:preset|color|slate"}}} -->
	<p class="is-style-eyebrow has-text-color" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'Who this is for', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"fontSize":"h1"} -->
	<h2 class="wp-block-heading has-h-1-font-size"><?php echo esc_html__( 'If you\'re the friend who plans things.', 'perihelion' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"lead","style":{"color":{"text":"var:preset|color|slate"}}} -->
	<p class="has-text-color has-lead-font-size" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'You know the dynamic. You do most of the inviting, your friends are happy when they show up, but reaching out feels heavier the more times you\'ve done it. Perihelion takes the social tax off the ask: invitees opt in once, and any future "I\'m doing X, who wants to come?" reaches them quietly. They reply if they want; nothing if they don\'t. No group-text awkwardness, no one-on-one pressure.', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
