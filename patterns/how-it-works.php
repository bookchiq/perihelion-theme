<?php
/**
 * Title: How it works
 * Slug: perihelion/how-it-works
 * Categories: perihelion-marketing
 * Description: Three numbered steps explaining the subscribe → post → respond flow.
 * Keywords: how, steps, explainer
 * Block Types: core/group
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow","style":{"color":{"text":"var:preset|color|slate"}}} -->
		<p class="is-style-eyebrow has-text-color" style="color:var(--wp--preset--color--slate)"><?php echo esc_html__( 'How it works', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"h2"} -->
		<h2 class="wp-block-heading has-h-2-font-size"><?php echo esc_html__( 'Three small steps.', 'perihelion' ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"perihelion-step","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group perihelion-step">
		<!-- wp:paragraph {"className":"perihelion-step__number","style":{"color":{"background":"var:preset|color|sienna","text":"var:preset|color|paper"}}} -->
		<p class="perihelion-step__number has-text-color has-background" style="background-color:var(--wp--preset--color--sienna);color:var(--wp--preset--color--paper)">1</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Subscribe to people you want to hear from', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'When someone shares their Perihelion link with you, you can opt in to hearing about the kinds of things they post. They approve you, you\'re in.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"perihelion-step","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group perihelion-step">
		<!-- wp:paragraph {"className":"perihelion-step__number","style":{"color":{"background":"var:preset|color|sienna","text":"var:preset|color|paper"}}} -->
		<p class="perihelion-step__number has-text-color has-background" style="background-color:var(--wp--preset--color--sienna);color:var(--wp--preset--color--paper)">2</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Post things you\'re doing', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'Share an activity at one of three commitment levels: "just an idea," "I\'ll go if you will," or "I\'m going — join me." Your subscribers see it, no group-text required.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"perihelion-step","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group perihelion-step">
		<!-- wp:paragraph {"className":"perihelion-step__number","style":{"color":{"background":"var:preset|color|sienna","text":"var:preset|color|paper"}}} -->
		<p class="perihelion-step__number has-text-color has-background" style="background-color:var(--wp--preset--color--sienna);color:var(--wp--preset--color--paper)">3</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3,"fontSize":"h3"} -->
		<h3 class="wp-block-heading has-h-3-font-size"><?php echo esc_html__( 'Go do the thing', 'perihelion' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'People who want to come tap "I\'m in" or "Maybe." Anyone who doesn\'t reply doesn\'t reply. You close the tab and go meet up.', 'perihelion' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
