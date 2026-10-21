# IoTFlows (SenseAi, SenseAi Embedded, BeamTracker)

- **Site:** https://www.iotflows.com
- **Checked:** 2026-10-14
- **Tier:** additional
- **Overlap with Viezo:** medium. SenseAi is a magnetic vibration and acoustic sensor with predictive-maintenance health scores, but the main pitch is manufacturing intelligence (OEE, utilization, downtime, scheduling, CMMS) for US discrete manufacturers. It overlaps with Viezo on "machine monitoring / predictive maintenance" queries, not on deep vibration diagnostics.

## Snapshot

| | |
|---|---|
| HQ / size | Atlanta, GA, US (Organization schema address). Small startup; size not verified. "Used by 100+ industrial manufacturers" (claim) |
| What they sell | SaaS + sensors: SenseAi (magnetic-mount AI sensor, vibration/acoustic, "2-minute install"), SenseAi Embedded, BeamTracker (laser-based part counting), platform modules for OEE, downtime root cause, scheduling, work orders (CMMS), alerts, ERP integration |
| Positioning line | H1 "The Real-Time Manufacturing Intelligence Platform". Title "AI-Powered Industrial IoT Platform \| Machine Monitoring & Predictive Maintenance" |
| Target industries | Discrete manufacturing: CNC/machining, injection molding, packaging, food packaging, electronics, mining equipment manufacturing |
| Pricing on site | **Yes, fully public:** /products/senseai/pricing. Pro $119/device/mo, Enterprise $249/device/mo, discounts for annual and 3-year billing. Pricing pages also exist for each product. Online shop (/shop/products, /shop/accessories). /legal/fee-schedule |
| Languages | EN only, no hreflang |

## Site structure

Next.js. Sitemap index → 2 sitemaps:
- sitemap-site: **19** URLs. For each product: overview + `/specs` + `/pricing` (3 products). One solution page (`/solutions/predictive-maintenance`), shop, about, support, legal
- sitemap-docs: **142** URLs. **132 product docs** (`/docs/production|monitoring|hardware|admin|maintain|messaging|inventory|alerts/…`) and **8 customer stories** (`/customers/<company>`) + hub
- Blog on a subdomain: blog.iotflows.com (Ghost), **16 posts**, mostly OEE ("What is OEE", "How to calculate OEE", "Top OEE monitoring tools", "SCADA vs newer technologies", "Machine protocols"). `www.iotflows.com/blog` returns 404, and the blog is not linked from llms.txt
- No industry pages, glossary or comparison pages on the main domain

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | IoTFlows - AI-Powered Industrial IoT Platform \| Machine Monitoring & Predictive Maintenance | The Real-Time Manufacturing Intelligence Platform (×2) |
| Main product | SenseAi: AI Machine Monitoring \| Reduce Downtime 30% \| IoTFlows | SenseAi / Transform the way you work / FAQ (3 H1s) |
| One case study | Ranpak: Blueprint for Global Excellence - When One Facility Proves the Model for Thousands | Customers / Ranpak / (title) |
| Solution page | Predictive Maintenance Software \| AI-Powered Machine Health Monitoring \| IoTFlows | Predictive Maintenance Powered by AI |
| Pricing | SenseAi Pricing - Pro & Enterprise Plans \| IoT Machine Monitoring | Simple, transparent pricing |

The pricing meta description says "SenseAi pricing starts at $119/device/mo…". That answers "how much does X cost" directly in the snippet. Keywords they target: machine monitoring, predictive maintenance software, OEE tracking, downtime root cause, bearing fault detection, vibration analysis.

## Content engine

- Customer stories: **8**, long (Ranpak about 2,600 words) with H2s "Key Results / The Stakes / The Challenge / The Solution", named companies (Datwyler, Ranpak, Hilco Vision, Jesel, Sorinex, Storm Power Components, Criollos Foods, RNPSA) and numbers ("50% less shift changeover downtime", "double machine utilization")
- Product documentation: 132 public, indexable help pages. This is a large body of crawlable "how it works" text
- Solution page (predictive maintenance) is long, with sections such as "14+ vibration analysis metrics", "Envelope kurtosis analysis", "Health indicator color zones", plus a 5-question FAQ
- SenseAi page has a **20-question FAQ** (FAQPage schema)
- Blog: 16 posts on a subdomain, OEE-led. No glossary, no calculators

## Proof and trust

- Logos and named customer stories (8). Homepage claims: "Reduce downtime by 30%", "ROI in under 3 months", "100+ manufacturers"
- **G2: 2 reviews, 5.0** (both 2022, marked incentivized). Capterra: no listing found (a different product called "SensIa" appears there)
- On-site schema declares **AggregateRating 4.8 from 314 reviews** (SenseAi product) and **4.8 from 127 ratings** (home). Neither matches any public review source, and the two contradict each other. This risks Google's self-serving review rules
- iOS app on the App Store

## Technical and structured data

- JSON-LD is the richest of this group. Home: Organization, PostalAddress, ContactPoint, SoftwareApplication, Offer, AggregateRating. SenseAi: Product, Brand, Offer, AggregateRating, Audience, FAQPage (20 Q). Predictive maintenance page: SoftwareApplication, Offer, FAQPage (5 Q), many customer Organizations with Country. Pricing: Product + 2 Offers. Customer stories: **none**
- llms.txt: **yes, very large (82 KB, 155 links).** Structure: summary → Website → Documentation (by module) → Customers (each with industry and measured result) → Optional. **139 links point to `.md` versions of pages** (e.g. `/customers/ranpak.md` returns `text/markdown` with YAML front matter: title, description, company, industry). This is the most advanced GEO setup in this group
- robots.txt: allow all, Sitemap line. No AI-bot rules
- Next.js pages are heavy (0.9–1.4 MB HTML with inline RSC payload), gzip
- Several H1s per page

## Off-site authority

- Wikipedia/Wikidata: none
- G2 (2 reviews), App Store listing
- Own Ghost blog on a subdomain. Press coverage not verified (no notable third-party coverage found in search)

## AI visibility (manual)

To fill during monthly tracking. Test whether AI cites their pricing ("how much does predictive maintenance sensor cost per month").

## What Viezo can learn

1. **Markdown mirrors plus a rich llms.txt.** IoTFlows lists 139 pages as `.md` URLs with front matter (title, company, industry, result), so LLMs get clean text. → Viezo generates llms.txt from WordPress (Sonora, pricing, industries, all 30 case studies (each in EN + PL), each line "Client – industry – fault – result") and optionally a `?format=md` / `.md` endpoint for case studies via a small theme route. → S (llms.txt) / M (md endpoint)
2. **Pricing that crawlers can read.** IoTFlows has a /pricing page with prices in plain text, the meta description and Offer schema ("starts at $119/device/mo"). → Viezo's setup builder is JS. Add a static intro on the pricing page with "from €X/sensor" ranges in EN/PL, a meta description that includes the price, and Product + Offer schema. → S
3. **FAQ blocks on product pages.** SenseAi has 20 Q&As with FAQPage schema (install time, battery, connectivity, what faults). → Add 8–12 FAQs to the Sonora page in EN/PL (e.g. "Which faults does Sonora detect?", "How long does the battery last?", "Does it need Wi-Fi?"). Each answer should be 1–3 sentences so AI can extract it. → S
4. **Separate /specs page per product.** IoTFlows has a `/products/<x>/specs` page for each product. → Viezo adds a "Sonora technical specifications" page (HTML table, not a PDF), a frequent source for AI answers on spec questions. → S
5. **Indexable help docs as long-tail content.** 132 public docs pages cover install, alerts and dashboards. → Viezo can publish 5–10 short "How to install / How alerts work / Reading the Sonora dashboard" pages. Useful for both customers and AI. → M

## What not to copy

- Self-declared AggregateRating (4.8/314 vs 4.8/127) with no public source. Viezo should only add review markup backed by real, visible reviews
- Moving the blog to a subdomain and leaving it out of llms.txt and the main sitemap
- Several H1s per page; 1+ MB pages
- The broad "manufacturing intelligence / OEE" pitch blurs the vibration message. Viezo should stay specific to vibration monitoring and fault detection

## Sources

- https://www.iotflows.com/ , /products/senseai , /products/senseai/pricing , /solutions/predictive-maintenance , /customers/ranpak , /customers/ranpak.md , /blog (404) (2026-10-14)
- https://www.iotflows.com/robots.txt , /llms.txt (82 KB) , /sitemap.xml , /sitemap-site.xml , /sitemap-docs.xml (2026-10-14)
- https://blog.iotflows.com/sitemap-posts.xml (2026-10-14)
- https://g2.com/products/iotflows/reviews (via search, 2026-10-14)
- Wikipedia/Wikidata API search "IoTFlows": no results (2026-10-14)
