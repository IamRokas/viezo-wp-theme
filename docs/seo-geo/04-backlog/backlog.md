# Backlog

Single list of SEO/GEO work. Sources: audit `00-audit/2026-10-14-seo-geo-plan.html` (src: audit) and competitor research (src: comp/<slug>). Status: `todo` · `doing` · `blocked` · `done`. Owner: **Dev** = can be done in theme/WP, **Viezo** = needs client content, access or decision.

Impact H/M/L, effort S (≤ ½ day) / M (≤ 3 days) / L (more).

## Phase 1 · Quick fixes

| ID | Task | Owner | Effort | Impact | Status | Src |
|---|---|---|---|---|---|---|
| T-01 | Remove `Disallow: /wp-content/uploads/` from robots.txt, request re-crawl | Dev | S | H | ready to deploy (release 2026-10-14) | audit |
| T-02 | Enable gzip (mod_deflate) in .htaccess | Dev | S | H | ready to deploy (release 2026-10-14) | audit |
| T-03 | Re-encode home videos (hero 49 MB → 3–5 MB, poster, lazy-load second video) | Dev | S | H | ready to deploy (release 2026-10-14) | audit |
| T-04 | Images to WebP: WebP Express plugin (decided 2026-10-14) | Dev | S | M | todo | audit |
| T-05 | hreflang x-default, PL archive description, missing translation link | Dev | S | L | partly: x-default + PL archive ready; granulator case needs a PL translation | audit |
| T-06 | Noindex empty Terms pages; merge 4 EU funding posts into EU page | Dev | S | L | partly: Terms noindex ready; EU posts kept, needs Viezo decision | audit |
| S-01 | Organization schema (logo, Vilnius address, sameAs LinkedIn etc.); `name` + `alternateName` "Viezo UAB" and `url` viezo.lt to separate the brand from the unrelated viezo.com | Dev | S | H | ready to deploy (release 2026-10-14) | audit, comp/tractian |
| S-02 | Product / SoftwareApplication schema for Sonora | Dev | S | H | ready to deploy (release 2026-10-14) | audit |
| S-03 | Article schema on case studies (client, industry as about/mentions) | Dev | S | H | ready to deploy (release 2026-10-14) | audit |
| S-04 | Publish llms.txt (EN, links to PL) | Dev | S | M | ready to deploy (release 2026-10-14) | audit, comp/tractian, waites |
| C-01 | Fix H1s (Contact EN/PL, Sonora, Pricing, Case studies) + meta descriptions on 27 URLs | Dev drafts, Viezo approves | S | M | todo | audit |
| M-01 | Connect Search Console + Bing Webmaster Tools, submit sitemaps, link GSC to GA4 | Viezo access | S | H | doing (GSC export received 2026-10-14) | audit |
| M-02 | GA4 report/segment for AI referrals (chatgpt.com, perplexity.ai, copilot, gemini) | Dev | S | M | steps in release 2026-10-14 | audit |

## Phase 2 · Content that ranks and gets cited (months 1–3)

| ID | Task | Owner | Effort | Impact | Status | Src |
|---|---|---|---|---|---|---|
| C-02 | New case-study template: key-facts box, chart, quote, FAQ, Article + FAQ schema | Dev | M | H | todo | audit, comp/waites, assetwatch, acoem |
| C-03 | Rewrite case-study titles (fault + machine + client + "case study"); expand best 10–15 to 400–600 words | Viezo facts, Dev edit | L | H | todo | audit, comp/waites, fluke |
| C-04 | Industry landing pages from case-study categories | Viezo + Dev | L | H | todo | audit, comp/acoem, waites |
| C-05 | 6–8 explainer pages EN + PL | Viezo expertise, writer | L | H | todo | audit, comp/waites, fluke, skf |
| C-06 | Restructure Sonora page: clear H1, how it works, specs table, FAQ, case links | Dev + Viezo | M | M | todo | audit, comp/fluke, augury |
| A-01 | Google Business Profile, G2, Capterra, Crunchbase, Wikidata | Viezo | M | M | todo | audit |
| A-02 | Partner/distributor backlinks (Techvitas, Ruven, Sujan, TGD, IMA Schelling) | Viezo | M | M | todo | audit |

## Phase 3 · Authority and infrastructure (months 3–6)

| ID | Task | Owner | Effort | Impact | Status | Src |
|---|---|---|---|---|---|---|
| T-07 | Server upgrade (AL2023 / managed host / Cloudflare): HTTP/2, Brotli, current PHP | Dev, Viezo budget | M | M | todo | audit |
| A-03 | Digital PR: 2–3 case studies to trade media, talks, engineer LinkedIn articles | Viezo | L | H | todo | audit |
| C-07 | Decide on a Lithuanian version | Viezo | decision | M | todo | audit |
| M-03 | Monthly AI visibility check (see `03-keywords-prompts/ai-prompts.md`) | Dev | S/month | M | todo | audit |
| C-08 | Quarterly content refresh | Viezo + Dev | ongoing | M | todo | audit |

## Competitor-derived

Added from `02-insights/learnings.md`.

| ID | Task | Owner | Effort | Impact | Status | Src |
|---|---|---|---|---|---|---|
| C-09 | ~6 asset pages EN/PL (motors, fans, pumps, gearboxes, compressors, conveyors/belts) linking matching cases | Viezo + Dev | L | H | todo | comp/augury, assetwatch, petasense |
| C-10 | ~5 fault pages EN/PL (bearing wear, imbalance, misalignment, looseness, belt) linking cases | Viezo + Dev | L | H | todo | comp/fluke, icare |
| C-11 | Tag cases by asset + fault (new taxonomies), filterable archive, indexable term pages | Dev | M | H | todo | comp/assetwatch, icare |
| C-12 | Glossary 20–25 terms EN/PL, definition first, DefinedTermSet schema | Viezo + writer | M | M | todo | comp/tractian, assetwatch |
| C-13 | Sonora specs page (HTML table) + 8–12 FAQs with FAQPage schema | Viezo facts, Dev | S | M | todo | comp/iotflows, skf, fluke, sensoteq |
| C-14 | Crawlable pricing text: price range, 2–3 example setups, "how many sensors", ROI line; Offer schema | Viezo approves, Dev | S | H | todo | comp/iotflows, banner, waites, petasense |
| C-15 | Comparison content: "Wireless vs route-based" first, later "Sonora vs Tractian/Waites" | Viezo + writer | M | M | todo | comp/tractian |
| C-16 | "When wireless isn't the right fit" article EN/PL | writer | S | M | todo | comp/sensoteq, petasense |
| C-17 | Expand 3–5 flagship cases to 600–900 words with quote (VW Polska, IMA Schelling, furniture) | Viezo facts, writer | M | H | todo | comp/petasense, tractian, icare |
| C-18 | 2–3 min Sonora installation video, own page, VideoObject schema | Viezo | M | M | todo | comp/fluke, banner |
| C-19 | Integrations / API one-pager (if Sonora has CMMS/SCADA/API paths) | Viezo + Dev | S | L | todo | comp/schaeffler-optime |
| S-05 | 2–3 aggregate proof numbers (plants, faults caught, median warning lead time) on home, Sonora, llms.txt | Viezo data | S | H | todo | comp/assetwatch, augury, waites |
| S-06 | llms-full.txt: entity definitions (UAB Viezo, Sonora, not viezo.com), approved facts, case results | Dev | S | M | ready to deploy (release 2026-10-14) | comp/augury, iotflows |
| S-07 | Explicit AI-crawler allow rules in robots.txt (do with T-01) | Dev | S | L | ready to deploy (release 2026-10-14) | comp/icare |
| S-09 | 2–3 engineer author pages, Person schema, linked as author | Viezo + Dev | S | M | todo | comp/icare |
| A-04 | Ask ~10 case-study clients for G2/Capterra reviews (after A-01) | Viezo | M | M | todo | comp/assetwatch |
| A-05 | 2 releases/year to PL maintenance trade media + LT/Baltic tech media | Viezo | M | M | todo | comp/schaeffler-optime, sensoteq |
| M-04 | Quarterly competitor re-check (profiles + matrix) | Dev | S | L | todo | comp |

Rule from competitor research: no AggregateRating in schema until there are real reviews, and then only with the real count (see `02-insights/learnings.md`, "What not to copy").

## Dropped / changed

- **viezo.com 301 (audit, Medium):** dropped 2026-10-14. viezo.com does not belong to the client. Replaced by brand disambiguation in S-01 (always "Viezo" + "Sonora" + viezo.lt together; consistent sameAs).
