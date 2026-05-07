<?php
/**
 * Title: Closing CTA
 * Slug: perihelion/closing-cta
 * Categories: perihelion-marketing, featured
 * Description: Full-bleed warmer-paper section with a one-line invitation and a primary CTA.
 * Keywords: cta, signup, ending
 * Block Types: core/group
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"color":{"background":"var:preset|color|paper-warm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-paper-warm-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50)">

	<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-group">

		<!-- wp:heading {"level":2,"textAlign":"center","fontSize":"h2"} -->
		<h2 class="wp-block-heading has-text-align-center has-h-2-font-size"><?php echo esc_html__( 'Ready to make plans?', 'perihelion' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"lead","style":{"color":{"text":"var:preset|color|slate"}}} -->
		<p class="has-text-align-center has-text-color has-lead-font-size" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'Set up a profile and start sharing what you\'re up to.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40)">
			<?php echo do_shortcode( '[orbit_cta]' ); ?>
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
