# Templates & blocks

## Page templates (`templates/`)

Selectable under **Page Attributes → Template**.

| File | Template name | Notes |
|---|---|---|
| `home.php` | Home | Front page: hero, "Live Sonora network" section (`partials/live-sonora.php`): intro, interactive machine scene (photo + measuring points; on scroll one point develops a fault and its card opens), machines linked to case studies. Content from the ACF group "Home: Live Sonora network", behaviour in `src/js/blocks/live-sonora.js`, blocks |
| `about-us.php` | About Us | Blocks + "Our Journey" timeline (GSAP ScrollTrigger from CDN) |
| `technology.php` | Technology | Blocks |
| `powerail.php` | Powerail | "For wagon owners". Blocks, with `powerail_timeline.php` injected after the first block |
| `powertrack.php` | Powertrack | "Sonora" page. Blocks, with `sonora_timeline.php` injected after the first block |
| `page-pricing.php` | Pricing | Blocks + savings calculator |
| `pricing-setup.php` | Pricing – Setup builder | Header, then the setup builder funnel (`partials/setup-builder.php`), then blocks. See below |
| `contacts.php` | Contacts | Our details + map (Google Maps JS API, fills the left column) next to the contact form, then distributors & OEM partners (`partials/contact-partners.php`), blocks |
| `eu.php` | EU | Blocks + posts list |

Files starting with `_` aren't templates. They're partials included from `inc/hooks.php`:

- `_calculator_form.php` / `_calculator_email.php`: savings calculator form and its email (`inc/calculator.php`)
- `_contact_us_form.php` / `_contact_email.php`: contact form and email

`powerail_timeline.php` and `sonora_timeline.php` are scroll-animated timelines. They use the frames in `anim-assets/`.

`remove_editor()` in `inc/hooks.php` hides the classic editor for block-driven templates. Add new templates to its list if they don't use `the_content()`.

## Pricing setup builder

A 4-question lead funnel on the Pricing page (EN + PL): industry → equipment → maintenance challenge → number of machines, then an estimated setup (points, gateways = ⌈points / sensors per gateway⌉) with one matched case study, then a WPForms lead form.

- **Content** is edited on each language's Pricing page, in the **Pricing: Setup builder** field group (tabs: General, the 4 questions, Result, Case studies, Offer form). All copy, the answer options (key, label, icon), the slider points, sensors per gateway, the case-study list and the lead form are configurable. See [acf.md](acf.md#pricing-setup-builder).
- **Fallbacks:** an empty field on a translation uses the English page; an empty English field uses the built-in defaults in `vzo__setup_builder_defaults()` (`inc/setup-builder.php`). The builder always renders.
- **Case study matching:** score = same equipment (100) + same challenge (10) + same industry (1). On a tie the higher row wins. Case studies open in the visitor's language.
- **Lead forms:** one WPForms form per language, "Pricing setup offer (EN)" and "(PL)", chosen in the page's **Lead form** field. Both have the same hidden fields (IDs 5–14), which JS fills: answers (labels in the page's language), machines, estimated points and gateways, the case study shown, funnel session ID, language, and the language-independent answer keys (`industry=food; equipment=pumps; challenge=bearing`). Both notify the site admin email.
- **Code:** markup `partials/setup-builder.php`, config `inc/setup-builder.php`, JS `src/js/templates/setup-builder.js`, styles `src/scss/pages/_setup-builder.scss`. Initial content and forms: the `pricing-setup` seed.
- **Confirmation email:** after a successful submission the person who sent the form gets a styled email (site colours, logo) with their setup summary, in the page's language. Texts are edited on each language's Pricing page, tab **Confirmation email** (on/off, subject, summary heading, text with `{name}` / `{summary}`, footer); English defaults in `vzo__setup_builder_defaults()`, Polish via the `pricing-setup` seed. Code: `inc/setup-builder-email.php`, template `templates/_setup_offer_email.php`. A plain-text version is included. Sent with `wp_mail()`, so it goes through the SMTP plugin.
- **Site log + stats:** every step is also logged on the site, in the table `{prefix}vzo_setup_events` (created automatically, no migration). It's anonymous: session ID and answers only, no IP or contact details, and rows older than 24 months are deleted daily. "Form submitted" is logged server-side with the WPForms entry ID. **Tools → Setup builder stats** shows the funnel (unique sessions per step), conversion per answer, the latest leads (linked to their WPForms entries) and a CSV export. Code: `inc/setup-builder-stats.php`; JS sends events to `POST /wp-json/viezo/v1/setup-event`.
- **Tracking:** every step goes to GA4 (`gtag`, loaded by `inc/analytics.php`; or the GTM `dataLayer` when there's no `gtag`) and Microsoft Clarity (`clarity('event')` + `clarity('set')` tags). Events in GA4 / Clarity are numbered so they sort as the funnel: `setup_0_started`, `setup_1_industry`, `setup_2_equipment`, `setup_3_challenge`, `setup_4_machines`, `setup_5_result_viewed`, `setup_6_offer_clicked`, `setup_7_form_submitted` (the site's own log keeps the internal names `setup_started`, `setup_step_answered` + step, …). Parameters: `setup_session`, `setup_lang`, `setup_industry`, `setup_equipment`, `setup_challenge`, `setup_machines`, `setup_gateways`, `setup_case`, plus `setup_step` / `setup_question` / `setup_answer` on answers. Answers are sent as option **keys** and the case as its **English slug**, so EN and PL report together. Country comes from GA4 / Clarity. Register the parameters as custom dimensions in GA4 to report on them.

## Flexible content blocks (`partials/blocks/`)

Pages render the ACF flexible content field `blocks`:

```php
foreach ( get_field( 'blocks' ) ?: [] as $block ) {
	get_template_part( 'partials/blocks/' . $block['acf_fc_layout'], null, [ 'block' => $block ] );
}
```

The layout name **is** the file name. Available layouts:

| Layout / file | Description |
|---|---|
| `two_column_image_right` | Text left, image right (most used) |
| `two_column_image_left` | Image left, text right |
| `two_column_fixed_image_left` | Two columns with a fixed image on the left |
| `box_with_shadow` | Title + text in a shadowed box |
| `cards` | Numbered cards |
| `image_grid` | Grid of images with titles |
| `image_grid_with_logos` | Image grid with logo + text overlay |
| `text_on_image_grid` | Text overlaid on image tiles |
| `info_line` | Info/stat strip |
| `comparison_table` | Comparison table |
| `video` | Video with custom play/pause controls (`src/js/blocks/video.js`) |
| `faq` | Title + questions/answers as expandable rows (native `<details>`, no JS). Outputs FAQPage structured data (turn off per block in Settings → FAQ structured data). Styles `src/scss/blocks/_faq.scss`, schema `vzo__schema_faq()` in `inc/seo.php`. Used on the Sonora pages |
| `embed_code` | Title/subtitle + raw embed code |
| `case_studies` | Case study cards (`partials/case-study-card.php`) |
| `partners` | Partner logos (from the `partner` post type) |
| `software` | Software showcase section |
| `get_in_touch` | Contact CTA |

Every layout can be picked in the editor, so keep all block files even if a layout isn't used on any page right now.

### Adding a block

1. Add a layout to the **Blocks** field group in ACF, e.g. `logo_strip`. This saves to `acf-json/field-groups/blocks.json`.
2. Create `partials/blocks/logo_strip.php` and read fields from `$args['block']`.
3. Styles go in `src/scss/blocks/_logo-strip.scss`, imported from `src/scss/blocks/index.scss`. JS goes in `src/js/blocks/`.
4. Commit the JSON and the partial together.

## Other templates

Standard hierarchy files at the theme root: `index.php` (news), `single.php`, `page.php` (default page + blocks), `archive.php`, `category.php`, `search.php`, `404.php`, plus case-study archive/single/taxonomy templates. Loop partials live in `template-parts/`.
