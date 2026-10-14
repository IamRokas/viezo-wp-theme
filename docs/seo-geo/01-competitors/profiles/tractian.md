# Tractian (Smart Trac sensors + CMMS)

- **Site:** https://tractian.com
- **Checked:** 2026-10-14
- **Tier:** main
- **Overlap with Viezo:** high. Wireless vibration (+ultrasound) sensors with AI fault alerts, sold to the same maintenance buyers. Tractian adds a CMMS and is much larger (US/LatAm).

## Snapshot

| | |
|---|---|
| HQ / size | US + Brazil (founders Igor Marinelli, Gabriel Lameirinhas). $120M Series C led by Sapphire Ventures, around Dec 2024 to Jan 2025 (press). Site claims "Trusted by 2,000 U.S. and global manufacturers" |
| What they sell | Smart Trac vibration + ultrasound sensor, Energy Trac, condition-monitoring software, AI CMMS, OEE, APM, AI agents. Cellular connectivity ("no IT tickets") |
| Positioning line | Home has no `<h1>`. Hero text reads "Protect Your Operations. Cut Unplanned Downtime." and the title is "Tractian \| Unified Asset Health" |
| Target industries | 11 `/en/industry/` pages: manufacturing, chemical, mills & agriculture, F&B, automotive, mining, oil & gas, heavy equipment, data centers, government/defense (FedRAMP High), facilities |
| Pricing on site | `/en/solutions/condition-monitoring/vibration-sensor/pricing` (H1 "Machine Health Sensor Price", "3-Month Payback"), "Calculate your price" CTA on the home page, 2 ROI calculators. No price is visible in the static HTML (not verified whether JS shows one) |
| Languages | PT-BR (root, 280 URLs), EN (`/en`, 496 URLs), ES (`/es`, 250 URLs). Separate sitemaps per language. **No hreflang tags** found |

## Site structure

Sitemaps are `sitemap.xml` (PT), `sitemap-en.xml` and `sitemap-es.xml`, and all are linked from robots.txt. EN breakdown (496 URLs):

- `/en/who-we-serve/` has **228 URLs**. These are programmatic pages for 8 roles (plant manager, maintenance manager, planner, technician, VP ops…) × industry × topic, e.g. `/who-we-serve/maintenance-manager/manufacturing/kpi`. Each is about 2,500 words and answers one question in its H1.
- `/en/blog/` has 114 URLs in the sitemap, including podcast (10), videos (9) and authors (10). The on-site blog looks larger than the sitemap (not verified).
- `/en/resources/` has 45 URLs: 18 spreadsheet templates (FMEA, RCM, GUT matrix, budget…), 16 checklists, 6 calculator URLs (ROI for online condition monitoring and asset management, plus maintenance calculators).
- `/en/guides/` has 21 long guides (predictive maintenance, vibration monitoring & analysis, electric motors, bathtub curve, vibration sensor buyer's guide, Verdantix study).
- `/en/solutions/` has 28 URLs (condition-monitoring 11, OEE 10, CMMS 3, APM).
- `/en/industry/` has 11, `/en/case-studies/` has only 3 EN (Yara, Ingredion, ICL), and PT `/casos-de-estudo/` has 12.
- `/en/competitors/` has `tractian-vs-augury` and `tractian-vs-waites`.
- `/en/glossary/` is **not in the sitemap** but is live and paginated (about 20 terms per page, e.g. anomaly-detection, alert-fatigue, acoustic-imaging). The total term count is not verified.
- `/en/assets` is "The Maintenance Search Engine", a programmatic library of OEM asset/manual pages (e.g. motor model pages). Size not verified.
- Other pages: `/en/maintenance-maturity-test` (an interactive assessment), `/en/guided-tour`, `/en/patents`, `/en/labs`, and Academy at academy.tractian.com.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Tractian \| Unified Asset Health | none |
| Main product | Advanced Condition Monitoring Software for Failure Detection | Tractian VIBRATION + ULTRASOUND SENSOR |
| One case study | Yara International saves millions using Condition Monitoring | How Yara International's Maintenance Set the Standard for Efficiency and Profitability |
| One industry page | Mining Condition Monitoring & Maintenance Software | Mining Condition Monitoring & Maintenance Software (H1 duplicated) |
| Comparison | Tractian vs Augury - See Why Teams Are Switching Today! | Tractian vs. Augury |
| Glossary term | Anomaly Detection: Definition, Methods and Industrial Applications | same |
| Role page | Fundamental KPIs — Maintenance Manager in Manufacturing | What Are the Key KPIs for a Maintenance Manager in Discrete Manufacturing? |

Target terms include "condition monitoring software", "[industry] condition monitoring / maintenance software", "vibration sensor price", "X alternative" / "X vs Y", definitional "what is …" (glossary), and role-specific KPI and career questions.

## Content engine

- Long-form at scale. Case study, comparison, glossary and role pages run about 2,000 to 3,000 words each.
- Case studies are few but deep. The Yara page is 2,582 words with 9 H2s and ROI/payback numbers. The llms.txt industry blurbs repeat hard numbers ("around 400% ROI, 23-day payback, 112 extra availability hours per plant").
- Free tools act as link and lead magnets: 18 templates, 16 checklists, ROI calculators and a maturity test.
- Glossary term pages are about 3,000 words with **FAQPage** schema and a definition-first meta description ("Anomaly detection is the automatic identification of…").
- Formats also include a podcast, videos, events, a G2/Verdantix study page and product release notes (blog category "releases").

## Proof and trust

- Named logos and case studies: Yara, Ingredion, ICL (EN), and Brazilian clients (CLI Santos, Inpasa) in PT.
- G2: about **4.7/5 from ~50 to 53 reviews** (G2 product/compare pages via search, 2026-10). G2 Winter 2026 "Leader" in Industrial IoT and Asset Management (vendor blog). Some reviews are flagged as incentivized.
- Third-party study: Verdantix "Verified Value Delivery Study" has its own page and guide.
- FedRAMP High authorization (government page), a Trust Center at trust.tractian.com, and a patents page.

## Technical and structured data

- JSON-LD on every page: Organization, ContactPoint, ImageObject, and **Product with AggregateRating 4.7 / ratingCount 200**. The same block appears site-wide, and the count does not match G2's ~53. Glossary terms add FAQPage, Question and Answer.
- **llms.txt: yes**, 19.4 KB and 118 lines. It is curated by section (Main, Company, Products, Industries with ROI numbers, Product Comparisons, Free Resources, Maintenance Concepts, Trust & legal, Sitemaps) and says "Prefer English pages under /en". It is also listed in the sitemap.
- robots.txt is `Allow: /` with no AI-crawler rules. Only thank-you, registration and /api are disallowed.
- The stack is Next.js behind Cloudflare with gzip. HTML is heavy: 250 to 780 KB per page (comparison page 779 KB).
- No hreflang despite 3 language versions. The home page has no H1, and the industry page repeats its H1.

## Off-site authority

- Wikipedia: no article found (search, 2026-10-14). Wikidata not verified because the API was rate-limited.
- G2: ~53 reviews, 4.7. GetApp listing exists. Capterra count not verified.
- Press: Series C coverage (Sapphire/General Catalyst/NGP), plus FedRAMP news via Knox.
- YouTube, podcast and Academy exist (channel stats not verified).

## AI visibility (manual)

To fill during monthly tracking. Expect citations of glossary terms, guides and `/competitors/` pages for "best vibration monitoring" / "Augury alternative" prompts.

## What Viezo can learn

1. **Glossary with definition-first pages.** Tractian runs a live `/en/glossary/` (≈20 terms/page, paginated) where each term is about 3,000 words with FAQPage schema and the definition in the meta description. **Viezo:** build a 20 to 25 term EN/PL glossary from Viezo's own fault vocabulary (bearing wear, imbalance, misalignment, looseness, gearbox fault, ISO 10816/20816, RMS velocity, envelope analysis, MEMS vs piezo). Each page gets a 2-sentence definition, a "how Sonora detects it" section and links to matching case studies. Use 600 to 1,000 words, not 3,000. Put every page in the sitemap, which Tractian fails to do. → M
2. **Comparison pages.** Tractian publishes `tractian-vs-augury` and `tractian-vs-waites` (~2,000 words, "alternative" in the meta description). **Viezo:** write 2 honest pages: "Sonora vs Tractian" and "wireless vibration monitoring: Viezo vs portable/route-based measurement". Use a feature table, EU support/GDPR, local install in LT/PL and the public price builder. → M
3. **Industry pages with hard numbers in llms.txt.** Tractian's llms.txt industry lines carry ROI, payback days and hours avoided. **Viezo:** create llms.txt with a one-line summary per industry (furniture/wood, automotive, food) that cites aggregated numbers from the 59 case studies (e.g. "N bearing faults caught early at furniture plants"). → S
4. **Deeper flagship case studies.** Tractian has only 3 EN case studies, each about 2,600 words with ROI and named clients. **Viezo:** keep the 59 short ones but expand 3 (Volkswagen Polska, IMA Schelling, one furniture maker) into full stories with challenge → install → detected faults → € / hours saved. Change titles from "FAN BEARING WEAR" to "How [client] caught fan bearing wear N weeks early". → M
5. **Promote the price builder like Tractian's pricing page.** Tractian has a dedicated pricing URL in llms.txt, "Calculate your price" on the home page and ROI calculators. **Viezo** already has a public setup builder, which Tractian doesn't fully expose. Give it a descriptive title ("Vibration monitoring price calculator – Sonora"), link it from the home hero and llms.txt, and add a simple ROI/downtime-cost calculator. → S
6. **Product schema.** Tractian has Organization + Product JSON-LD site-wide. **Viezo:** add Organization (with `sameAs`, legal name UAB Viezo, and disambiguation from viezo.com) and Product "Sonora" schema. → S

## What not to copy

- **Self-asserted AggregateRating** (4.7 / 200 ratings on every page while G2 shows ~53). This risks a Google review-snippet policy violation and destroys trust if noticed.
- 228 programmatic role × industry pages and the OEM asset "search engine" need content ops at scale and carry thin-content risk for a small team.
- Missing hreflang across PT/EN/ES and no home-page H1. Viezo should implement EN/PL hreflang properly.
- Heavy Next.js pages (300 to 780 KB HTML).
- An aggressive comparison tone ("See Why Teams Are Switching Today!").

## Sources

- https://tractian.com/en, /robots.txt, /llms.txt, /sitemap.xml, /sitemap-en.xml, /sitemap-es.xml (2026-10-14)
- https://tractian.com/en/solutions/condition-monitoring, /en/case-studies/yara-international, /en/industry/mining-sector, /en/competitors/tractian-vs-augury, /en/who-we-serve/maintenance-manager/manufacturing/kpi, /en/pricing, /en/glossary, /en/glossary/anomaly-detection, /en/assets, /en/blog (2026-10-14)
- https://www.g2.com/products/tractian-tractian/reviews (via search, 2026-10-14)
- https://tractian.com/en/blog/g2-winter-2026-reports-tractian-sets-standard-for-asset-management-industrial-iot (2026-10-14)
- https://www.foley.com/?p=110769 (Series C, 2026-10-14)
