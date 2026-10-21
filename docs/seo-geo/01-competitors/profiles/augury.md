# Augury (Machine Health / Industrial AI)

- **Site:** https://www.augury.com
- **Checked:** 2026-10-14
- **Tier:** additional
- **Overlap with Viezo:** medium. Same core (wireless vibration/temperature/magnetic sensors + AI fault diagnosis), but Augury sells enterprise-wide to Fortune 500 CPG/chemicals and now positions as "Industrial AI agents".

## Snapshot

| | |
|---|---|
| HQ / size | Founded 2011 (Saar Yoskovitz, Gal Shaul), Israel/US. $180M Series E in 2021 at >$1B valuation led by Baker Hughes (press). llms.txt claims "800+ active manufacturing sites in 40+ countries" |
| What they sell | Machine Health (Halo R4000 sensors, Auguscope portable, hazardous-zone/Ranger Pro with Baker Hughes), Process Health, "Industrial AI Workforce" (Reliability/Operations/Maintenance/Data agents), with CAT III/IV analyst review on alerts |
| Positioning line | H1 "Industrial AI Agents That Work for You. From Uptime to Unstoppable." and title "Industrial AI for Uptime & Productivity \| Augury" |
| Target industries | 14 industry pages: F&B, CPG, chemicals, building materials/cement, metals & mining, pulp & paper, glass, pharma, plastics, steel, forest products, oil & gas, energy, commercial services |
| Pricing on site | `/pricing/` H1 "Let's Talk Numbers" is a quote form ("<6 months payback") with no prices. `/value-calculator/` exists |
| Languages | English only, no hreflang |

## Site structure

WordPress + Yoast with `sitemap_index.xml` (14 sub-sitemaps):

- Blog posts: **549** (`/blog/<category>/<slug>/`). Lastmod by year: 2023 134, 2024 46, 2025 187, 2026 182. This is a high current cadence.
- Pages: 97, including the use-case matrix `/use-cases/` by **asset** (14: bearings, pumps, motors, gearboxes, fans & blowers, compressors, conveyors, mixers, mills, extruders, chillers, seamers…), **industry** (14), **persona** (6) and **business goal** (5).
- Comparison pages `/augury-vs-assetwatch/` and `/augury-vs-waites/`, plus a blog roundup "7 Top Predictive Maintenance Solutions" with head-to-heads.
- Success stories: 8 pages + 1 PDF (PepsiCo, Colgate-Palmolive, DuPont, Barilla, Lindt, Osem-Nestlé, Fortune Brands, Circulus).
- Collateral: 37 (mostly gated reports: "State of Production Health" 2023 to 2026, Forrester TEI, Frost & Sullivan industry reports, "Machine Health for Dummies", "10 common machine fault types").
- Webinars/events 60, media center 50, podcasts 48, landing pages 32 (`/lp/`), partner pages (Microsoft Azure, MaintainX, DSV).

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Industrial AI for Uptime & Productivity \| Augury | Industrial AI Agents That Work for You. From Uptime to Unstoppable. |
| Main product | AI for Predictive Maintenance Solutions \| Augury | AI for Predictive Maintenance Solutions |
| One case study | DuPont boosts ROI with predictive maintenance \| Augury | DuPont Innovates Operations Using Machine Health |
| Asset page | Condition Monitoring for Industrial Bearings \| Augury | Condition Monitoring for Industrial Bearings |

Target terms include "AI predictive maintenance", "condition monitoring for [asset]", "predictive maintenance solutions", "[competitor] vs Augury", and agentic-AI-in-manufacturing topics. The category name "Machine Health" is owned and repeated everywhere.

## Content engine

- Blog volume of ~550 posts with ~180/year in 2025 to 2026, and categories such as machine-health, asset-care, industry-insights and customers-partners.
- Asset pages are thin. The bearings page has ~250 words of body: 6 benefit headings plus a list of **14 fault types** (bearing wear, lubrication issues, misalignment, looseness, unbalance…) and one claim ("99.9%+" diagnostic accuracy). It has no FAQ and no case-study link on the page, but carries QAPage/Service schema.
- Case studies are few, big-brand and video-led. DuPont is ~750 words with a "7x ROI" headline.
- Annual proprietary research ("State of Production Health" 2023 to 2026) and analyst reports (Forrester TEI: 310% ROI, payback <6 months, $20.1M NPV) are gated, but the headline numbers are reused everywhere, including in llms.txt.
- Podcast (48 episodes), webinars (60), and a community at endpoint.augury.com.

## Proof and trust

- Logos: PepsiCo, Colgate-Palmolive/Hill's, DuPont, Barilla, Lindt, Nestlé, Hershey's (press).
- Quantified: Forrester TEI 310% ROI, Circulus uptime 65–70% → 85–90%, Fiberon $274K saved / 178 h downtime avoided.
- Reviews: product schema on `/machine-health/` shows AggregateRating **4.9 / 13**. G2 is ~4.8 from 3 reviews and Gartner Peer Insights ~4.7 from 16 (third-party aggregator rfp.wiki, not verified on G2 directly). Capterra has no reviews.
- Awards page, Frost & Sullivan Company of the Year 2023, Trust Center, and a coordinated vulnerability disclosure page.

## Technical and structured data

- WordPress + Yoast + WP Rocket, behind Cloudflare. Some URLs (`/pricing/`) and bare curl requests get a Cloudflare challenge (403 "Just a moment…"). This may also block some AI crawlers (not verified).
- JSON-LD is a Yoast graph (Organization, WebSite with SearchAction, WebPage, BreadcrumbList) plus custom Product + AggregateRating + **FAQPage** (product page), and **QAPage + Service + BusinessAudience** (asset pages).
- **llms.txt: yes**, 7 KB, 68 lines, 43 links. It includes an explicit positioning note ("Machine Health remains a core… not replaced by the Industrial AI Workforce repositioning"), **plus `/llms-full.txt`** (23 KB) with an entity taxonomy, "Approved Citations" and a **"Competitor Context"** section with one-line Augury vs AssetWatch / Tractian / Waites claims.
- robots.txt is a Yoast default (only /wp-admin/ blocked) with no AI-crawler rules. No hreflang.

## Off-site authority

- Wikipedia: no article found via search (2026-10-14). Wikidata not verified because the API was rate-limited.
- Strong funding press (Globes, Calcalist, VentureBeat), Baker Hughes and Microsoft partnerships, and analyst coverage (Forrester, Frost & Sullivan, LNS, ARC).
- G2/Capterra presence is weak for its size (3 G2 reviews per aggregator).
- Own podcast, 50 media-center items, and a YouTube/Vidyard video presence (stats not verified).

## AI visibility (manual)

To fill during monthly tracking. Likely cited for "machine health" and "AI predictive maintenance" definitions and for comparison prompts via `/augury-vs-*` pages and llms-full.txt.

## What Viezo can learn

1. **Asset × fault-type pages.** Augury has 14 `/use-cases/asset-condition-monitoring/condition-monitoring-for-<asset>/` pages, each listing the fault types detected. **Viezo:** create 6 EN/PL pages (fans, pumps, electric motors, gearboxes, compressors, conveyors/saws for wood processing). Each lists the faults Sonora detects for that asset and *links to the matching Viezo case studies*, which Augury's pages lack. Viezo's 30 case studies give real proof that Augury's thin pages don't have. → M
2. **llms-full.txt with entities and approved facts.** Augury's llms-full.txt defines each product/entity and lists "approved citations" (proof numbers). **Viezo:** add `llms.txt` + a short `llms-full.txt` that defines Viezo (UAB, Vilnius, *not viezo.com*), Sonora (sensor specs, connectivity, alerts), the industries served, and 5 to 10 verifiable proof points from case studies. This is cheap and directly helps brand disambiguation. → S
3. **One headline proof number reused everywhere.** Augury repeats "310% ROI, <6 months payback" from Forrester TEI on pricing, llms.txt and product pages. **Viezo:** aggregate the 30 case studies into one or two defensible numbers (e.g. "faults caught in 30 documented cases at N plants in PL/LT"). Use them in the home H1/intro, meta descriptions and llms.txt. → S
4. **FAQ blocks with FAQPage schema on product/asset pages.** Augury uses FAQPage on `/machine-health/` and QAPage on asset pages. **Viezo:** add 5 to 6 real buyer FAQs to the Sonora page (battery life, install time, Wi-Fi/LTE, which machines, price, data ownership/EU hosting) with FAQPage JSON-LD in EN and PL. → S
5. **Name a category and own it.** "Machine Health" appears in every title and asset page. **Viezo:** pick consistent descriptive wording ("wireless vibration monitoring" / "bezprzewodowy monitoring drgań") and pair it with "Sonora" in every title, instead of bare "Sonora". → S

## What not to copy

- The pivot to "Industrial AI Agents" messaging on the home page blurs what the product physically does. Viezo should stay concrete (sensor + alerts).
- Gated report machinery (37 collateral items, 32 landing pages, Frost & Sullivan/Forrester studies) needs budget.
- An aggressive Cloudflare bot challenge on key pages may hurt crawlability. Viezo should not block crawlers or images (current robots.txt image block is the same type of problem).
- Thin asset pages (~250 words, benefit headings with no detail).
- A blog cadence of ~180 posts/year is unrealistic for Viezo.

## Sources

- https://www.augury.com/, /robots.txt, /llms.txt, /llms-full.txt, /sitemap_index.xml and sub-sitemaps (post, page, af-success-story, af-collateral, af-landing-page, af-webinar-event, af-media-center, af-podcast) (2026-10-14)
- https://www.augury.com/machine-health/, /success-stories/dupont-sees-rapid-value-and-high-roi-with-predictive-maintenance/, /use-cases/asset-condition-monitoring/condition-monitoring-for-industrial-bearings/, /pricing/ (2026-10-14)
- https://www.rfp.wiki/vendors/augury-machine-health (review aggregator, 2026-10-14)
- https://en.globes.co.il/en/article-israeli-machine-health-co-augury-raises-180m-1001388668 (2026-10-14)
