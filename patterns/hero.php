<?php
/**
 * Title: Hero
 * Slug: perihelion/hero
 * Categories: perihelion-marketing, featured
 * Description: Front-page hero with wordmark-style display heading, italic tagline, one-sentence description, and primary CTA.
 * Keywords: hero, landing
 * Block Types: core/group
 */
?>
<!-- wp:group {"align":"wide","className":"perihelion-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide perihelion-hero" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

	<!-- wp:html -->
	<div class="perihelion-orbit" aria-hidden="true"><span></span><span></span><span></span></div>
	<!-- /wp:html -->

	<!-- wp:heading {"level":1,"fontSize":"display","style":{"typography":{"letterSpacing":"-0.02em","lineHeight":"1"}}} -->
	<h1 class="wp-block-heading has-display-font-size" style="letter-spacing:-0.02em;line-height:1">Perihelion</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"lead","style":{"typography":{"fontStyle":"italic","fontFamily":"var:preset|font-family|heading","lineHeight":"1.4"},"color":{"text":"var:preset|color|slate"}}} -->
	<p class="has-text-color has-lead-font-size" style="color:var(--wp--preset--color--slate);font-family:var(--wp--preset--font-family--heading);font-style:italic;line-height:1.4"><?php echo esc_html__( 'More time with the friends you already have', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"fontSize":"lead","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
	<p class="has-lead-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php echo esc_html__( 'Share the things you want to do with friends who have chosen to hear from you. Post a Saturday hike, a casual dinner, or a half-formed idea. They reply if they want; saying nothing is always fine.', 'perihelion' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
		<?php echo do_shortcode( '[orbit_cta]' ); ?>
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
