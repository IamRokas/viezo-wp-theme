# Content seeds

Seeds fill in content in code, so it can be recreated after a migration or on a fresh environment. For example, the distributor list on the Contacts page.

Run them from **Tools → Viezo seeds** (administrators only). The page lists every seed, when it last ran and who ran it, and has a **Run** / **Run again** button.

- Seeds **only fill empty fields**, so re-running never overwrites edits made in the admin. To reseed a field, empty it first.
- Images are written straight into the uploads folder. If that fails (e.g. folder not writable on the server), the seed finishes anyway and shows the reason as a warning.
- Seeds never run automatically.
- The run log is stored in the `vzo__seeds_log` option.

## Available seeds

| ID | What it does |
|---|---|
| `home-live-sonora` | Fills the **Live Sonora network** section on the English and Polish Home pages: texts, buttons, machine scene (imports `seeds/assets/home/machine-line.webp`; motor, gearbox with a fault, fan), machines linked to case studies (Polish translations of the case studies on the Polish page). If the photo can't be imported, the page uses the bundled default photo. **Only fills empty fields**; on the Polish page a value identical to English counts as empty. Photo/positions/values are written to the English page only. Safe to re-run |
| `contact-partners` | Fills empty **Distributors** / **OEM partners** fields on the English Contacts page, and adds logos from `seeds/assets/logos/` to rows that have none |
| `pricing-setup` | Creates the **Pricing setup offer (EN)** and **(PL)** WPForms forms, switches the Pricing page and its Polish translation to the **Pricing – Setup builder** template, points the header button at `#setup-builder`, and fills the setup builder fields (English defaults / Polish copy), including the confirmation email texts. It also makes sure the funnel log table exists. **Only fills empty fields**, and a Polish value identical to the English one counts as empty. Existing forms only get missing hidden fields. Safe to re-run; to reseed something, empty it first |

### SEO seeds

These change settings and server files rather than fill empty fields, so they overwrite what they set. They are idempotent: re-running gives the same result. Deploy steps: [seo-geo/releases/2026-10-14-simple-fixes.md](seo-geo/releases/2026-10-14-simple-fixes.md).

| ID | What it does |
|---|---|
| `seo-organization` | Sets Yoast → Site representation to the company **Viezo** with a 600×600 logo (`seeds/assets/seo/viezo-logo.png`), which Yoast requires before it outputs Organization schema |
| `seo-server` | Renames the physical `robots.txt` to `robots.txt.viezo-backup` so WordPress serves the theme's robots.txt, and writes a **Viezo compression** (gzip) block to `.htaccess`. Then fetches robots.txt, the home page and style.css and reports whether they are right and compressed |
| `seo-sonora-faq` | Adds an **FAQ** block (6 approved questions, English and Polish) before **Case studies** on every page using the Sonora template. Skips pages that already have an FAQ block, so re-running is safe; existing blocks are kept as stored |
| `seo-home-video` | Imports the compressed hero video (`seeds/assets/seo/home-hero-720.mp4`, 4.8 MB instead of 50 MB) and its poster, and sets them as the header background of the English and Polish home pages. The old video stays in the Media Library |

## Adding logos

Put the files in `seeds/assets/logos/` using the names in the seed file (`techvitas.png`, `ruven.png`, `sujan-industries.png`, `tgd-company.png`, `ima-schelling.png`). Then click **Run again**.

- Each file is imported into the Media Library once. The attachment is tagged with the `_vzo_seed_source` meta, so re-running reuses it instead of uploading a duplicate.
- Missing files are skipped, and the card then shows the company name instead of a logo.

## Writing a seed

Create `seeds/{id}.php` that returns an array:

```php
<?php
defined( 'ABSPATH' ) || exit;

return [
	'title'       => 'Home page: hero',
	'description' => 'Sets the hero title and image on the Home page.',
	'run'         => function () {
		$page_id = vzo__seed_find_page_by_template( 'templates/home.php' );

		if ( ! $page_id ) {
			throw new RuntimeException( 'No page uses the Home template.' );
		}

		update_field( 'hero_title', 'Predictive maintenance', $page_id );
		update_field( 'hero_image', vzo__seed_import_image( 'home/hero.jpg' ), $page_id );

		return 'Hero updated.'; // Shown in the admin notice.
	},
];
```

Helpers (in `inc/seeds.php`):

- `vzo__seed_find_page_by_template( $template )` returns the page ID using a template, in the default Polylang language.
- `vzo__seed_import_image( $path )` imports `seeds/assets/{$path}` (image or video) into the Media Library once and returns the attachment ID, or `0` if the file is missing.

Throwing an exception marks the run as failed and shows the message.
