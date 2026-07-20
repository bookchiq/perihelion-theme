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
<!-- wp:group {"align":"wide","className":"perihelion-audience","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide perihelion-audience" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

	<!-- wp:paragraph {"className":"is-style-eyebrow","style":{"color":{"text":"var:preset|color|slate"}}} -->
	<p class="is-style-eyebrow has-text-color" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'Who this is for', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"fontSize":"h1"} -->
	<h2 class="wp-block-heading has-h-1-font-size"><?php echo esc_html__( 'If you\'re the friend who plans things', 'perihelion' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"lead","style":{"color":{"text":"var:preset|color|slate"}}} -->
	<p class="has-text-color has-lead-font-size" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'You do most of the inviting, even when reaching out feels heavier each time. Perihelion takes the social tax off the ask: you share one personal link, approve the friends you know, and post when you have a plan. There is no public profile directory and no audience to build.', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"perihelion-invite-note","layout":{"type":"constrained"}} -->
	<div class="wp-block-group perihelion-invite-note">
		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'If a friend invited you', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'You choose whose plans you want and how often email should arrive — right away or in one quiet daily digest. The organizer approves the connection. Reply “I’m in” or “Maybe” when you want; silence is a complete answer. SMS is planned, but remains unavailable until it is approved and enabled responsibly.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
