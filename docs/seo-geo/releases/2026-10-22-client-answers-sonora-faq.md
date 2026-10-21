# Release 2026-10-22 · Client answers + Sonora FAQ (theme 2.3.0)

2.2.1 was not deployed on its own; it ships together with the Sonora FAQ as 2.3.0.

Applies Viezo's answers of 2026-10-21 ([client-questions-2026-10.md](../04-backlog/client-questions-2026-10.md)) to the structured data and llms.txt. Also adds an FAQ block to the Sonora pages (backlog C-13).

| Change | Where |
|---|---|
| Legal name **UAB Viezo** (alternate: "Viezo, UAB") in Organization schema and llms.txt | `inc/seo.php` |
| Client names no longer in case-study Article schema (`mentions`) or in llms-full.txt; they stay on the pages as before | `inc/seo.php`, `inc/llms.php` |
| Sonora specs (from the spec table) as `additionalProperty` in the Product schema | `inc/seo.php` |
| llms-full.txt: "Sonora: how it works" (approved answers: install time, 100–15,000 RPM, sensors per machine, analyst review, fault types) and "Sonora: technical specifications"; pricing stated as "on request" | `inc/llms.php` |

| New **FAQ** block layout (title, questions/answers as expandable rows, FAQPage structured data) | `acf-json/field-groups/blocks.json`, `partials/blocks/faq.php`, `src/scss/blocks/_faq.scss`, `vzo__schema_faq()` in `inc/seo.php` |
| FAQ with 6 approved questions on the EN and PL Sonora pages, before "Case studies" | seed `seo-sonora-faq` |

## Deploy

1. `npm run zip` → upload `dist/viezo-YYYYMMDD-HHMM.zip` (Appearance → Themes → Add New → Upload → Replace current with uploaded).
2. **ACF → Field Groups**: "Blocks" shows **Sync available**. Click **Sync**, so the FAQ layout is also in the database copy that the admin edits. (The block works on the site before syncing.)
3. **Tools → Viezo seeds → SEO: FAQ on the Sonora pages → Run.** Expected: "#… (en): FAQ added as block 12. #… (pl): FAQ added as block 12."
4. Clear the LiteSpeed cache if active. llms.txt refreshes on its own within a day, or immediately when any post is saved.

Editing later: the FAQ is a normal block on the Sonora page (Blocks → FAQ), editable per language.

## Verify

- View source of a case study (e.g. /case-study/fan-bearing-wear/): `"mentions"` lists only Sonora; `"legalName":"UAB Viezo"`.
- Sonora page source: `"additionalProperty"` with the sensor specs.
- https://viezo.lt/for-factory-owners-sonora/ and https://viezo.lt/pl/sonora/: "Frequently asked questions" / "Najczęściej zadawane pytania" above the case studies, rows open and close. Page source has `"@type":"FAQPage"` with 6 questions.
- https://viezo.lt/llms-full.txt has the "Sonora: how it works" and "Sonora: technical specifications" sections and no "- Client:" lines.

## Tested locally (2026-10-22)

Seed ran on the EN and PL Sonora pages (FAQ inserted as block 12 of 14), re-run skipped both. Rendered HTML of all other blocks identical before and after (only per-request IDs and tokens differ). FAQPage schema with 6 questions per language. Layout checked at desktop and mobile width.
