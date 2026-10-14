# Assets

## Images (`src/images/`)

The whole folder is copied to `build/images/` on build. From PHP, reference the built copy:

```php
<img src="<?= get_template_directory_uri(); ?>/build/images/logo.svg" alt="Viezo">
```

From SCSS use the alias (it gets inlined or emitted automatically):

```scss
background-image: url(@images/video-bg-5.jpg);
```

Keep this folder lean. Everything in it ships to production, so delete files that are no longer referenced. Content images belong in the Media Library, not here.

Favicons live in `src/images/favicons/` and are linked from `header.php`.

## Icons (`src/images/icons/`) and the `sprite()` mixin

Every SVG in `icons/` is converted into a data URI by `scripts/vite-svg-sprites.js`, which writes **`src/scss/sprites.scss`** (generated, don't edit). This runs on every build and whenever an icon changes in dev.

Use the icons in SCSS with the mixin from `src/scss/global/_sprites-mixin.scss`:

```scss
.icon-phone {
	@include sprite('LocalPhone', (), 'box');          // background + width/height from the SVG
}

.icon-facebook:hover {
	@include sprite('facebook', ('color': '#4267B2'), 'box');  // override a colour variable
}
```

Arguments: `sprite($name, $variables: (), $include-size: false | true | 'box', $property: 'background')`.

- `true` sets `background-size`, and `'box'` sets `width`/`height`.
- Only icons you actually `@include` end up in the CSS.

### Recolourable icons

To make an attribute overridable, write it in the SVG as `var:{name}.{attribute}="{default}"`:

```svg
<path d="…" var:color.fill="#1661AB"/>
```

The generator turns it into `fill="___color___"` and records `#1661AB` as the default in `$variables`. Pass `('color': '#…')` to override it.

## Fonts (`src/fonts/`)

Declared in `src/scss/tailwind.scss` (`@font-face`) and emitted to `build/fonts/`:

- **OSP-DIN**: headings (`font-osp-din`)
- **Saira Extra Condensed** 400/600

Hiragino Sans is referenced with `local()` only (system font on Apple devices). No font files are shipped for it.

## Animation frames (`anim-assets/`)

PNG frames and a spritesheet used by the Powerail/Sonora timeline templates. They're referenced directly by URL, not processed by Vite.
