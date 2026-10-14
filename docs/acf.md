# ACF (Local JSON)

All ACF configuration (field groups, custom post types, taxonomies) is stored as JSON in `acf-json/` and committed to git. This is configured in `inc/acf.php`.

## Folder and file naming

Each ACF type has its own folder, and files are named after a readable slug instead of ACF's random key:

| Type | Folder | File name | Example |
|---|---|---|---|
| Field group | `acf-json/field-groups/` | slug of the group title | `blocks.json`, `viezo-theme-settings.json` |
| Post type | `acf-json/post-types/` | post type key | `case-study.json`, `partner.json` |
| Taxonomy | `acf-json/taxonomies/` | taxonomy key | `case-study-type.json` |
| Options page (UI) | `acf-json/options-pages/` | menu slug | none yet |

Once a file exists it keeps its name, even if the item is renamed in the admin (so no orphaned duplicates). If a rename should also rename the file, rename the file by hand. ACF finds items by the `key` inside the JSON, not by file name.

## Current field groups

| File | Used by |
|---|---|
| `blocks.json` | **Blocks** flexible content (`blocks` field): the page builder used by most templates |
| `home.json` | Home template |
| `home-live-sonora-network.json` | Home template: **Live Sonora network** section. Tabs: Content (texts, buttons), Live scene (image, card labels, measuring points with x/y position in % and an optional fault: fault values, issue, case study), Machines (linked to case studies) |
| `pricing-setup-builder.json` | Pricing – Setup builder template: all setup builder copy, answer options, slider, case-study matching, lead form (see below) |
| `header.json` | Page header / hero (`partials/page-header.php`): size, title, subtitle, button + button note, background |
| `our-journey.json` | About Us template timeline |
| `powerail.json` | Powerail / Powertrack templates |
| `technology.json` | Technology template |
| `contact-us.json` | Contacts template: form code, **Distributors** and **OEM partners** repeaters (see below) |
| `case-study.json` | Case study post type |
| `partners.json` | Partner post type |
| `viezo-theme-settings.json` | Options page (Settings → Viezo Settings) |

## Workflow

1. **Edit in the admin** (ACF → Field Groups / Post Types / Taxonomies) on your local site. Saving writes the JSON file automatically.
2. **Commit** the changed `acf-json/**.json` files.
3. **On another environment** after deploying, go to ACF → Field Groups. Changed items show **"Sync available"**. Click **Sync** to import the JSON into that site's database.

The JSON is loaded automatically even before syncing, so fields work on the front end right away. Syncing only makes the database copy (the one you edit in the admin) match.

### Rules

- Don't edit field groups on staging/production. Changes there won't be in git and will be overwritten by the next sync.
- `acf-json/` must stay writable locally, or ACF shows a "could not save JSON" notice.
- The old disabled **"Blocks (copy)"** group was intentionally not exported. It can be deleted in the admin.

## Shared (non-translated) fields

Some data is the same in every language, for example the distributor and OEM partner lists on the Contacts page. For these:

- The field's Polylang setting is **Copy once**, so a new translation starts with a copy of the English data.
- Templates read the field with `vzo__get_shared_field( 'name' )` (in `inc/template-tags.php`). If the current translation's field is empty, it falls back to the default-language (English) page.

So you only need to edit the English page. To let a language have its own list, fill in that page's field; a non-empty value takes priority. Section titles (`distributors_title`, `oem_partners_title`) are normal translatable fields.

### Translation settings per field (Polylang)

| Setting | Use for | Example |
|---|---|---|
| **Translate** | Texts and links that differ per language | Section titles, button labels and URLs, stat labels |
| **Synchronize** | Values that must be identical everywhere, so you update them once | Live Sonora scene image, "Hide section" |
| **Copy once** | Lists that start as a copy and can then be adapted per language | Machines, distributors, OEM partners |

Case studies are a translatable post type. A machine's **Case study** can point to the English post, and the template opens its translation in the visitor's language (`pll_get_post()`).

In templates, read fields **by key** (`field_…`) through `vzo__get_shared_field()`. Polylang's "custom fields" sync can copy values to a translation without ACF's hidden field-reference meta. Name lookups then return raw values (e.g. a repeater comes back as the row count); key lookups keep working.

## Live Sonora machine scene (Home)

Group **Home: Live Sonora network** → **Live scene** tab.

- **Photo:** any photo works. It's never cropped, keeps its own aspect ratio, and tall photos are capped at 80% of the screen height. After replacing it, drag the dots onto the new machines.
- **Dot positions:** X / Y in **% of the photo** (from the left / top). Edit them by dragging the dots in the visual editor shown in the field (`src/admin/live-sonora-editor.js`), or type them in.
- **Card placement** is automatic:
  - the card sits above its dot;
  - it hangs below the dot when the dot is near the top (Y < 38%);
  - it right-aligns when the dot is near the right edge (X > 72%).
- **One point can "Develop a fault".** On scroll its values climb to the fault values, it turns red and its card opens with the detected issue and a case-study link.
- **Languages:**
  - **Shared:** the photo, positions, values, fault settings and case study always come from the **English** page.
  - **Translated:** translations only provide the texts (machine name, last measurement, detected issue, link label), matched to the English points by row order.
  - **Editor:** on a translation, the editor hides the shared fields, shows the English dots read-only and links to the English page.
- **Code:** `inc/live-sonora.php` (`vzo__live_sonora_points()`, `vzo__live_sonora_scene_image()`).

## Pricing setup builder

Field group **Pricing: Setup builder** (`group_setup_builder`, keys `field_setup_*`), shown on pages using the *Pricing – Setup builder* template. Read through `vzo__setup_builder_config()` in `inc/setup-builder.php`.

| Fields | Polylang setting | Notes |
|---|---|---|
| All texts (incl. the **Confirmation email** tab: subject, summary heading, text, footer), Lead form | Translate | Each language has its own copy. `{current}`, `{total}` and `{sensors}` are replaced in the step counter and gateway note |
| Answer lists, Case studies | Copy once | An empty translation uses the English list. **Answer keys must be identical in every language**: analytics and case matching use them |
| Allow several answers, Slider points, Default value, Sensors per gateway, Send confirmation email | Synchronize | Edit once, applies to every language |

Choices that come from code or from the page are filled at render time (`acf/prepare_field`), so they never end up in the JSON:

- **Icon** (answer options): the icon library in `vzo__setup_builder_icons()`. To add an icon, add it there.
- **Equipment / Challenge / Industry** (case studies): the answer keys of the page being edited. Save the page after adding an answer so it appears here. A ticked key that no longer exists shows as "(missing option)".
- **Lead form**: all WPForms forms.

