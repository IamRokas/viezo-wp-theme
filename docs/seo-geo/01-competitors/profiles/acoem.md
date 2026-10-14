# Acoem (EAGLE)

- **Site:** https://www.acoem.com (redirects to /en/; reliability section `/en/industrial-reliability/` and `/en/products/condition-monitoring/`)
- **Checked:** 2026-10-14
- **Tier:** additional
- **Overlap with Viezo:** medium. EAGLE is a wireless tri-axial vibration + temperature sensor system with AI diagnostics for rotating machinery, same job as Sonora; Acoem also sells environmental monitoring, handheld analyzers and alignment tools, and targets heavy industry (mining, paper, wind, nuclear/hydro).

## Snapshot

| | |
|---|---|
| HQ / size | Limonest (Lyon), France (Wikidata Q30290758 / Q111844009). Size not verified; group with several sub-brands (01dB, Metravib, Ecotech, Fixturlaser legacy). |
| What they sell | EAGLE and EAGLE Edge LoRa wireless vibration sensors, NEST i4.0 software, Accurex AI diagnostics, SPARROW sensors, handheld analyzers (Falcon, Machine Defender app), laser alignment, reliability services (Advisor diagnostics, consulting, training). |
| Positioning line | Home title: "Acoem - Creating Environments of Possibility" (no H1 on home). EAGLE H1: "EAGLE"; first H2 "Wireless diagnostic solution for critical assets". |
| Target industries | Mining, pulp and paper, wind energy, automotive/rail, energy (nuclear, hydro), water, industrial processes, biotech. |
| Pricing on site | None; "request a quote". US page describes a starter kit (4 sensors, gateway, NEST i4.0, 1 user, "no annual maintenance fees") without price (via search snippet, not verified on page). |
| Languages | EN plus regional sites: en-au, en-gb, en-in, es, fr-fr, pt-br (7 hreflang). No Polish. |

## Site structure

WordPress + Yoast-style `sitemap_index.xml` (at root, `/en/sitemap_index.xml` listed in robots.txt returns 404) + WPML. 14 post-type sitemaps, ~2,130 URLs total:

- Blog `/en/blog/<slug>/`: 918 unique URLs (EN and ES slugs mixed under /en/); ~105 reliability/vibration/maintenance related.
- News 354, press releases 43, webinars 37, podcasts 8, videos 2.
- Case studies `/en/case-studies/<slug>/`: 121 unique; ~48 reliability-related; 8 mention EAGLE in slug.
- Products 241 (10 under `/products/condition-monitoring/`), ranges 118 (`/en/ranges/condition-monitoring/wireless-iiot-vibration-sensing/`).
- Applications/industry pages 24 (e.g. `/applications/mining-reliability-solutions/`, `/wind-energy-reliability-solutions/`, `/improving-equipment-reliability-in-pulp-paper-operations/`).
- Reliability services: 9 pages under `/en/industrial-reliability/`.
- Distributor directory post types (distributor, country, contact, solution).
- No glossary, no calculators, no comparison pages found.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Acoem - Creating Environments of Possibility | (none) |
| Main product | EAGLE - Acoem | EAGLE |
| One case study | CSN Mineração Saves R$ 4M with Eagle Sensors in Brazil | CSN Mineração Saves R$ 4M with Acoem Eagle Sensors at Casa de Pedra Mine |
| One industry page | Mining Reliability Solutions - Acoem | Optimizing Mining Operations for Maximum Reliability (2 H1s on page) |

Targets: "vibration analysis", "predictive maintenance", "wireless vibration monitoring", "ISO 10816", "machine misalignment", "time waveform", industry + "reliability solutions". Product page itself targets only the brand name ("EAGLE"), weak for generic queries.

## Content engine

- Blog has a real vibration-education track: "Vibration Analysis: Where to Start", "Vibration analysis basics: sensor mounting", "...time waveform acquisition", "How vibration is measured: sine waves, FFT", "ISO10816 vibration velocity: an insufficient indicator", "Predictive maintenance: which KPIs to choose for vibration analysis", "How does AI improve vibration analysis". Typical ~900 words incl. chrome, `Article` schema with `Person` author.
- Case studies use a fixed structure: Executive Summary / The Challenge / The Solution / The Results / The Impact, with a money figure in title ("Saves R$ 4M"). ~800 words incl. chrome.
- Webinars (37), podcasts (8), reliability training courses.
- Application-specific blog posts tie product to a use case ("Discover how Acoem EAGLE wireless solutions will improve the reliability of your cooling towers").

## Proof and trust

- Named clients in case studies: CSN Mineração (Casa de Pedra), Genesis Minerals, a UK water supplier, Brazilian port operators; quantified savings (R$ 4M).
- Certifications claimed for EAGLE: ATEX/Zone 0 (Class I Div I), IP67 stainless (per search snippets of Acoem pages).
- G2/Capterra: no listings found for EAGLE or Acoem reliability software.

## Technical and structured data

- JSON-LD (Yoast graph) on all pages: `WebPage`, `WebSite`, `SearchAction`, `BreadcrumbList`; blog adds `Article`, `Person`, `ImageObject`. **No `Product` schema on the EAGLE page, no `Organization` in sampled pages.**
- llms.txt: no (404 returns full HTML page).
- robots.txt: `Crawl-delay: 5`, disallows all PDFs (`/*.pdf$`), no AI-crawler rules. Lists sitemap URLs for other domains (ecotech.com, metravib) and a /en/ sitemap that 404s.
- hreflang: 7 on product/blog; case study only `x-default`.
- gzip; HTML 140-240 KB. CMS: WordPress + WPML 4.9.2.

## Off-site authority

- Wikipedia: no EN or FR article found for Acoem. Wikidata items exist (Q111844009 "French company").
- G2/Capterra: none found.
- Trade press: product news (Windtech International); DirectIndustry product listing for EAGLE; RS Components sells some Acoem devices.
- Regional sites (acoem.us, /australasia/, /united-kingdom/) and distributor network.
- YouTube/LinkedIn: present (not counted).

## AI visibility (manual)

Fill during monthly tracking: which prompts mention them, which of their pages get cited.

## What Viezo can learn

1. **Fixed case-study template with a money/time number in the title.** Acoem: Executive Summary / Challenge / Solution / Results / Impact, title "CSN Mineração Saves R$ 4M...". Viezo has 59 cases at a 152-word median with vague titles. → Add a 3-line executive summary + "Result" line with a number (downtime avoided, € saved, weeks of early warning) to the top 15 cases; title pattern "<Client> avoids <N> h downtime: <fault> on <machine>". → M
2. **Vibration basics series, one question per post.** Acoem has ~105 reliability posts incl. sensor mounting, time waveform, FFT, ISO 10816 limits. → Viezo writes a 6-post EN/PL "vibration monitoring basics" series (where to start, sensor mounting, RMS vs peak, ISO 20816 limits, what an alert means, wireless vs wired) with `Article` + author `Person` schema. → M
3. **Application pages per industry with linked cases.** Acoem has 24 application pages (mining, paper, wind). → Viezo builds 3-4 industry pages for its real base (furniture/woodworking, automotive suppliers, food/packaging) each listing the relevant case studies from the 59. → M
4. **Use WordPress SEO plugin schema properly, but add what Acoem misses.** Acoem gets Article/Breadcrumb/WebSite automatically from Yoast but has no Product/Organization on the product page. Viezo is also WordPress: enable Yoast/Rank Math graph and add `Organization` (with sameAs LinkedIn, Wikidata once created) + `Product` for Sonora. That would put Viezo ahead of Acoem on entity markup. → S
5. **Use-case blog posts that pair product + machine.** "How EAGLE improves reliability of cooling towers". → Viezo: "Monitoring dust-extraction fans in furniture plants with Sonora", "Monitoring compressors", each linked to cases. → S each

## What not to copy

- Product H1/title that is just the brand ("EAGLE - Acoem"): same weakness as Viezo's "Sonora". Fix ours, do not imitate.
- Home page without H1 and a vague tagline ("Creating Environments of Possibility").
- WPML misconfiguration: Spanish slugs published under `/en/`, case studies with only `x-default` hreflang, robots.txt pointing to a 404 sitemap and to other domains' sitemaps.
- Blocking all PDFs in robots.txt: hides datasheets from search/AI; Viezo should keep its datasheet indexable (and unblock images).
- Splitting brand across many regional domains/sub-brands (acoem.us, Ecotech, Metravib) without a Wikipedia entity.

## Sources

- https://www.acoem.com/robots.txt (2026-10-14)
- https://www.acoem.com/llms.txt (404, 2026-10-14)
- https://www.acoem.com/sitemap_index.xml and its 14 child sitemaps (2026-10-14)
- https://www.acoem.com/en/ (2026-10-14)
- https://www.acoem.com/en/products/condition-monitoring/wireless-iiot-vibration-sensing/eagle/ (2026-10-14)
- https://www.acoem.com/en/case-studies/csn-mineracao-saves-r-4m-with-acoem-eagle-sensors-at-casa-de-pedra-mine/ (2026-10-14)
- https://www.acoem.com/en/applications/mining-reliability-solutions/ (2026-10-14)
- https://www.acoem.com/en/blog/vibration-analysis-where-to-start/ (2026-10-14)
- Wikipedia EN/FR "Acoem" (404); Wikidata search (2026-10-14)
- WebSearch: Acoem EAGLE reviews / G2 / Capterra (none found); DirectIndustry, Windtech International (2026-10-14)
