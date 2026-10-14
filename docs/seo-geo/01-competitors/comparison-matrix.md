# Comparison matrix

Checked 2026-10-14. Details and sources are in each profile. Viezo row from the audit (`00-audit/2026-10-14-seo-geo-plan.html`).

## SEO and GEO basics

| | Polish content | llms.txt | Structured data | Readable by AI crawlers | Titles / H1 |
|---|---|---|---|---|---|
| **Viezo** | **Full EN + PL site, all 59 case studies** | no | Yoast generic only | yes (server-rendered) | weak ("Sonora", all-caps cases) |
| Tractian | none (EN/PT/ES) | yes, 19 KB, numbers per industry | Organization, Product (+ inflated rating) | yes | strong |
| Augury | none | yes + llms-full.txt (entities, approved facts) | FAQPage, QAPage, Product, rating | partly (Cloudflare blocks some) | strong ("Machine Health" everywhere) |
| AssetWatch | none | yes, 12.6 KB | per page type: Article, HowTo, FAQPage, DefinedTerm, SoftwareApplication | yes | strong |
| Waites | home + about only | yes, curated | Organization, Service, OfferCatalog | yes | good titles, several H1s |
| IoTFlows | none | yes, 82 KB + `.md` mirrors of 139 pages | richest (Offer, FAQPage, …; inflated ratings) | yes | good |
| Sensoteq | none | auto (Wix) | LocalBusiness, BlogPosting, Product/Offer | yes, heavy pages | weak (no H1 on industry pages) |
| Petasense | none | no | none | yes | every page titled "Petasense", no H1 |
| I-care | **strong: 65 PL pages + 113 PL knowledge items, 8 languages** | no | Organization only | yes; robots.txt explicitly allows ~14 AI bots | good, localised slugs |
| Fluke | **62 PL vibration blog posts + PL 3563 page** | no | Product, Organization, BlogPosting (empty rating) | yes | good |
| SKF | PL site (4,895 URLs), translated CM hub, EN slugs | no | none | **no**: AI bots get an empty JS shell | empty meta descriptions |
| Schaeffler OPTIME | thin: PL site shows English CM card | no | none | **no**: product page is a 4 KB shell | generic ("Schaeffler eCommerce Industrial") |
| Acoem | none | no | Article, Person, BreadcrumbList (no Product) | yes | product H1 just "EAGLE" |
| Banner | none | no | none | yes, heavy pages | product-catalogue style |

## Content and proof

| | Case studies | Explainers / glossary | Asset or fault pages | Pricing on site | Comparison pages | G2 reviews | Wikipedia / Wikidata |
|---|---|---|---|---|---|---|---|
| **Viezo** | **59, median 152 words, named clients, EN + PL** | 0 (4 EU-funding posts) | none (industry categories only) | **public setup builder (JS)** | no | none | none |
| Tractian | 3 EN, ~2,600 words | glossary (~3,000 words/term), 114 blog, 228 programmatic pages | 11 industry pages | calculator | yes (vs Augury, vs Waites) | ~53, 4.7 | not verified |
| Augury | 8 | 549 blog, 48 podcasts | 14 asset pages | quote only | not found | ~3 | not verified |
| AssetWatch | 41 "asset saves" (~140 words, templated) + 16 | 585 glossary terms, 95 blog, 7 intro pages | per asset | no | not found | 18, 4.9 | not verified |
| Waites | 28, ~350 words, fact block on top | ~32 blog, 2,650-word pillar | 11 industry pages | value calculator | no | 0 | no |
| IoTFlows | 8 long | 132 public docs pages | — | **public, $119/$249 per device/mo** | no | 2 | no |
| Sensoteq | ~15 (as blog posts) | 55 blog, knowledge hub | 9 industry pages | **one kit public ($2,750)** | no | none | no |
| Petasense | ~8 long (one 1,770 words) | 72 blog (restarted 2025) | 4 asset pages | ROI calculator | no | none | no |
| I-care | ~990 words, named quotes | 902 knowledge URLs, 22 expert pages | per method (e.g. wibrodiagnostyka) | no | no | ~3, 4.0 | no |
| Fluke | in blog | 1,302 blog (~250 on CM) | "four common faults" framing | product price | no | eMaint ~287 | yes / yes |
| SKF | in press releases | 138 CM URLs (71 firmware stubs) | — | no | no | none | – / yes |
| Schaeffler OPTIME | PDF only | — | — | not verified | no | none | – / – (corporate yes) |
| Acoem | 121 (8 EAGLE), templated, money in title | ~105 reliability posts | 24 application pages | no | no | none | – / yes |
| Banner | anonymous stories | 283 how-to videos, sensor selection guide | — | **online cart, list prices** | no | none | no |

## Reading the matrix

- **Polish:** only I-care has a real Polish content operation, followed by Fluke (blog) and SKF (translated hub). Waites and Schaeffler are thin. Viezo already has more PL case material than any of them.
- **AI readiness:** 6 of 13 have llms.txt, all of them smaller vendors. None of the large incumbents does, and SKF and Schaeffler are effectively invisible to AI crawlers.
- **Pricing:** only IoTFlows, Sensoteq (one kit) and Banner show prices as plain text. Viezo's builder is rarer than it looks, but crawlers can't read it.
- **Reviews:** the most any profile shows on G2 is ~53 (Tractian). Five to ten genuine reviews would put Viezo level with most of this list.
