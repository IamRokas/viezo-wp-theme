# Schaeffler (OPTIME)

- **Site:** https://www.schaeffler.com (OPTIME itself lives on https://medias.schaeffler.com/en/monitor/optime-condition-monitoring)
- **Checked:** 2026-10-14
- **Tier:** main
- **Overlap with Viezo:** high on product, low on web presence. OPTIME is the closest analogue to Sonora: wireless battery vibration sensors, a gateway and an app, aimed at the "balance of plant" (fans, pumps, motors), with plug-and-play installation and a low price per measuring point.

## Snapshot

| | |
|---|---|
| HQ / size | Herzogenaurach, Germany. Global automotive and industrial supplier, very large. |
| What they sell (CM) | OPTIME sensors, gateway and app (launched 2020), with mesh networking; data goes to Schaeffler's IoT Hub. The "OPTIME Ecosystem" also takes in SmartCheck and ProLink data. Add-ons are OPTIME E-CM (electrical monitoring of 3-phase motors) and the OPTIME C1 wireless lubricator. There is a REST "Optime Customer API" on developer.schaeffler.com. Marketed as part of "Schaeffler Lifetime Solutions" (formerly the Industry 4.0 portfolio). |
| Positioning line | Trade press and Schaeffler material: "condition monitoring cost-effective for all plant assets". Up to 50% cheaper than manual offline monitoring, several hundred measuring points set up in one day, 120-5000 rpm (vendor claims, not verified on the product page). |
| Target industries | Manufacturing, F&B, pulp & paper (Stora Enso), cement (Finnsementti), mining, energy, HVAC. |
| Pricing on site | Not verified; the product page content could not be retrieved. No public pricing was found in search. |
| Languages | schaeffler.com is EN/DE. Country sites such as schaeffler.pl are PL + EN. medias is offered in many locales (medias.schaeffler.pl exists). |

## Site structure

- **OPTIME is not on the corporate site.** It does not appear in the navigation or body of schaeffler.com home, `/divisions-products/` or `/divisions-products/industrial/` (H1: "Rolling bearing solutions for over 60 sectors of industry"). CM content is split across several properties:
  - **medias.schaeffler.com/.de/.pl** is the eCommerce catalogue (SAP Commerce). The OPTIME page sits at `/{lang}/monitor/optime-condition-monitoring`.
  - **medias-at.schaeffler.com/de/industrial-blog/optime** is a blog article.
  - **developer.schaeffler.com/use-cases/schaeffler-optime** is the API docs (returned 406 to curl).
  - **schaeffler.com/remotemedien/...pdf** holds customer success stories as PDFs, e.g. `customer_success_story_0158_de_en.pdf`, and TPI publications.
  - **schaeffler.pl/pl/produkty-i-rozwiazania/przemysl/lifetime-solutions/** is a PL country page.
- **Sitemaps:** www.schaeffler.com/sitemap.xml returns 403. medias robots.txt points to ecommerce.schaeffler.com/sitemap.xml, which also returns 403. URL counts are not verified.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home (schaeffler.com/en/) | Schaeffler Group | (none detected) |
| Main product (medias OPTIME) | Schaeffler eCommerce Industrial (generic, in raw HTML) | (none in raw HTML) |
| PL Lifetime Solutions | Lifetime Solutions \| Schaeffler Polska | Schaeffler Lifetime Solutions |
| Industrial division | Bearings & Industrial Solutions \| Schaeffler Group | Rolling bearing solutions for over 60 sectors of industry |

- **Weak search targeting on own pages.** Ranking for "OPTIME" is left to the brand name, trade press and distributors.
- **The PL page is mixed-language.** The H1, intro, the "Condition Monitoring" card and the CTAs are in **English** on schaeffler.pl, and the term "monitorowanie stanu" does not appear.

## Content engine

- **Blog:** an industrial blog on medias (OPTIME explainer article).
- **Case studies:** PDF-only "customer success stories" (e.g. Schweinfurt plant with 31 OPTIME sensors on hardening-area fans; Stora Enso Sunila; Finnsementti). Polish versions exist only as **distributor PDFs** on Albeco (albeco.com.pl, e.g. `prezentacja-handlowa-optime-pl.pdf`, `case-study-pulppaper---stora-ensoschaeffler-pl.pdf`).
- **Other content:**
  - Developer API documentation (an unusual GEO asset: "OPTIME API" queries).
  - Trade-press pickup of each launch: OPTIME 2020, India, the Australian Ecosystem in 2025, Hannover Messe "Condition monitoring for all".
  - A conference talk PDF (uvigo.es).
- **Not seen:** glossary, calculator and comparison pages.

## Proof and trust

- **Awards:** Red Dot (Smart Product and Industrial Design) and Industry 4.0 Innovation Award 2020, both per Schaeffler and press.
- **Named users:** Stora Enso, Finnsementti and Schaeffler's own plants.
- **Reviews:** no G2 or Capterra listing found.

## Technical and structured data

- **The www.schaeffler.com HTML pages return 403** to curl, even with full browser headers (Akamai "Access Denied"). robots.txt and llms.txt are reachable, and llms.txt returns 404. WebFetch could read www.schaeffler.com, so the blocking is selective bot management. Whether real AI crawlers (GPTBot, ClaudeBot) are blocked is not verified.
- **The medias OPTIME page is client-rendered:**
  - The raw HTML (about 4.4 KB) holds only `<title>Schaeffler eCommerce Industrial</title>`, GTM, Kameleoon and Qualtrics scripts, and no product copy.
  - The Googlebot and GPTBot UAs get the same shell.
  - It has no meta description, no H1, no hreflang and no JSON-LD.
  - WebFetch also saw only that title.
- **medias robots.txt** blocks Applebot, FacebookBot and facebookexternalhit (link previews), and Yandex.
- **llms.txt:** none on www (404) or medias (404).
- **Schema:** none detectable on the pages that could be fetched.

## Off-site authority

- **Wikipedia / Wikidata:** "Schaeffler Group" (Q459367) has a Wikipedia article. OPTIME has no entity of its own.
- **Trade press:** strong, for example:
  - Hannover Messe news
  - foodprocessing.com.au
  - Australian Mining Review (2025)
  - BINDT news (2021)
  - Indian outlets for the India launch
  - zkg.de (cement)
  - usa-automation.net
- **Poland:** the Polish authorised distributor Albeco hosts the PL OPTIME sales deck and case-study PDFs. These are the main PL-language OPTIME sources on the web.
- **G2/Capterra and YouTube:** none found for OPTIME (YouTube not verified directly).

## AI visibility (manual)

To fill during monthly tracking.

## What Viezo can learn

1. **Schaeffler barely covers OPTIME in Polish.** schaeffler.pl has an English CM card, and Polish content exists only in distributor PDFs. → Viezo should own PL queries such as "bezprzewodowy czujnik drgań", "monitoring drgań wentylatorów" and "OPTIME alternatywa". Build a PL Sonora landing page with a keyword H1, plus 3-5 PL explainer pages. Effort: M.
2. **Their product page is a JS shell with a generic title.** → Viezo's Sonora page needs a descriptive title and H1, e.g. "Sonora – bezprzewodowy monitoring drgań maszyn | Viezo", server-rendered copy, and Product schema with `brand`, `manufacturer` and `isRelatedTo`. These are the minimum fixes that let Viezo outrank a market leader on non-brand queries. Effort: S.
3. **They sell on a "balance of plant" / "condition monitoring for all assets" frame.** Up to 95% of assets are unmonitored or route-checked only (Hannover Messe article). → Viezo should write one EN+PL explainer, "Why most fans and pumps are unmonitored, and what it costs", with a cost-per-point comparison that links to its pricing setup builder. Effort: S.
4. **They publish a public developer API page** (`developer.schaeffler.com/use-cases/schaeffler-optime`). → If Sonora has an API, export or integration path (CMMS, SCADA, webhooks), Viezo should publish a short "Integrations / API" page, even a one-pager. AI tools answer "does X integrate with Y" from such pages. Effort: S.
5. **Their case studies are PDF-only, and some live on a distributor domain.** → Viezo should keep its case studies as HTML, never PDF-only. When Polish partners or distributors are involved, ask them to link to the HTML case study rather than rehost PDFs. Effort: S.
6. **They get trade-press pickup on every launch.** → Viezo should send 2 releases a year (e.g. new Sonora version, VW Polska results) to Polish trade media (Utrzymanie Ruchu, Inżynieria i Utrzymanie Ruchu, Automatyka) and to Lithuanian and English outlets, so third-party pages describe Sonora. Effort: M.

## What not to copy

- Splitting one product across corporate, eCommerce, blog, developer and PDF properties with no hub page.
- Aggressive bot blocking (403 to non-browser clients) and JS-only product pages: both hurt AI visibility.
- English copy on the Polish site.
- Relying on brand plus trade press instead of on-site explainer content.
- Award logos (Red Dot) only matter for a brand of that scale. Viezo's named-client proof is more persuasive at its size.

## Sources

- https://www.schaeffler.com/ and /robots.txt, /llms.txt (404), /sitemap.xml (403) via curl (2026-10-14)
- https://www.schaeffler.com/en/ , /en/divisions-products/ , /en/divisions-products/industrial/ via WebFetch (2026-10-14)
- https://medias.schaeffler.com/en/monitor/optime-condition-monitoring (+ .de, .pl variants; browser, Googlebot and GPTBot UAs) (2026-10-14)
- https://medias.schaeffler.com/en/robots.txt (2026-10-14)
- https://www.schaeffler.pl/ , /pl/produkty-i-rozwiazania/przemysl/lifetime-solutions/ via WebFetch (2026-10-14)
- https://medias-at.schaeffler.com/de/industrial-blog/optime ; https://developer.schaeffler.com/use-cases/schaeffler-optime (2026-10-14)
- https://www.hannovermesse.de/en/news/news-articles/condition-monitoring-for-all ; https://foodprocessing.com.au/content/processing/product/schaeffler-optime-ecosystem-condition-monitoring-system-146480262 (2026-10-14)
- https://www.albeco.com.pl/data/catalogueb/prezentacja-handlowa-optime-pl.pdf (via search, 2026-10-14)
- https://afm.es/en/news/schaeffler-receives-the-ldquored-dot-design-awardldquo-in-two-categories-with-optime (2026-10-14)
- Wikidata API search "Schaeffler" → Q459367 (2026-10-14)
