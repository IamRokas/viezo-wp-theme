#!/bin/sh
# Package the theme for a manual production upload (Appearance → Themes → Add New → Upload,
# "Replace current with uploaded"). Run via `npm run zip`, which builds assets first.
#
# Output: dist/<folder>-YYYYMMDD-HHMM.zip whose top-level folder must match the theme's folder name
# ON THE SERVER, so "Replace current with uploaded" updates the active theme. Production uses
# viezo (the default); override with THEME_FOLDER=name npm run zip.
# Left out: dev-only files (node_modules, src, docs, editor/lint config) and build/hot, which
# would make production load assets from the local Vite dev server.

set -e

THEME_DIR="$(cd "$(dirname "$0")/.." && pwd)"
THEME_NAME="$(basename "$THEME_DIR")"
TARGET="${THEME_FOLDER:-viezo}"
STAMP="$(date +%Y%m%d-%H%M)"
OUT="$THEME_DIR/dist/$TARGET-$STAMP.zip"

if [ -f "$THEME_DIR/build/hot" ]; then
	echo "build/hot exists (Vite dev server running?). Stop it and run 'npm run build' first." >&2
	exit 1
fi

mkdir -p "$THEME_DIR/dist"

# Stage under the target folder name (a symlink, so nothing is copied).
STAGE="$(mktemp -d)"
trap 'rm -rf "$STAGE"' EXIT
ln -s "$THEME_DIR" "$STAGE/$TARGET"
cd "$STAGE"
THEME_NAME="$TARGET"

zip -rq "$OUT" "$THEME_NAME/" \
	-x "$THEME_NAME/node_modules/*" \
	-x "$THEME_NAME/dist/*" \
	-x "$THEME_NAME/src/*" \
	-x "$THEME_NAME/docs/*" \
	-x "$THEME_NAME/scripts/*" \
	-x "$THEME_NAME/.git/*" \
	-x "$THEME_NAME/.github/*" \
	-x "$THEME_NAME/.vscode/*" \
	-x "$THEME_NAME/build/hot" \
	-x "$THEME_NAME/.*" \
	-x "*.DS_Store" \
	-x "$THEME_NAME/package.json" \
	-x "$THEME_NAME/package-lock.json" \
	-x "$THEME_NAME/vite.config.js" \
	-x "$THEME_NAME/tailwind.config.cjs" \
	-x "$THEME_NAME/postcss.config.cjs"

echo "Created $OUT ($(du -h "$OUT" | cut -f1)), top folder: $TARGET/"
