# Banner Engineering (QM42VT, now QM30VT)

- **Site:** https://www.bannerengineering.com (focus: `/us/en/products/wireless-sensor-networks/` vibration section)
- **Checked:** 2026-10-14
- **Tier:** additional
- **Overlap with Viezo:** low-medium. Banner sells the sensor hardware (DIY: QM30VT sensor + DXM controller + Cloud Data Services) through an online catalog and distributors, not a managed monitoring service. Overlaps on queries like "wireless vibration sensor" and "vibration monitoring for predictive maintenance".

## Snapshot

| | |
|---|---|
| HQ / size | Minneapolis (Plymouth), MN, USA; large private industrial-automation manufacturer (size not verified). |
| What they sell | QM30VT (2-axis), QM30VT2, QM30VT3 (3-axis, IO-Link, VIBE-IQ machine learning) vibration + temperature sensors; **QM42VT is now in `/products/legacy/`** with a "Recommended Latest Technology: QM30VT" block. Sure Cross wireless nodes, DXM wireless controllers, Snap Signal, Banner Cloud Data Services (CDS), vibration monitoring kits. |
| Positioning line | Home title: "Banner Engineering \| Smarter Automation. Better Solutions." Vibration hub H1: "Vibration Sensors". |
| Target industries | Broad automation: automotive, food, packaging, material handling, HVAC/facilities. |
| Pricing on site | Online catalog with "Add to Cart" and "List Price" (price rendered by JS, value not captured). |
| Languages | 22 hreflang locales (de, es, fr, it, ja, ko, pt-br, tr, zh, many en-xx). No Polish. |

## Site structure

Adobe Experience Manager (AEM) site (`_jcr_content` paths). robots.txt lists 20 locale sitemaps + a video sitemap.

- `/us/en/sitemap.xml`: 18,109 URLs, of which 16,783 products (mostly part-number/model pages), 556 solutions (application notes), 299 support (283 video pages), 170 company (52 new-product, 33 expert-insights, 28 blog, 18 news), 101 industries, 99 landing pages (`/lp/`), 71 applications.
- Only ~20 URLs contain "vibration": product hub `/products/wireless-sensor-networks/vibration-sensors.html`, model pages (qm30vt, qm30vt3), selection guide `/predictive-maintenance-selection/vibration-monitoring.html`, 3 solution notes, 1 blog post, several `/lp/` campaign pages ("value-of-a-single-vibration-sensor", "wireless-temperature-vibration-sensor").
- Application notes pattern: `/solutions/iiot-data-driven-factory/<slug>.html` (Challenge / Solution / Featured Products).
- No glossary, no calculators, no comparison pages found.

## Titles and messaging

| Page | `<title>` | H1 |
|---|---|---|
| Home | Banner Engineering \| Smarter Automation. Better Solutions. | (none) |
| Main product (QM42VT, legacy) | QM42 Vibration & Temperature Series - Wireless | QM42 Series |
| Vibration hub | Vibration Sensors | Vibration Sensors |
| One case study | Monitor Vibration: Prevent Costly Downtime in Boiler Room | Vibration Monitoring of Boiler Room Air Handling Unit Prevents Costly Downtime |
| One industry page | Automotive | Automotive |

Targets: "vibration sensors", "wireless vibration sensor", "vibration monitoring for predictive maintenance", "vibration and temperature sensor", model numbers. Titles are short and generic, no brand suffix on many.

## Content engine

- Application notes ("solutions"): 556 overall, short (Challenge / Solution / Featured Products), mostly anonymous ("a local corporate building"); example: 3 sensors on an air handler, ML baseline on DXM, rise in vibration after 3 months, bearing replaced, photo of inner-race spalling.
- Video: 283 support/how-to videos (3 vibration-specific), plus video sitemap.
- Blog and "expert insights": 61 posts total, 1 on vibration sensors ("Vibration Sensors for Industrial Automation").
- Campaign landing pages (99 `/lp/`) incl. AWS marketplace vibration solution page.
- Technical literature: datasheets, manuals, DXM configuration files for "using a vibration sensor to determine if an asset is running".

## Proof and trust

- Mostly anonymous application stories; few named clients in the vibration section.
- Wide distributor presence (Mouser and others) and trade-press coverage of each launch (control.com, Drives & Controls).
- G2/Capterra: no listing found for Banner vibration products or CDS.

## Technical and structured data

- JSON-LD: **none** on any sampled page (home, hub, legacy product, solution, blog, industry).
- llms.txt: no (404).
- robots.txt: no AI-crawler rules; blocks search, account, `/content/dam/*` (but allows images).
- hreflang: 22 locales; gzip; very heavy HTML (580-860 KB per page).
- Legacy product page kept live with a pointer to the successor model (good for model-number searches).

## Off-site authority

- Wikipedia: no EN article for Banner Engineering found (404). Wikidata only has unlabeled items (not verified as the company).
- Distributors: Mouser, others have QM30VT/QM30VT3 pages.
- Trade press: control.com (QM30VT3 launch, May 2025), Drives & Controls Canada.
- YouTube: large how-to library (video sitemap).

## AI visibility (manual)

Fill during monthly tracking: which prompts mention them, which of their pages get cited.

## What Viezo can learn

1. **Product-selection page for "which sensor/plan do I need".** Banner has `/predictive-maintenance-selection/vibration-monitoring.html`. Viezo already has a pricing setup builder → add a static, crawlable explainer above/below it ("How many sensors do I need? One per bearing housing on critical machines...", with 3 example setups: one fan line, compressor room, CNC shop) so search/AI can read the logic, not only the JS calculator. → S
2. **"Detected → replaced → photo of the damaged part" case format.** Banner's best story shows the spalled bearing race photo after replacement. Viezo's short cases can add the same: trend screenshot + photo of the removed bearing/part + one-line outcome. Unblock images in robots.txt so these get indexed. → S per case
3. **Short how-to videos on installation and configuration.** Banner has 283 how-to video pages and a video sitemap. → Viezo: 3 short videos (mounting the sensor, gateway setup, reading an alert), each on its own page with `VideoObject` schema. → S/M
4. **Keep old product names live with a pointer.** Banner's legacy QM42VT page still ranks for the model and points to QM30VT. → If Viezo renames sensors or Sonora versions, keep the old URL with a "replaced by" note instead of 404/redirect-only. → S
5. **Beat them on schema cheaply.** Banner, a large company, has zero JSON-LD. Adding `Organization`, `Product`, `Article` and `BreadcrumbList` gives Viezo a structural advantage for AI extraction at low cost. → S

## What not to copy

- 16,783 part-number pages and 18k-URL locale sitemaps: catalog scale Viezo does not have and does not need.
- Anonymous application notes ("a local corporate building"): Viezo's named clients (Volkswagen Polska, IMA Schelling) are a stronger asset; keep names.
- Generic one-word titles ("Automotive", "Vibration Sensors") and home without H1.
- 600-860 KB HTML pages.
- DIY-hardware positioning (buy sensor + controller + configure yourself): Viezo's value is the done-for-you system and alerts; say that explicitly instead.

## Sources

- https://www.bannerengineering.com/robots.txt (2026-10-14)
- https://www.bannerengineering.com/llms.txt (404, 2026-10-14)
- https://www.bannerengineering.com/us/en/sitemap.xml (2026-10-14)
- https://www.bannerengineering.com/us/en.html (2026-10-14)
- https://www.bannerengineering.com/us/en/products/legacy/QM42-vibration-temperature-series-wireless.html (2026-10-14)
- https://www.bannerengineering.com/us/en/products/wireless-sensor-networks/vibration-sensors.html (2026-10-14)
- https://www.bannerengineering.com/us/en/solutions/iiot-data-driven-factory/vibration-monitoring-a-main-air-handler--success-story-.html (2026-10-14)
- https://www.bannerengineering.com/us/en/company/banner-blog/vibration-sensors.html (2026-10-14)
- https://www.bannerengineering.com/us/en/industries/automotive.html (2026-10-14)
- https://en.wikipedia.org/wiki/Banner_Engineering (404, 2026-10-14)
- WebSearch: QM30VT reviews, control.com, Drives & Controls, Mouser (2026-10-14)
