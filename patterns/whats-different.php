<?php
/**
 * Title: What's different
 * Slug: perihelion/whats-different
 * Categories: perihelion-marketing
 * Description: Three short sections explaining bring-your-own-friends, anti-extractive, and the three commitment tiers as differentiators.
 * Keywords: differentiator, why
 * Block Types: core/group
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow","style":{"color":{"text":"var:preset|color|slate"}}} -->
		<p class="is-style-eyebrow has-text-color" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'Why this is different', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"h2"} -->
		<h2 class="wp-block-heading has-h-2-font-size"><?php echo esc_html__( 'Not another social network.', 'perihelion' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Bring your own friends', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'Perihelion isn\'t for finding new friends from scratch. It\'s for spending more time with the people you\'ve already met. If you want a friend-finder, this isn\'t it.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Built to be left', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'There\'s no feed to scroll. No notifications begging you to come back. No engagement metrics to chase. The whole point is to put a plan together and then go do it offline.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Saying no is easy', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'Three commitment tiers — "just an idea," "I\'ll go if you will," "I\'m going — join me" — let casual hangs travel as casually as the invitation suggests. Declining is the default. Saying yes means yes; saying nothing is fine.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
