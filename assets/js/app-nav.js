/**
 * Perihelion — app-nav active state.
 *
 * The `core/list` block doesn't add `current-menu-item` class to its
 * descendants the way `core/navigation` would, so the CSS hover/active
 * styling has nothing to match on the current page. This script walks
 * the `.is-style-app-nav` list, finds the link whose href matches the
 * current pathname, and adds `current-menu-item` to its parent `<li>`.
 *
 * Runs on every page that the script is enqueued for; cheap and
 * idempotent. ~15 lines of work, no framework, no dependencies.
 */
( function () {
	'use strict';

	function markActive() {
		var nav = document.querySelector( '.is-style-app-nav' );
		if ( ! nav ) {
			return;
		}

		// Normalize the current pathname to drop trailing slashes for
		// comparison, except keep the root "/" intact.
		var here = window.location.pathname.replace( /\/+$/, '' ) || '/';

		var items = nav.querySelectorAll( 'li' );
		for ( var i = 0; i < items.length; i++ ) {
			var link = items[ i ].querySelector( 'a[href]' );
			if ( ! link ) {
				continue;
			}

			// Skip absolute external links — only match same-origin paths.
			var url;
			try {
				url = new URL( link.href, window.location.origin );
			} catch ( e ) {
				continue;
			}

			if ( url.origin !== window.location.origin ) {
				continue;
			}

			var linkPath = url.pathname.replace( /\/+$/, '' ) || '/';
			if ( linkPath === here ) {
				items[ i ].classList.add( 'current-menu-item' );
				break;
			}
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', markActive );
	} else {
		markActive();
	}
} )();
