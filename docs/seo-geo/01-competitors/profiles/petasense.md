# Petasense (Vibration Mote, Transmitter, ARO Cloud)

- **Site:** https://petasense.com
- **Checked:** 2026-10-14
- **Tier:** main
- **Overlap with Viezo:** high. Wireless vibration sensors plus a cloud platform for rotating equipment, with customer stories that report savings. The market is the US (utilities, pharma, data centers), so they rarely meet Viezo in EN/PL search, but they compete in English AI answers.

## Snapshot

| | |
|---|---|
| HQ / size | Silicon Valley, US (HQ city not verified on site). Latka estimates 24 people and $3.1M revenue in 2024 (third-party, not verified) |
| What they sell | Hardware + SaaS: Vibration Mote (wireless, Wi-Fi), Transmitter + VSX wired sensors (for VFDs), temperature/ultrasound/pressure/current sensors, ARO (Asset Reliability & Optimization) Cloud, mobile app with route-based offline measurements |
| Positioning line | No H1. The first H2 on the home page is "Predict machine failures before they happen" |
| Target industries | Power generation, pharmaceuticals, oil & gas, data centers, critical facilities, food & beverage, water utilities |
| Pricing on site | No public price. There is an ROI calculator at /roi/ (inputs: number of assets; outputs: PM, repairs, route-based monitoring, downtime savings vs investment). Leftover WooCommerce pages (/shop/, /cart/) are in the sitemap |
| Languages | EN only, no hreflang |

## Site structure

WordPress (custom theme `peta_sense`) with a Yoast-style sitemap index:
- post-sitemap: **72** posts (blog, news and customer stories all share root-level slugs, e.g. `/dublin-san-ramon-services-district-reduces-repair-costs-86-implementing-petasense/`)
- page-sitemap: **47** pages, including junk (`/sample-page/`, `/404-page/`, `/roadshow2023/`, `/cart/`, `/checkout/`)
- testimonials-sitemap: 3 (all from 2017). kbe_taxonomy is empty (a dead knowledge base plugin)
- Application pages: `/rotating-machine/`, `/electric-panels/`, `/valves/`, `/steamtraps/`, `/more-applications/`. These are failure/asset-type entry points, close to Viezo's needs
- Industry pages: `/customers/<industry>/` (6: oil-gas, pharmaceuticals, food-beverage, power-generation, critical-facilities, data-centers)
- `/customer-stories/` hub lists about 8 stories, dated 2017 to 2026
- No glossary section. One 860-word glossary *post* exists (`/glossary-terms-industrial-maintenance-terminology/`)

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Petasense | none |
| Main product (/products/vibration-motes/) | Petasense | none |
| One case study (Dublin-San Ramon, 86%) | Petasense | none. Headline is an H2: "Dublin-San Ramon Services District Reduces Repair Costs By 86% After Implementing Petasense" |
| One industry page (/customers/power-generation/) | Petasense | none |

Every page we checked has the same `<title>` "Petasense", no H1, no meta description, no canonical and no Open Graph tags. Googlebot gets the same result. The site gets its rankings from slugs and body copy alone. The keywords it targets (in slugs and copy) are: wireless predictive maintenance, IIoT, wireless condition monitoring, VFD monitoring, vibration analysis techniques.

## Content engine

- Blog/news: 72 posts. There were 49 in 2018–2019, then almost nothing in 2020–2024 (1–2 per year), then a restart in 2025 (15) and 2026 (4, the latest in June 2026). New posts are long-form practitioner guides, e.g. "Practical guide to vibration analysis techniques", "Evaluating wireless condition monitoring systems", "10 mistakes to avoid implementing IIoT-based condition monitoring", "Demystifying VFD-driven machine monitoring", "When wireless doesn't work"
- Customer stories: about 8, each long and journalistic (the Dublin-San Ramon story has about 1,770 words on the page, with a dateline city and a headline % result)
- Gated content page (`/gated-content/`) and newsletter. There is an ROI calculator but no glossary hub or comparison pages
- Honest "when wireless doesn't work" content builds trust and is the kind of passage AI answers like to cite

## Proof and trust

- Named customers: Stanford University (CEF), Arizona Public Service, Silicon Valley Power, Hawaii power utility, Dublin-San Ramon Services District, C&W Services/Cushman & Wakefield, JLL, a Nevada gold mine
- Quantified headlines: "Reduces Repair Costs By 86%"
- Awards and press posts: Google "Top 10 ML startup", 2018 Pharma Innovation Award, TechCrunch launch (2017), OSIsoft partnership
- G2/Capterra: no listing found (rfp.wiki aggregator: "sparse" review data, 1 review)

## Technical and structured data

- JSON-LD: **none** on any page checked
- llms.txt: **no** (404)
- robots.txt: minimal WP default (only /wp-admin/ blocked). No AI-crawler rules, no Sitemap: line
- hreflang: none. EN only
- Pages are light (21–39 KB gzipped HTML), gzip, legacy UA Google Analytics tag still in `<head>`
- CMS: WordPress

## Off-site authority

- Wikipedia/Wikidata: no entry found
- Press: TechCrunch (2017, "emerges from stealth"), eeNews Europe / ElectronicsForU (3-in-1 sensor launch), OilMan Magazine interview, Robs Reliability Project podcast
- Data profiles: Crunchbase, CB Insights, Latka, Dealroom
- G2/Capterra: none found
- Partnerships: OSIsoft (PI), Electric Imp

## AI visibility (manual)

To fill during monthly tracking.

## What Viezo can learn

1. **Application/asset pages as entry points.** Petasense has separate pages for rotating machines, electric panels, valves and steam traps, and links stories from them. → Viezo builds 5–6 "Monitoring <asset>" pages (motors, fans, pumps, gearboxes, compressors, conveyors) in EN/PL. Each links the matching Sonora case studies from its 30. → M
2. **Long, practitioner-style guides that AI answers can quote.** Their 2025–26 restart is all "how to evaluate / mistakes to avoid / when wireless doesn't work" posts. → Viezo writes 3 cornerstone explainers: "How to evaluate a wireless vibration monitoring system (checklist)", "When wireless vibration monitoring is NOT the right choice", and "Vibration monitoring on VFD/variable-speed machines". Each gets a short definition paragraph and a table. → M
3. **A few long flagship case studies with a headline number in the title.** Their "Reduces Repair Costs By 86%" story runs about 1,770 words with a dateline. → Expand the 3–5 strongest Viezo cases (e.g. Volkswagen Polska, IMA Schelling) to 600–900 words: Challenge, Detection, Action, Result, quote. Put the result in the `<title>` and H1. Leave the other 54 short. → M
4. **ROI calculator next to pricing.** Petasense has /roi/ (assets → savings vs investment). Viezo already has a public setup builder (price). → Add a "what downtime costs you" output to the builder, or a simple separate ROI page, so pages can rank and be cited for "vibration monitoring ROI". → S/M
5. **Use their weak spot.** Petasense has identical `<title>`s, no H1, no meta description, no schema and no llms.txt. For English long-tail queries on topics they cover, Viezo can outrank them with basic on-page hygiene (unique titles/H1s, Article + Organization schema). This confirms that Viezo's backlog items for titles and schema are high-leverage. → S

## What not to copy

- Mixing news, blog and customer stories as root-level WP posts with no taxonomy makes them hard to crawl and to cite as "case studies"
- A five-year content gap (2020–2024) followed by a restart: a steady small cadence works better
- Junk pages in the sitemap (`/sample-page/`, `/cart/`, `/404-page/`, `/roadshow2023/`)
- No titles, H1s or meta descriptions anywhere: the opposite of what Viezo should do

## Sources

- https://petasense.com/ , /products/vibration-motes/ , /customer-stories/ , /customers/power-generation/ , /roi/ (2026-10-14)
- https://petasense.com/evaluating-wireless-condition-monitoring-systems/ , /glossary-terms-industrial-maintenance-terminology/ , /dublin-san-ramon-services-district-reduces-repair-costs-86-implementing-petasense/ (2026-10-14)
- https://petasense.com/robots.txt , /llms.txt (404), /sitemap_index.xml + post/page/testimonials sitemaps (2026-10-14)
- https://www.rfp.wiki/vendors/petasense (2026-10-14)
- https://getlatka.com/companies/petasense (2026-10-14, third-party estimate)
- https://techcrunch.com/2017/06/21/petasense-emerges-from-stealth-to-help-companies-monitor-machine-health (2026-10-14)
- Wikipedia/Wikidata API search "Petasense": no results (2026-10-14)
