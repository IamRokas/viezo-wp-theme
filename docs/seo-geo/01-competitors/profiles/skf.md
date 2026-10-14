# SKF (Enlight Collect IMx-1 / condition monitoring)

- **Site:** https://www.skf.com (section: /group/products/condition-monitoring-systems)
- **Checked:** 2026-10-14
- **Tier:** additional
- **Overlap with Viezo:** medium. Enlight Collect IMx-1 is a direct analogue of Sonora (battery wireless vibration and temperature sensor with mesh networking, aimed at balance-of-plant machines). But SKF sells through distributors as part of a huge bearings portfolio, and condition monitoring (CM) is one of about 15 product lines.

## Snapshot

| | |
|---|---|
| HQ / size | Gothenburg, Sweden. Global bearings group, very large. |
| What they sell (CM) | Wireless: Enlight Collect IMx-1 / IMx-1-EX (CMWA 6100/6600 variants), with mesh networking by LumenRadio. Portable: Microlog Analyzer dBX, QuickCollect, Enlight ProCollect. Also online systems, machine protection, Aptitude software (Observer, Analyst, Insight), and "Rotating Equipment Performance" services. Acquired G-Tech Instruments in Mar 2026 to strengthen CM. |
| Positioning line | The CM hub intro reads "Imagine your factory floor humming in perfect harmony…". There is no visible H1 text in the prerendered HTML. |
| Target industries | Cross-industry. Separate CM pages exist for marine ("Enlight Centre") and agriculture. |
| Pricing on site | None. "Find a distributor". |
| Languages | Around 140 hreflang locales. The PL site (`/pl/`) is natively translated, e.g. "Systemy monitorowania stanu \| SKF", but URL slugs stay in English. |

## Site structure

- **Sitemaps:** the robots.txt index lists 65 locale page sitemaps plus a product sitemap index.
  - `en_sitemap_site.xml`: 4,856 URLs, of which 1,284 are news.
  - `pl-pl_sitemap_site.xml`: 4,895 URLs.
- **CM section:** 178 EN URLs contain `condition-monitoring`, and about 138 sit under `/group/products/condition-monitoring-systems/`:
  - 71 are product-support/download pages (firmware versions such as `.../enlight-collect-imx1/cmwa6600-2-7`).
  - 28 are basic CM products, 13 sensors, 11 surveillance systems, 7 software, 3 portable and 3 protection.
- **Category tree:** `/products/condition-monitoring-systems/surveillance-systems/wireless/enlight-collect-imx-1`, plus a `regulatory-certifications` subpage per variant.
- **Missing:** no CM glossary, failure-mode pages or CM case-study archive was identifiable in the sitemap. "Case/success" matched 85 URLs, mostly news. SKF's well-known bearing-damage content was not counted (not verified).
- **Broken path:** `/software/enlight-ai` now redirects to the generic Software page.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| CM hub (EN) | Condition monitoring \| SKF | (empty H1 element in the prerender) |
| Main product | Enlight Collect IMx-1 \| SKF | SKF Enlight Collect IMx-1 and IMx-1-EX |
| PL CM hub | Systemy monitorowania stanu \| SKF | (not visible) |
| Press release (CM) | SKF (generic) | "SKF makes acquisition to strengthen its Condition Monitoring portfolio" |

Meta descriptions are **empty** (`content=""`) on every page checked. Titles are short product names. The terms they target are product and category nouns ("condition monitoring", "Enlight Collect"); there are no problem or question terms.

## Content engine

- **News:** a large archive (1,284 EN news URLs since about 2010). CM items include Enlight ProCollect (2019/2020), LumenRadio (2020), IMx-1-EX for hazardous areas (2023), Microlog dBX (2023) and the G-Tech acquisition (2026).
- **Product pages are thin.** The IMx-1 page is about 130 words of features and benefits, e.g. "SKF Acceleration Enveloping for early detection of defects in bearings and gears" and "monitoring from months and weeks to days and hours".
- **PL CM hub:** about 380 words of real Polish explainer copy ("Monitorowanie stanu to proces polegający na badaniu kondycji maszyn…").
- **Downloads:** many firmware and release-note pages. The SKF Knowledge Centre and training exist, but neither was checked in detail.

## Proof and trust

- Brand authority, a distributor network, and ATEX/IECEx Zone 1 approval for the IMx-1-EX.
- Customer stories appear as press releases (e.g. Barcelona metro in 2019, Smurfit Kappa Piteå in 2018).
- G2/Capterra: no listing found for Enlight or IMx-1.

## Technical and structured data

- **SPA with dynamic rendering (the key GEO finding).** The site is an Angular SPA.
  - A normal browser UA, **GPTBot, ClaudeBot and PerplexityBot** all receive an about 8 KB shell: `<title>SKF</title>` and the text "This browser is not supported".
  - Only Googlebot and bingbot get a prerendered page (about 39 KB, with the real title and copy).
  - In practice SKF's CM content is invisible to AI crawlers that don't run JS, unless those crawlers go through Bing or Google indexes.
- **No JSON-LD** on any page checked (0 blocks).
- **llms.txt:** `/llms.txt` returns 200 with the SPA shell, a soft 404, so effectively none.
- **robots.txt:** no AI-specific rules. It sets crawl-delay for bingbot and Applebot, and blocks Seekport.
- **Other:** gzip, and hreflang for about 140 locales on the prerendered page.

## Off-site authority

- **Wikipedia / Wikidata:** "SKF" (Q52846) has a Wikipedia article. Enlight has no entity of its own.
- **Press:** widely covered in trade press (Canadian Mining Journal, Engineering News, Mining Weekly, Industrial Machinery Digest), largely republished SKF releases.
- **Distribution:** strong presence through distributor listings and SKF promo microsites (`promo.skf.com`).
- **YouTube:** an SKF channel exists, but it was not checked for CM.

## AI visibility (manual)

To fill during monthly tracking.

## What Viezo can learn

1. **SKF's CM content is invisible to AI crawlers.** GPTBot, ClaudeBot and PerplexityBot get an empty shell with the title "SKF", with no meta descriptions and no schema. → This is Viezo's opening. Make sure every Sonora, case-study and explainer page is server-rendered (WordPress already is). Write a unique meta description for each, and add Product and Organization JSON-LD. A small site can out-answer SKF in AI results for queries like "wireless vibration sensor for fans/pumps". Effort: S.
2. **They publish a certification page per product variant** (`.../enlight-collect-imx-1/regulatory-certifications/cmwa-6100-ex`). → Viezo should add a crawlable "Sonora technical specifications" page in EN and PL: measurement axes, frequency range, battery life, IP rating, radio, mounting and certifications. Give each spec as a plain text row so AI can quote it. Effort: S.
3. **The PL CM hub opens with a definition paragraph** ("Monitorowanie stanu to proces…"). → Viezo's PL pillar page "Monitoring stanu maszyn / wibrodiagnostyka" should open with a 40-60-word definition answer, then cover how Sonora does it. Effort: S.
4. **Their product copy names one concrete method** (SKF Acceleration Enveloping for early bearing and gear defects). → Viezo should name and explain its own detection method on the Sonora page: which features and thresholds detect bearing wear, imbalance and gearbox faults. Generic "AI alerts" copy loses to named methods. Effort: S.
5. **Their customer proof sits in press releases, not structured case pages.** → Viezo's 59 named case studies (VW Polska, IMA Schelling) already beat SKF on proof volume for mid-size plants. Surface them in a "Customers" hub with logo, industry and fault filters, and cite them on the Sonora page. Effort: S-M.

## What not to copy

- The Angular SPA with UA-based dynamic rendering, and the empty meta descriptions.
- A product taxonomy that is 4-5 levels deep, and dozens of near-empty firmware-version pages (71 support URLs) that dilute the section.
- Distributor-only CTAs with no pricing.
- A 140-locale hreflang matrix with English slugs on localised pages.
- Dead product URLs redirecting to generic hubs (Enlight AI → Software).

## Sources

- https://www.skf.com/robots.txt , /llms.txt (soft 404), /sitemap_index.xml (2026-10-14)
- https://www.skf.com/sitemap/cspagesitemap/en_sitemap_site.xml ; .../pl-pl_sitemap_site.xml (2026-10-14)
- https://www.skf.com/group/products/condition-monitoring-systems (browser, Googlebot, GPTBot, ClaudeBot, PerplexityBot and bingbot UAs) (2026-10-14)
- https://www.skf.com/group/products/condition-monitoring-systems/surveillance-systems/wireless/enlight-collect-imx-1 (2026-10-14)
- https://www.skf.com/pl/products/condition-monitoring-systems (2026-10-14)
- https://www.skf.com/group/news-and-events/news/2026/2026-Mar-09-skf-makes-acquisition-to-strengthen-its-condition-monitoring-portfolio (2026-10-14)
- https://canadianminingjournal.com/news/sensors-wireless-sensors-enable-automated-machine-monitoring (2026-10-14)
- Wikidata API search "SKF" → Q52846 (2026-10-14)
