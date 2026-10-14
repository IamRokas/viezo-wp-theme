# Development

## Setup

```bash
nvm use        # Node 22
npm install
```

## Commands

| Command | What it does |
|---|---|
| `npm run dev` | Starts the Vite dev server at `https://localhost:5173` with hot reloading for CSS/JS. Saving a PHP file does a full page reload. |
| `npm run watch` | Rebuilds `build/` on every change, without a dev server. Use it if HMR isn't wanted. |
| `npm run build` | Production build into `build/` (minified). **Run this before committing/deploying.** |
| `npm run zip` | Build, then package the theme for a manual upload into `dist/viezo-YYYYMMDD-HHMM.zip` (runtime files only, ~9 MB). The zip's top folder `viezo/` matches the theme's folder on production, so Appearance → Themes → Add New → Upload → "Replace current with uploaded" updates the right theme. Other folder: `THEME_FOLDER=name npm run zip`. Refuses to run while `build/hot` exists. |

### First-time dev server setup

The local site runs on HTTPS (`https://viezo.local`), so the dev server uses a self-signed certificate. Open `https://localhost:5173` once in the browser and accept the certificate. Otherwise the site loads without styles while `npm run dev` is running.

If the local domain changes, update `server.cors` in `vite.config.js`.

## How assets reach WordPress (`inc/scripts.php`)

- **Production:** enqueues `build/main.css` and `build/index.js`. The version query string is the file's modification time, so caches bust automatically after each build, and the `<link rel="preload">` URLs always match the real ones.
- **Dev:** while `npm run dev` is running, Vite writes `build/hot` containing the dev server URL. When that file exists, PHP loads `@vite/client` and `src/index.js` as ES modules from the dev server instead, and CSS is injected by JS. The file is removed when the dev server stops (it's git-ignored).

> If the site suddenly has no styles, a stale `build/hot` was probably left behind by a crashed dev server. Delete it.

## Build output

`vite.config.js` produces fixed file names (no hashes) because PHP references them directly:

```
build/
├── index.js          IIFE bundle (all JS, incl. embla-carousel)
├── main.css          Tailwind + SCSS
├── fonts/            Fonts referenced from CSS
└── images/           Copy of src/images (PHP templates reference build/images/…)
```

- SVGs referenced from CSS are inlined as data URIs, and other images are emitted to `build/images/`.
- In SCSS, reference assets through the aliases `url(@images/…)` and `url(@fonts/…)`, not `../images/`. Vite resolves relative URLs from the partial's own folder, so a relative path breaks in nested partials.
- `build/` is committed so the server doesn't need Node.

## Tailwind

Tailwind 3 runs as a PostCSS plugin (`postcss.config.cjs`) and scans `./**/*.php` and `src/js/**/*.js` for classes (`tailwind.config.cjs`). Custom screens: `phone`, `md`, `tablet-landscape`, `desktop`, … (see config). Use `.container` / `.big-container` for page widths.

## JavaScript

`src/js/index.js` imports four groups, each with its own `index.js`:

- `global/`: runs everywhere (js-enabled class, navbar, embla sliders)
- `template-tags/`: menus, modal, off-canvas, tables, video
- `templates/`: page-specific (Powerail scroll animation)
- `blocks/`: block-specific (video block)

No jQuery or `wp.*` globals are used. GSAP (About Us page) and Google Maps (Contacts) are loaded from CDNs inside those templates.
