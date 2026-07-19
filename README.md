# Perihelion Theme

WordPress FSE block theme for **Perihelion** — a friend-coordination tool that helps you spend more time with the friends you already have, without the friction.

Pairs with the [Orbit plugin](https://github.com/makyrie/orbit), which provides the underlying app surface (subscriptions, activities, RSVPs, notifications). This theme is the marketing site and the chrome around the app's logged-in screens.

## Content ownership

The theme owns the homepage composition, anonymous navigation, visual system, and public-page metadata. The Orbit plugin owns the database-backed Sign Up, Why, Contact, Privacy, and Terms page bodies. Deploy Orbit before this theme when a release introduces new canonical pages.

Editor changes to those surfaces are not authoritative and may be replaced on the next release. The marketing header and footer are also code-owned: a theme version change removes Site Editor overrides for those two template parts so reviewed navigation is published. Other template-part customizations are untouched.

The theme emits descriptions and Open Graph metadata for its public surfaces. An SEO integration that owns those tags can disable the theme output with the `perihelion_emit_public_metadata` filter. See the [plugin documentation](https://github.com/makyrie/orbit/tree/main/docs) for the brand, content, compliance, and release architecture.
