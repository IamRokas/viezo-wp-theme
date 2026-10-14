# What Viezo can learn from competitors

Synthesis of the 13 profiles in `01-competitors/` (checked 2026-10-14). Each lesson names who does it, what Viezo should do, and the backlog ID. Add new lessons at the end with a date; don't rewrite old ones.

## The short version

Viezo is a small vendor competing with large incumbents (SKF, Schaeffler, Fluke) and funded scale-ups (Tractian, Augury). It can't win on content volume. It can win on three things the others mostly don't do:

1. **Polish.** Only I-care runs a real Polish content operation. Fluke has PL blog posts, SKF a translated hub, Waites a Polish home page and nothing behind it, Schaeffler shows English on its Polish site. Viezo already has all 59 case studies in Polish.
2. **Being readable by AI.** The big three have no llms.txt and no Product schema. SKF and Schaeffler serve AI crawlers an empty page. A well-structured WordPress site with schema and llms.txt beats them in AI answers regardless of brand size.
3. **Structured proof.** Viezo has more named-client case studies than most of the list, and more than any in Polish. They are just unstructured and badly titled.

The work is mostly about packaging what Viezo already has, not producing large amounts of new content.

## Lessons

### 1. Short case studies work if they are structured (biggest single win)

- **Who:** Waites (28 stories, ~350 words, fact block INDUSTRY / EQUIPMENT / FAILURE MODE / IMPACT at the top, slugs like `building-materials-gearbox-83k`), AssetWatch (41 "asset saves" at ~140 words, as short as Viezo's, with tags, € and hours, Observation → Recommendation → Resolution), Acoem (fixed template, money in the title).
- **Lesson:** Viezo's 152-word median is not the problem. The missing structure and the titles are. A fact block gives Google and AI assistants extractable facts.
- **Viezo:** ACF fields for industry, machine/asset, fault, how early detected, outcome (downtime/€ avoided). Render as a fact box + Article schema. Titles: "<Fault> on <machine> detected <N> weeks early at <client> | Sonora case study". → C-02, C-03
- **Plus:** expand 3–5 flagship stories (Volkswagen Polska, IMA Schelling, a furniture plant) to 600–900 words with a quote, as Petasense, Tractian and I-care do. → C-17

### 2. Turn the case studies into asset, fault and industry pages

- **Who:** Augury (14 asset pages listing faults detected), AssetWatch (cases grouped by asset), Petasense (asset pages), Fluke ("four common faults" framing), I-care (one page per diagnostic method, in Polish), Acoem (24 application pages).
- **Lesson:** buyers and AI prompts are phrased by machine and by fault ("how to detect gearbox fault", "fan bearing monitoring"), not by vendor.
- **Viezo:** tag the 59 cases by asset and fault, then publish ~6 asset pages (motors, fans, pumps, gearboxes, compressors, conveyors/belts) and ~5 fault pages (bearing wear, imbalance, misalignment, looseness, belt problems), each with a short explanation, how Sonora detects it, and the matching case studies. Industry pages (C-04) follow the same pattern. → C-11, C-09, C-10, C-04

### 3. A small explainer layer, definition first

- **Who:** Tractian (glossary, definition in the meta description), AssetWatch (585 glossary terms with DefinedTerm schema, 7 intro pages), Waites (one 2,650-word vibration-analysis pillar), Fluke (62 Polish posts such as "Co to jest bezprzewodowy czujnik wibracji"), SKF (PL hub opens with a 40–60-word definition), Acoem (basics series).
- **Lesson:** AI answers quote a page that answers the question in the first two sentences.
- **Viezo:** one EN + PL pillar ("Vibration monitoring: how it works and which faults it catches") linking to fault pages, plus a 20–25-term EN/PL glossary. Polish first where it makes sense: there's little competition. → C-05, C-12

### 4. llms.txt and schema are where small vendors beat big ones

- **Who:** Augury's llms-full.txt defines each entity and lists "approved citations"; IoTFlows mirrors 139 pages as Markdown; Tractian's llms.txt gives numbers per industry; I-care's robots.txt explicitly allows ~14 AI bots. Against that: SKF, Schaeffler, Petasense and Banner have no schema at all.
- **Viezo:** llms.txt + a short llms-full.txt that defines UAB Viezo (Vilnius), Sonora, and states that viezo.com is an unrelated domain; list key facts and case-study results. Organization schema with legalName, address and sameAs. Explicit AI-bot allow rules in robots.txt when fixing the image block. → S-04, S-06, S-07, S-01

### 5. Make the price builder readable

- **Who:** IoTFlows (prices in text, meta description and Offer schema), Sensoteq (one kit at $2,750), Banner (cart with list prices), Waites/Petasense (value/ROI calculators), Banner (sensor-selection guide).
- **Lesson:** "How much does vibration monitoring cost" is a common buyer and AI question, and almost nobody answers it. Viezo's builder is a real differentiator, but it is JavaScript, so crawlers see nothing.
- **Viezo:** static text on the pricing page: price range ("from €X per sensor"), 2–3 example configurations, "how many sensors do I need", an ROI line; Offer schema on Sonora. Needs Viezo to approve publishing price ranges. → C-14

### 6. Product page: specs, FAQ, video

- **Who:** Fluke (3563 page ~2,660 words: features, hardware, software, in the box, specs, manuals), IoTFlows (separate specs page, 20 FAQs with FAQPage), SKF (spec/certification pages), Sensoteq (knowledge hub), Fluke/Banner (installation videos), SKF (names its detection method).
- **Viezo:** Sonora page with a descriptive H1, how it works, the detection method in plain words, an HTML specs table (not PDF), 8–12 FAQs, a 2–3-minute installation video with VideoObject schema, and an integrations/API note (Schaeffler publishes one). → C-06, C-13, C-18, C-19

### 7. Answer comparison prompts honestly

- **Who:** Tractian (`tractian-vs-augury`, `tractian-vs-waites`, "alternatives" pages); Sensoteq and Petasense ("when wireless isn't the right choice").
- **Lesson:** "X vs Y" and "alternatives to X" are typical AI prompts. Balanced pages get cited; one-sided ones get ignored.
- **Viezo:** start with "Wireless vs route-based vibration monitoring" and "When wireless isn't the right fit" (low risk), then consider "Sonora vs Tractian/Waites" once there are facts to compare. → C-15, C-16

### 8. One or two headline proof numbers

- **Who:** AssetWatch ("$31K+ avg per alert", "first alert ~3 days median"), Augury ("310% ROI, <6 months payback", repeated everywhere), Waites ("500K+ sensors", "ROI in under 4 months").
- **Viezo:** compute 2–3 defensible numbers from its own data (plants monitored, faults caught, median warning lead time) and repeat them on home, Sonora, llms.txt and Organization description. → S-05

### 9. Reviews and people

- **Who:** AssetWatch (18 G2 reviews at 4.9, vendor replies to each), I-care (22 named expert author pages).
- **Lesson:** review counts across this market are tiny (0–53), so a handful of genuine reviews puts Viezo level with the field. Named engineers add the expertise signal (E-E-A-T) that AI and Google look for.
- **Viezo:** G2 + Capterra profiles and a review request to ~10 case-study clients; 2–3 engineer author pages with Person schema. → A-04, S-09

### 10. Authority through regional trade press

- **Who:** Schaeffler (trade press on every launch), Sensoteq (all press is local/trade coverage of one funding round).
- **Viezo:** two releases a year to Polish maintenance trade media (e.g. Utrzymanie Ruchu, Inżynieria i Utrzymanie Ruchu) and Lithuanian/Baltic tech media, each linking to an HTML case study. → A-05

## What not to copy

- **Inflated or empty ratings in schema.** Tractian claims 4.7 from 200 reviews in schema (G2 shows ~53); IoTFlows claims 314; Fluke ships 0/0. Google can penalise this and it undermines trust. Rule: no AggregateRating until there are real reviews, and only with the real count.
- **Thin translations.** Waites translated the home page into 10 languages with nothing behind it.
- **PDF-only or gated case studies** (Schaeffler, Waites' "full case study"). AI only reads the HTML.
- **JavaScript-only rendering** (SKF, Schaeffler). Keep Viezo pages server-rendered; check new blocks render without JS.
- **Programmatic pages at scale** (Tractian's 228 role × industry pages, AssetWatch's 585 terms). They work with a content team; for Viezo they would be thin. Start small and real.
- **Several H1s per page used as styling** (Waites, I-care PL home).

## Open questions for Viezo

- Can price ranges be published as text (lesson 5)?
- Which 2–3 aggregate numbers can be stated and backed (lesson 8)?
- Which 10 clients would leave a review, and which 3–5 cases can be expanded with a quote?
- Does Sonora have an API or CMMS integrations worth a page?
- Who are the 2–3 engineers that could be named authors?

## 2026-10-14 · First Search Console check (12-month export in `search-console/`)

A first look; a full analysis is still to be done.

- **About 95% of the 1,598 clicks are branded searches** ("viezo" 856, "viezo sonora" 145, "uab viezo" 52). Non-brand search brings almost nothing yet.
- **Fault queries already get impressions with 0 clicks at positions 8–11:** "conveyor gearbox repair" (168), "exhaust fan bearing" (181), "fan fault" (96), "gearbox fault detected" (85), "motor defect" (50). The exhaust-fan case study has 2,992 impressions and 0.33% CTR. This confirms lessons 1–2: better case-study titles and fault/asset pages are the fastest non-brand win.
- **Brand collision is real:** "viezo global pvt ltd" (277 impressions), "viezo global private limited", "viezo appliances" are different companies (India: 3,735 impressions). Strengthens the case for S-01/S-06 disambiguation.
- **PL pages convert well:** `/pl/konserwacja-predykcyjna-w-przemysle/` has a 35% CTR at position 2.1. Supports the Polish-first approach.
