# Sensoteq (Kappa X, Tau-E, Chi, Analytix)

- **Site:** https://www.sensoteq.com (sensoteq.com serves the same content; robots points to www)
- **Checked:** 2026-10-14
- **Tier:** main
- **Overlap with Viezo:** high. A European (UK) scale-up with almost the same offer: wireless vibration sensors, a gateway and a cloud platform for the same asset types. Company size and story are closest to Viezo of this group.

## Snapshot

| | |
|---|---|
| HQ / size | Belfast, Northern Ireland, UK. Raised £3.1M in Nov 2023 (led by Maven Capital, plus TechStart) and a £500k Whiterock loan in early 2023. Blog post "recruitment drive as Sensoteq aims for £100m" |
| What they sell | Kappa X wireless vibration sensor (10 kHz Fmax, 64 g, IP69K, replaceable battery 5+ yrs), Tau / Tau-E (mineral processing, slow speed), Chi (Bluetooth sensor kits for route-based analysts), Gateway, Analytix software, Onsite app |
| Positioning line | H1 "Revolutionising Machine Health Monitoring". Title "Sensoteq \| Wireless Industrial Sensing Solutions" |
| Target industries | 9 solution pages: manufacturing, automotive, pharmaceutical, power generation, food & beverage, mining & aggregates, waste management, oil & gas, (+ hub) |
| Pricing on site | **Yes for Chi kits:** Wix store with 4 Chi kits (e.g. "Chi 2 Sensor Kit" $2,750.00, with Product/Offer schema). Kappa X / Analytix: "Get Started" contact only |
| Languages | EN only (hreflang en-gb + x-default) |

## Site structure

Wix site. Sitemap index with 6 child sitemaps:
- pages: **32** (products ×6, solutions ×9, knowledge-hub, reliability-maturity-assessment, events, legal, careers)
- blog-posts: **55** under `/post/<slug>`. Categories: learning, webinars, product-updates, case-studies. Lastmods: 39 in 2024 (probably a re-save), 12 in 2025, 4 in 2026
- event-pages: 20
- store-products: 4 (Chi kits)
- `/knowledge-hub`: FAQs, product guides and manuals, specifications, release notes, global compliance, recycling
- `/reliability-maturity-assessment`: self-assessment tool (about 200 words of text, rendered by a widget)
- Case studies live inside the blog (`/post/kappa-x-saves-food-production-factory-from-costly-shutdown`). There is no separate case-study URL type

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Sensoteq \| Wireless Industrial Sensing Solutions | Revolutionising Machine Health Monitoring |
| Main product | Kappa X \| Sensoteq | Kappa X |
| One case study | Kappa X Saves Food Production Factory from Costly Shutdown | same |
| One industry page | Food & Beverage Condition Monitoring \| Sensoteq | **none** |

Most pages are named after the brand or product. Only the solution pages target generic terms ("<industry> condition monitoring"). The product, knowledge hub and maturity pages have **no meta description**, and industry pages have no H1. Blog slugs target "wireless condition monitoring system", "sub-gigahertz", "frequency is everything vibration", "automated vs manual vibration diagnosis".

## Content engine

- Blog (55): a mix of case studies (about 15, product-led: "Kappa X prevents catastrophic and costly failure at power plant", "Sensoteq solutions 90k savings", "Lime kiln case study"), product insights and how-tos (mounting, gateway setup), learning pieces ("What to consider when choosing a wireless condition monitoring system", "When to go wireless and when not", "Self-resonance in sensor design", "Data quality over quantity"), team profiles and news
- Case-study depth: the food factory story is about 900 words and includes a money figure (£42,000)
- Cadence is low: about 1 post/month in 2025, 4 in 2026 so far
- Tools: reliability maturity assessment, online store. Knowledge hub = support documentation (manuals, specs, compliance)
- Webinars category. No glossary, no comparison pages, no calculator

## Proof and trust

- Case studies with £/$ savings (£42k, "90k savings") and industry context (cement mill, offshore oil rig, petrochemical, quarry in South America)
- Partner: RMS (reliability services) co-launch
- Finalist, Technology Business Awards 2021. EASA 2021 exhibitor
- Hardware certifications in the compliance section (IP69K, ATEX variants: not verified in detail)
- G2/Capterra: no listing found

## Technical and structured data

- JSON-LD: home **LocalBusiness + PostalAddress + WebSite**. Blog posts **BlogPosting + Person + ImageObject + Organization** (Wix default). Store pages **Product + Offer + Brand + VideoObject**. Solution and product pages: **none**
- llms.txt: **yes, but Wix auto-generated.** A generic summary that mentions privacy policies, plus instructions for the Wix site MCP endpoint (`/_api/mcp`). No curated content links
- robots.txt: Wix default (allow all, blocks PetalBot, crawl-delay for Ahrefs/dotbot). No AI-bot rules
- Pages are very heavy: HTML 0.8–1.5 MB per page (Wix runtime)
- CMS: Wix

## Off-site authority

- Wikipedia/Wikidata: none found
- Press: UKTN, Tech Funding News, BINDT (British Institute of NDT) news, Belfast City Council "Invest in Belfast", News Letter (NI). All about funding
- Data profiles: CB Insights, tech.eu, Techleap
- G2/Capterra: none found
- Events: 20 event pages (trade shows, e.g. FMF 2025 launch of Tau-E)

## AI visibility (manual)

To fill during monthly tracking.

## What Viezo can learn

1. **Regional funding/press story as off-site authority.** All of Sensoteq's notable press is local and trade coverage of one funding round (UKTN, BINDT, Belfast council). → Viezo can pitch its EU-funding and client stories to Lithuanian and Polish trade/tech media (e.g. Verslo žinios, Inżynieria i Utrzymanie Ruchu, Utrzymanie Ruchu portal) and to Invest Lithuania/Enterprise Lithuania success-story pages. These are the third-party mentions AI answers rely on. → M
2. **Knowledge hub with specs and FAQs.** /knowledge-hub collects FAQs, manuals, specs and compliance in one indexable place. → Viezo publishes a Sonora specs page (sensor range, battery, IP rating, connectivity, mounting) in HTML, plus an FAQ of 10–15 questions with FAQPage schema, EN/PL. AI often answers "what is the battery life / frequency range of X" from such pages. → S/M
3. **Public price on at least one item.** Sensoteq lists Chi kits at $2,750 with Product/Offer schema. → Viezo's setup builder already prices Sonora. Add a static "from € X per sensor / per month" line to the Sonora page and Product + Offer schema, so crawlers (which do not run the builder JS) see a price. → S
4. **Self-assessment tool.** The reliability maturity assessment is a lead magnet and a linkable asset. → A simple 8-question "Is your plant ready for vibration monitoring?" quiz in EN/PL could feed the setup builder. → M (optional, after basics)
5. **"When not to go wireless" honesty content.** Both Sensoteq ("When to go wireless and when not") and Petasense have it. → Viezo writes one balanced EN/PL article; this kind of content is often cited in comparison-style AI answers. → S

## What not to copy

- Case studies buried as blog posts with no fixed structure or case-study URL type (Viezo's separate case-study CPT is better: keep it)
- The auto-generated Wix llms.txt: generic, mentions privacy and recruitment, lists no products or cases. A hand-written one is better
- Pages of 1+ MB, solution pages without an H1, product pages without a meta description
- Event pages (20) that add crawl volume but no lasting search value

## Sources

- https://www.sensoteq.com/ , /products/kappa-x , /solutions/food-beverage , /knowledge-hub , /reliability-maturity-assessment , /product-page/sensoteq-chi-2-sensor-kit , /post/kappa-x-saves-food-production-factory-from-costly-shutdown (2026-10-14)
- https://sensoteq.com/robots.txt , /llms.txt , https://www.sensoteq.com/sitemap.xml + 6 child sitemaps (2026-10-14)
- https://www.uktech.news/tech-hubs/northern-ireland/belfast/sensoteq-funding-20231114 , https://www.bindt.org/News/february-2024/sensoteq-nets-3-1-million-for-monitoring-sensors/ , https://belfastcity.gov.uk/investinbelfast/connections/news/belfast-sensor-company-bags-£3m-investment-from-ma (via search, 2026-10-14)
- https://www.newsletter.co.uk/business/sensoteq-secures-ps500k-funding-with-plans-to-create-10-new-jobs-4006044 (via search, 2026-10-14)
- Wikipedia/Wikidata API search "Sensoteq": no results (2026-10-14)
