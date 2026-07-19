#!/usr/bin/env bash

set -euo pipefail

site_url="${1:-http://orbit.local/}"
page="$(curl -fsSL "$site_url")"
expected_title='<title>Perihelion — More time with the friends you already have</title>'
expected_description='Make casual plans with the friends you already have, without feeds, group-chat pressure, or another attention trap.'

if ! rg -Fq "$expected_title" <<< "$page"; then
	printf 'Unexpected homepage title at %s\n' "$site_url" >&2
	exit 1
fi

assert_one() {
	local marker="$1"
	local label="$2"
	local count

	count="$(rg -Fo "$marker" <<< "$page" | wc -l | tr -d ' ')"
	if [ "$count" -ne 1 ]; then
		printf 'Expected one %s at %s; found %s.\n' "$label" "$site_url" "$count" >&2
		exit 1
	fi
}

assert_one '<meta name="description"' 'meta description'
assert_one '<meta property="og:title"' 'Open Graph title'
assert_one '<meta property="og:description"' 'Open Graph description'
assert_one '<meta property="og:url"' 'Open Graph URL'
assert_one '<meta property="og:type"' 'Open Graph type'

if ! rg -Fq "<meta name=\"description\" content=\"$expected_description\"" <<< "$page"; then
	printf 'Unexpected meta description at %s\n' "$site_url" >&2
	exit 1
fi

if ! rg -Fq '<meta property="og:title" content="Perihelion — More time with the friends you already have"' <<< "$page"; then
	printf 'Unexpected Open Graph title at %s\n' "$site_url" >&2
	exit 1
fi

if ! rg -Fq "<meta property=\"og:description\" content=\"$expected_description\"" <<< "$page"; then
	printf 'Unexpected Open Graph description at %s\n' "$site_url" >&2
	exit 1
fi

printf 'Rendered metadata checks passed for %s\n' "$site_url"
