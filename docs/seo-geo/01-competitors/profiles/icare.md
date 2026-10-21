# I-care (Wi-care sensors + I-see platform)

- **Site:** https://www.icareweb.com
- **Checked:** 2026-10-14
- **Tier:** main
- **Overlap with Viezo:** high. Same core offer (wireless tri-axial vibration and temperature sensors, a cloud platform, and fault alerts on rotating equipment), a European vendor, and a full Polish site run by a Kraków subsidiary.

## Snapshot

| | |
|---|---|
| HQ / size | Mons, Belgium. Its July 2026 press release claims more than 1,000 staff and more than 35 offices in more than 15 countries. A Dec 2025 round valued it at about EUR 1bn. The Polish entity is I-care Polska sp. z o.o. in Kraków, registered 2011. |
| What they sell | Wi-care sensors (Wi-care 130 G23 named on the site, plus Wi-care Pure and the Wi-care Series). I-see is the AI/cloud platform. Also predictive maintenance as a service (a bundle of hardware, software and analysts), route-based services (vibration, IR thermography, ultrasound, oil, motor circuit analysis, motion magnification), lubrication, reliability engineering and training. |
| Positioning line | The `<title>` is "I-care: Predictive Maintenance & Asset Reliability Leader". The home H1 is "Changing the Way the World Performs" (it stays in English on /pl/). |
| Target industries | 12 industry pages: automotive, building material, chemical, energy, F&B, marine/offshore, mining, oil & gas, pharma, pulp & paper, steel and wind. |
| Pricing on site | None. CTAs are "Book a demo", "Get the datasheet" and "Talk to an expert". A separate shop.icareweb.com exists (not checked). |
| Languages | 8 (EN, DE, ES, FR-BE, IT, NL, PL, PT-PT). WPML with full hreflang and localised slugs, e.g. `/pl/rozwiazania/predykcyjne-utrzymanie-ruchu/uslugi/wibrodiagnostyka/`. |

## Site structure

WordPress (WPML, FacetWP, Gravity Forms, Yoast-style sitemap index). Sitemap counts:

- `page-sitemap`: 524 URLs, of which 65 are /pl/.
- `knowledge-sitemap`: 902 URLs. That is about 115 EN items, each translated into 7 languages (`/pl/zasoby/` has 113).
- `expert-sitemap`: 177 URLs, which works out to about 22 named expert author pages × 8 languages, e.g. `/experts/pieter-van-camp/`, `/pl/experts/...`.
- `training-sitemap`: 241 URLs. Video sitemaps hold 140 + 23 URLs.
- `post-sitemap`: 10 URLs (essentially unused; content lives in the `knowledge` post type).

The knowledge hub is split three ways:
- **8 types:** blog, events, expert-talks, infographics, solutions-insights, success-stories, technical-cases, whitepapers.
- **9 topics:** vibration-analysis, ultrasound, IR thermography, oil analysis, motor circuit analysis, motion magnification, lubrication, reliability, predictive-maintenance.
- **10 industries.**

Most URLs sit under `/knowledge/predictive-maintenance/<slug>/`. Solution pages live under `/solutions/predictive-maintenance/{hardware,software,services,predictive-maintenance-as-a-service}/`. There are also integration pages (`/pl/integracje/mvp-one/`, `dimomaint`, `mainti4`) and keyword-named PPC landing pages under `/ppc/` (e.g. `/ppc/iot-predictive-maintenance/`, `/ppc/predictive-maintenance-software-01`) that show up in search results.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | I-care: Predictive Maintenance & Asset Reliability Leader | Changing the Way the World Performs |
| Main product (hardware) | Predictive Maintenance IoT: Wireless Monitoring Sensors - Wi-care™ by I-care | A Game-Changer for Reliability |
| One case study | I-care's Wireless Monitoring Enhances BASF's Production Efficiency - I-care | same as title |
| One industry page | Automotive - I-care | Ensuring Uninterrupted Production |
| PL service page | Wibrodiagnostyka - I-care | Wibrodiagnostyka |

**Search terms they target.** Titles and meta descriptions carry the keywords ("predictive maintenance", "wireless monitoring sensors", "IoT"). The H1s are slogan-style. On the PL side they target "predykcyjne utrzymanie ruchu" and "wibrodiagnostyka", and their PL meta descriptions are fully translated.

## Content engine

- **Knowledge hub:** about 115 EN items, all translated into 7 languages. Lastmod dates show steady activity: more than 200 URL updates in Aug 2026 and 141 in Jul 2026, so they are refreshed or translated in batches.
- **Case studies:** success stories with named clients (BASF, Bayer Antwerp, Barry Callebaut, Lutosa, Chiyoda, Anthony Veder, Royal Cosun, AB InBev). The BASF story is about 990 words. It has a fixed structure: an Industry / Company Size header, then company context, challenge, solution and results, with 3 attributed quotes from a named engineer (name and job title).
- **Other formats:**
  - Webinars with opinion-led titles, e.g. "AI won't fix your reliability issues — field expertise might" and "More data isn't the answer…".
  - Expert talks and infographics.
  - Gated whitepapers and datasheets ("Get the datasheet").
  - Reliability Days events and a training catalogue.
- **Not seen:** glossary, calculator and comparison pages.

## Proof and trust

- **Client names:** BASF, Bayer, AB InBev (their "largest contract ever", covering more than 50 countries, per a BusinessWire release in Nov 2023), Barry Callebaut, Royal Cosun.
- **Hardware claims:** "Results within 15 minutes", "5-year battery life", tri-axial measurement, ATEX certification.
- **G2:** "I-care Group" is listed at 4.0/5 from 3 reviews; the separate seller page shows 0 reviews (not verified directly).
- **Capterra:** lists the "I-see" platform; the rating and review count were not visible (not verified).

## Technical and structured data

- **JSON-LD:**
  - Home has one @graph with Organization, ProfessionalService (with PostalAddress, GeoCoordinates and OpeningHoursSpecification), WebSite and ContactPoint.
  - Inner pages have only WebPage and BreadcrumbList.
  - No Product schema on the hardware page and no Article schema on case studies.
- **llms.txt:** none (404).
- **robots.txt:** explicitly allows AI and user agents (ChatGPT-User, OAI-SearchBot, Claude-User, Claude-SearchBot, PerplexityBot, Perplexity-User, Applebot, Amazonbot, DuckAssistBot, Meta-ExternalFetcher, Operator, NovaAct, cohere-training-data-crawler). It blocks facet URLs, `/industry/`, `/region/` and PDFs (`Disallow: /*.pdf$`), so whitepapers are not crawlable.
- **Other:** gzip; server-rendered HTML that is readable without JS; full hreflang across 8 locales plus x-default. Page weight is heavy (home is about 1 MB of HTML uncompressed).

## Off-site authority

- **Wikipedia / Wikidata:** no article or entity found. A Wikidata search for "I-care Group" returned nothing, and "I-care" is swamped by unrelated song titles, which is the same disambiguation problem Viezo has.
- **Press:** BusinessWire releases (AB InBev, the Sensirion asset acquisition in Jul 2024, the US subsidiary investment in Jul 2026); unicorn coverage (Techleap, Silicon Canals).
- **Other:** trade-show exhibitor listings, and a Polish employer listing on aplikuj.pl.
- **YouTube:** not checked directly, but the video sitemap has 163 entries.

## AI visibility (manual)

To fill during monthly tracking.

## What Viezo can learn

1. **They publish one PL service page per diagnostic method.** `/pl/.../uslugi/wibrodiagnostyka/` has a matching PL title, H1 and meta description, and there are 6 sibling method pages. → Viezo should build 4-6 PL+EN "method/fault" pages, e.g. "Wibrodiagnostyka łożysk", "Niewyważenie wentylatora" and "Uszkodzenia przekładni". Each should have a keyword H1 and link to the matching case studies. Effort: M.
2. **Their case studies follow a fixed template.** The header carries Industry and Company size, followed by challenge, solution, results and named quotes, at about 990 words for BASF. → Viezo should expand its top 10 of 30 case studies (median 152 words) to 400-600 words. Add an Industry / Machine / Fault / Detected-before-failure header, a quote with the client's name and role, a results number, and Article schema. Effort: M.
3. **They run a taxonomy hub.** Knowledge is split into type × topic × industry, with crawlable archive pages such as `/knowledge/predictive-maintenance/vibration-analysis/`. → Viezo should tag its 30 case studies by industry and fault, and publish filterable archive pages like `/case-studies/bearing-wear/` and `/pl/.../przemysl-meblarski/`. This turns thin pages into topical clusters. Effort: S-M.
4. **They have named expert author pages.** There are about 22 experts in 8 languages. → Viezo should create 2-3 author/engineer pages with credentials (e.g. ISO 18436 category, years of experience) and link them as `author` from blog posts and case studies. This is a cheap E-E-A-T signal that AI answers pick up. Effort: S.
5. **Their robots.txt explicitly allows AI agents** with a named allowlist. → Viezo should copy this pattern, fix its own image block, and add llms.txt. That would put Viezo ahead of I-care, which has no llms.txt. Effort: S.
6. **Their webinar titles are opinion-led** ("More data isn't the answer…"). → Viezo should write 3-4 PL/EN opinion posts aimed at mid-size plants, e.g. "Czy fabryka mebli potrzebuje monitoringu drgań?" and "Wireless vs route-based: when is it worth it?". AI answers quote this kind of post. Effort: S each.
7. **Pricing gap:** I-care has no public pricing. Viezo's setup builder is a differentiator. Give it a crawlable explainer page (e.g. "Ile kosztuje monitoring drgań?") with example configurations in text. Effort: S.

## What not to copy

- Translating the full 900-URL hub into 8 languages and keeping a 177-URL expert sitemap only works with an enterprise marketing team. Viezo should stay EN+PL and focus on depth.
- Slogan H1s ("Changing the Way the World Performs", "Ensuring Uninterrupted Production") waste the H1, and the home H1 is left in English on /pl/.
- They block PDFs in robots.txt and gate whitepapers, which hides their best technical content from AI.
- `/ppc/` keyword landing pages compete with their own canonical pages.
- Inner pages carry only WebPage/Breadcrumb schema, with no Product or Article markup.

## Sources

- https://www.icareweb.com/ , /pl/ , /robots.txt , /llms.txt (404) (2026-10-14)
- https://www.icareweb.com/sitemap_index.xml and child sitemaps (page, knowledge, expert, training, video, knowledge-types/topics/industries) (2026-10-14)
- https://www.icareweb.com/solutions/predictive-maintenance/hardware/ (2026-10-14)
- https://www.icareweb.com/knowledge/predictive-maintenance/success-story-basf/ (2026-10-14)
- https://www.icareweb.com/industries/automotive/ (2026-10-14)
- https://www.icareweb.com/pl/rozwiazania/predykcyjne-utrzymanie-ruchu/uslugi/wibrodiagnostyka/ (2026-10-14)
- https://www.g2.com/products/i-care-group/reviews ; https://www.capterra.com/p/10045367/I-see/ (via search, 2026-10-14)
- https://www.businesswire.com/news/home/20231108691200/en/ (AB InBev) ; https://www.aplikuj.pl/pracodawca/365030/i-care-polska-sp-z-o-o (2026-10-14)
- Wikidata API search "I-care Group" (2026-10-14)
