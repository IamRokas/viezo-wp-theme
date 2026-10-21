# Release 2026-10-22 · Client answers applied (theme 2.2.1)

Applies Viezo's answers of 2026-10-21 ([client-questions-2026-10.md](../04-backlog/client-questions-2026-10.md)) to the structured data and llms.txt. Theme upload only, no seeds.

| Change | Where |
|---|---|
| Legal name **UAB Viezo** (alternate: "Viezo, UAB") in Organization schema and llms.txt | `inc/seo.php` |
| Client names no longer in case-study Article schema (`mentions`) or in llms-full.txt; they stay on the pages as before | `inc/seo.php`, `inc/llms.php` |
| Sonora specs (from the spec table) as `additionalProperty` in the Product schema | `inc/seo.php` |
| llms-full.txt: "Sonora: how it works" (approved answers: install time, 100–15,000 RPM, sensors per machine, analyst review, fault types) and "Sonora: technical specifications"; pricing stated as "on request" | `inc/llms.php` |

## Deploy

1. `npm run zip` → upload `dist/viezo-YYYYMMDD-HHMM.zip` (Appearance → Themes → Add New → Upload → Replace current with uploaded).
2. llms.txt refreshes on its own within a day, or immediately when any post is saved.

## Verify

- View source of a case study (e.g. /case-study/fan-bearing-wear/): `"mentions"` lists only Sonora; `"legalName":"UAB Viezo"`.
- Sonora page source: `"additionalProperty"` with the sensor specs.
- https://viezo.lt/llms-full.txt has the "Sonora: how it works" and "Sonora: technical specifications" sections and no "- Client:" lines.
