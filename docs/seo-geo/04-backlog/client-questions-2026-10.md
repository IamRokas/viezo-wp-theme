# Questions for Viezo · October 2026

Sent: 2026-10-14 · Answers received: 2026-10-21 (summary below; the original questions follow for reference)

These come from the SEO/GEO audit, the competitor analysis (13 companies) and the first Search Console data. Each question says what we need, why it matters, and what we will do with the answer. Short answers are fine; we write the copy and send it back for approval.

The questions are in priority order. 1–4 unblock the work with the biggest effect, 5–9 improve specific pages, 10–13 are quick confirmations.

## Answers (2026-10-21) and what changes

| # | Viezo's answer | What we do now |
|---|---|---|
| 1 | No prices on the website. | Pricing page gets text **without numbers**: what affects the price, how many sensors a machine needs, what a setup looks like (C-14). No Offer/price in schema. |
| 2 | No numbers can be published (nothing to show, or not allowed). | No headline numbers (S-05 dropped). Case-study numbers already on the pages stay. |
| 3 | Answers given for installation, which machines, sensors per machine, how alerts are reviewed, which faults. **Not public:** data ownership, CMMS/SCADA, contract and pilot. The spec table already exists on the [Sonora page](https://viezo.lt/for-factory-owners-sonora/) (it's real text, so readable by Google). | Specs and answers added to the Sonora product schema and llms-full.txt (done 2026-10-21). Next: an FAQ block on the Sonora page with these 5 answers (C-13). |
| 4 | OK, go ahead. | Draft new case-study titles for approval (C-03), **without client names in the titles** (see 5). |
| 5 | No reviews for now. Client names may stay on the case studies "until someone objects", but the narrative must not be pushed further. | Review profiles on hold (A-01 G2/Capterra, A-04). Client names removed from structured data and llms-full.txt (done 2026-10-21). New titles, descriptions and future content won't feature client names. |
| 6 | Clients won't give quotes. Some exist (IMA, IKEA Lithuania) but can't be published. Full stories only for clients that allow it: **Vilpak, CIE LT Forge, IMA Schelling**. | C-17: expand those three only, without quotes, using what Viezo's engineers can provide (vibration chart, photo of the damaged part, timeline). |
| 7 | No named engineers. | S-09 dropped. Content stays authored by Viezo. |
| 8 | No integrations yet. | C-19 dropped. The FAQ won't mention integrations. |
| 9 | Yes, translate. Most cases are already translated. | Confirmed: 29 of 30 English case studies have a Polish version; only [the De Heus granulator case](https://viezo.lt/case-study/granulator-bearing-fault-validated-after-initial-dismissal/) is missing. We translate it (T-05). |
| 10 | **UAB Viezo.** | Structured data and llms.txt now say "UAB Viezo" (done 2026-10-21). The Privacy Policy still names UAB "Nanoenergija" and needs Viezo's corrected text (legal page, we won't rewrite it ourselves). |
| 11 | The EU posts must stay as they are (around 10 years, possibly forever). | Kept as they are (T-06 closed for the EU part). |
| 12 | There used to be Terms on the old (Powerail) site; maybe lost in the redesign. Please check. | Checked: the [Wayback Machine](https://web.archive.org/web/2022*/viezo.lt/terms-of-use/) has 12 snapshots from May 2022 to April 2026, and the old 2022 database: the page has **always been empty** (only the heading). Nothing was lost. The railway photo is the theme's default header, shown when a page has none. Viezo needs to supply the text, or we remove the link from the English footer. It stays hidden from Google meanwhile. |
| 13 | Lithuania is a target, but Lithuanians read English. EN and PL only for now. | No Lithuanian version (C-07 closed). |


---

## A. The most valuable answers

### 1. Can we publish price ranges on the website?

**What we need:** a yes or no, and if yes, ranges we may publish. For example:
- the starting price per sensor or per monitored machine,
- whether there is a monthly or yearly platform fee, and roughly how much,
- 2–3 typical setups with an approximate total, e.g. "a 10-machine line: about €X to start, €Y per month".

Ranges and "from" prices are enough. No exact quotes.

**Why:** "How much does vibration monitoring cost?" is one of the most common questions buyers ask Google and AI assistants. Among the 13 competitors, only IoTFlows, Sensoteq (one kit) and Banner publish prices. Everyone else, Viezo included, says "request a quote". When an AI assistant answers a cost question, it can only cite sites that state a number. Today the setup builder collects the configuration but ends in a quote form, so the site never answers the question.

**What we'll do:** add a short, readable text section to the Pricing page: price ranges, the example setups, and "how many sensors does a machine need". Add the price to the structured data for Sonora. The setup builder stays as it is.

**If the answer is no:** we write the same section without numbers: what affects the price, typical setup sizes, payback examples from the case studies. It helps, but less.

### 2. Which 2–3 headline numbers can Viezo stand behind?

**What we need:** 2–3 figures Viezo is comfortable repeating publicly, and how each was counted. Candidates:
- number of plants or companies monitored,
- number of machines or sensors monitored,
- faults detected before failure (total, or per year),
- typical warning time before failure (e.g. "median 3 weeks"),
- money saved for clients, if it can be backed. The case studies already include figures like €46,000 (pump), €7,500 (spindle) and €3,000 (gearbox).

**Why:** competitors repeat one or two numbers everywhere: AssetWatch "$31K+ saved per alert", Augury "310% ROI", Waites "500K+ sensors". AI assistants and journalists quote such numbers, and they make a small company look credible. Viezo has the data but no headline figure.

**What we'll do:** use them on the home page, the Sonora page, in llms.txt (the summary AI assistants read) and in the company description in the structured data. We'll show you the wording first.

### 3. Sonora technical specs and answers to common buyer questions

**What we need:** one document, or even an email, with:
- **Specs:** what the sensor measures (vibration axes, frequency range, temperature?), battery life, connectivity (Wi-Fi, LTE, gateway?), mounting (magnet, glue, screw?), IP rating, operating temperature, the machine speed range (the PL pricing page mentions 100–15,000 rpm), and data storage and ownership.
- **Short answers to these questions:**
  - How long does installation take, and does it need IT?
  - Which machines can Sonora monitor, and which not?
  - How many sensors per machine?
  - How are alerts delivered, and who reviews them (software only, or Viezo engineers)?
  - What happens to the data, and who owns it?
  - Can it connect to our CMMS or SCADA?
  - What is the contract length, and is there a pilot or trial?
  - Which faults does Sonora detect (bearing wear, imbalance, misalignment, looseness, gear damage…)?

**Why:** specs and FAQ answers are what AI assistants quote for questions like "battery life of wireless vibration sensors" or "does Sonora need Wi-Fi". Fluke, IoTFlows and SKF publish spec pages and FAQs; Viezo's Sonora page has neither. Search Console shows the Sonora page gets 2,664 impressions but only 153 clicks: people see it but it doesn't answer enough.

**What we'll do:** a Sonora specs table in English and Polish, plus 8–12 questions and answers on the Sonora page, marked up so Google can show them.

### 4. Permission to rewrite case-study titles (we draft, you approve)

**What we need:** approval of the approach. We'll then send a list of all 59 new titles for a quick yes/no on each.

**Why:** titles like "FAN BEARING WEAR – Viezo" don't say where, what or the result. Search Console shows case studies already appear in Google for real searches but nobody clicks:
- "exhaust fan bearing": 181 impressions, position 9;
- "conveyor gearbox repair": 168 impressions, position 11;
- the exhaust-fan case study overall: 2,992 impressions, 10 clicks.

A title such as "Fan bearing wear detected early at Ulmas | Sonora case study" matches what people search for and gets clicked. Competitors with the best case studies (Waites, AssetWatch) name the machine, the fault and the result in every title.

**What we'll do:** new titles and descriptions in English and Polish, from the facts already on each page. Nothing is published without your approval. Please tell us if any client must not be named in a title.

---

## B. Facts that improve specific pages

### 5. Which clients would leave a short public review?

**What a review site is:** G2 and Capterra are websites where business buyers compare software and read reviews from other companies, like booking.com for B2B software. Google Business Profile is the box with reviews that appears in Google Search and Maps when someone searches for a company.

**What we need:**
- The names of 5–10 clients who are happy with Sonora, with the contact person (usually the maintenance or production manager) and their email. Good candidates from the case studies: Volkswagen Polska, IMA Schelling, IKEA plants, Freda, Barry Callebaut, Atria, De Heus, Retal, Ulmas.
- Your OK that we (or Viezo) send them a short request. It takes the client about 5 minutes: G2 asks what they like, what they'd improve, and for a 1–5 star score.

**Why:**
- Buyers check reviews before they ask for a demo, and AI assistants use review sites as a source when asked "which vibration monitoring system is good?"
- Competitors have very few reviews, so a handful is enough to stand out. On G2: Waites has 0, Augury about 3, AssetWatch 18 (and AssetWatch replies to every one), Tractian about 53.
- Reviews also confirm that "Viezo" is a real, active company. That matters because other companies with similar names exist (viezo.com, Viezo Global Pvt Ltd).

**What we'll do:**
1. Create the Viezo profiles on [G2](https://sell.g2.com/), [Capterra](https://www.capterra.com/vendors/sign-up) and [Google Business Profile](https://business.google.com/).
2. Write the request email for you to send.
3. Once there are real reviews, show the rating on the website. We never show a rating that isn't backed by real reviews; Google penalises that.

### 6. Material to turn 3–5 case studies into full stories

**What the case studies look like now:** each page has one photo (the Sonora sensor mounted on the machine) and 100–250 words of text in four fields: Client, Company operations, Equipment type, Diagnosed issue / Results. Examples:
- [Belt imbalance on grinding machine, Volkswagen Polska](https://viezo.lt/case-study/belt-imbalance-on-grinding-machine/): 145 words
- [IMA KFA corner rounding unit bearing fault, IMA Schelling](https://viezo.lt/case-study/bearing-fault/): 127 words
- [Pump failure, Retal](https://viezo.lt/case-study/pump-failure/): 108 words, but with a strong number (over €46,000 saved)

**What competitors do instead:** a full story with the machine, what the data showed, what the maintenance team did, and what it saved. They add a chart, photos, and the client's own words:
- [I-care, BASF success story](https://www.icareweb.com/knowledge/predictive-maintenance/success-story-basf/): about 990 words with three quotes from a named BASF engineer.
- [Waites, gearbox case study](https://waites.net/case-studies/building-materials-gearbox-83k): a facts box at the top (industry, equipment, failure mode, $83K saved, 48 hours avoided).
- [Banner, air handler success story](https://www.bannerengineering.com/us/en/solutions/iiot-data-driven-factory/vibration-monitoring-a-main-air-handler--success-story-.html): includes a photo of the damaged bearing after it was removed.

**What we need, for each of 3–5 cases** (our suggestion: Volkswagen Polska, IMA Schelling, Retal):

| Item | What exactly | Who provides it |
|---|---|---|
| **Client quote** | 2–3 sentences from the client's maintenance or production manager about what happened and what it meant for them, with their name and job title (or just the title, if they prefer). E.g. *"The alert came on a Friday. We found nothing by ear, but the next day the converter tripped, so we already knew it was the bearing."* | Viezo asks the client; we can draft the quote for the client to edit and approve |
| **Vibration chart** | A screenshot from the Sonora dashboard showing the vibration level over time on that machine: the normal level, when it started rising, when the alert was sent, and the drop after the repair. Client names and IDs can be blurred. | Viezo engineers |
| **Photo of the damaged part** | If the replaced bearing, belt or pump part was kept or photographed: a phone photo of the wear or damage. It shows the alert was real. | Viezo or the client's maintenance team |
| **Numbers** | Any of: how many days or weeks of warning, repair time, downtime avoided (hours), cost avoided (€) | Viezo, checked with the client |
| **Client's OK** | Confirmation the client agrees to the expanded story and to being named | Viezo asks the client |

**Why:**
- These pages are what buyers forward to their boss, what trade journalists pick up, and what AI assistants quote when asked "does wireless vibration monitoring work?"
- A chart and a photo of the damaged part prove the detection was real, and a quote from the client is more convincing than Viezo's own words.
- Today, 58 of the 59 case studies are under 250 words, so there is nothing to quote beyond a few lines.

**What we'll do:** write each story (about 600–900 words, English and Polish), send it to you and the client for approval, then publish it. The short case studies stay as they are; only these 3–5 get the full treatment.

### 7. Two or three engineers to name as authors

**What we mean:** articles and case studies on the site currently have no author, so they read as "Viezo" in general. We'd like to show a real person on them, e.g. *"Analysis by Jonas Jonaitis, Vibration Analyst (ISO 18436 Category II), 8 years in condition monitoring"*, with a small photo and a link to a short profile page.

**Why:**
- Google's quality guidelines (called E-E-A-T: experience, expertise, authority, trust) favour content where a real, qualified person stands behind it. This matters most for technical and safety-related topics like machine failures.
- AI assistants also prefer sources with a named expert.
- The strongest competitor in Poland, I-care, has 22 expert profile pages. [Example: Pieter Van Camp](https://www.icareweb.com/experts/pieter-van-camp/), with photo, role, experience, and links to the articles he wrote or reviewed.

**What we need, for 2–3 people** (the engineers who actually analyse the data and write the diagnoses):
- full name and job title,
- years of experience in maintenance or vibration analysis,
- certifications, if any (e.g. ISO 18436 vibration analyst category, mechanical engineering degree),
- 2–3 sentences about what they do at Viezo and the machines they know best,
- a professional photo (a phone photo against a plain wall is fine),
- their LinkedIn profile link,
- their OK to be shown publicly.

**What we'll do:** a short profile page for each engineer, with their name shown as the author on the case studies and explainer articles they worked on.

### 8. Which other systems does Sonora connect to?

**What we mean:** many factories already use other software, and buyers often ask whether Sonora works with it. The usual ones:
- **Maintenance software (CMMS):** where the maintenance team plans work and logs repairs. Examples: SAP PM, IBM Maximo, Fiix, MaintainX, eMaint. Buyers ask: *"Can a Sonora alert automatically create a work order there?"*
- **Factory control systems (SCADA / PLC):** the systems that run the production line. Buyers ask: *"Can Sonora data show up on our control-room screens?"*
- **API or webhooks:** a technical way for the client's IT team to pull Sonora data into their own systems.
- **Alert channels:** how alerts reach people: email, SMS, Microsoft Teams, a mobile app.
- **Exports:** downloading data or reports, e.g. as Excel or PDF.

**What we need:** for each item, "yes" (and how), "on request", or "no". If integrations are planned, roughly when.

**Why:**
- This is one of the first questions IT and maintenance managers ask, and an unanswered question in a sales process often becomes a "no".
- Competitors publish it: Schaeffler has a [developer page for its OPTIME system](https://developer.schaeffler.com/use-cases/schaeffler-optime), and Waites advertises a partnership with the MaintainX maintenance software.
- AI assistants answer questions like "vibration monitoring that integrates with SAP" only from sites that say so.

**What we'll do:** a short "Integrations" section on the Sonora page, or a single FAQ answer if the list is short. We will only publish what Viezo confirms.

### 9. Translate one case study into Polish

**Which one:** [Granulator bearing fault (validated after initial dismissal)](https://viezo.lt/case-study/granulator-bearing-fault-validated-after-initial-dismissal/). Client: De Heus (animal nutrition), January 2026. Sonora flagged bearing wear on a granulator drive motor; the plant first dismissed it as a false alarm, but further data confirmed an outer-race bearing defect. It's one of the most interesting cases because it shows the system was right when people doubted it.

**The problem:** all other case studies exist in English and Polish, but this one is English only. Visitors to the Polish site never see it, and Polish Google can't show it.

**Why it matters:** the Polish pages perform best in Google. The Polish home page is clicked by 35% of people who see it in results, against 16% for the English home page. De Heus is also active in Poland, so the story is relevant to Polish readers.

**What we need:** a yes or no. If yes, we translate it and Viezo checks the technical terms.

## C. Quick confirmations

### 10. What is the company's legal name?

The Privacy Policy says the site is operated by **UAB "Nanoenergija"**. The Contact page and the company registry say **Viezo, UAB** (company code 304885690). Which is correct?

**Why:** search engines and AI assistants match names across sources. Two different legal names for one website confuse them, and the privacy policy should name the right data controller anyway, which is a legal matter as well as an SEO one. Structured data currently says "Viezo, UAB".

**What we'll do:** update the Privacy Policy wording (or you give us the corrected text) and keep the name consistent everywhere.

### 11. Keep the four EU funding posts as they are?

There are four separate posts (InoConnect, Experiment, Creative Checks, and a general one), plus the EU funds page. The audit suggested merging them, but:
- EU funding rules usually require publicity notices for each project to stay online, and
- the InoConnect post brings real traffic (719 impressions, 9 clicks; people search for "inoconnect").

**What we need:** confirm that each post must stay as it is for the funding requirements, or tell us they can be combined into the EU funds page with redirects.

### 12. The Terms of Use page is empty

The English and Polish Terms of Use pages have no text (3–4 words). We've hidden them from Google until they have content, so they don't drag down the site's quality score. They come back automatically once filled in.

**What we need:** the terms text, or confirmation that the page can be removed from the menu or footer.

### 13. A Lithuanian version: yes, no or later?

The domain is .lt and the company is Lithuanian, but the site is English and Polish only. Search Console shows Lithuania is already the top country by clicks (351), mostly people searching for "Viezo" by name.

**What we need:** a business decision. Are Lithuanian clients a target? If yes, we'd start with the home page, Sonora, Pricing and Contact.

---

## Summary for the reply

| # | Question | Short answer is enough? |
|---|---|---|
| 1 | Publish price ranges? Which? | Yes/no + numbers |
| 2 | 2–3 headline numbers | Numbers + how counted |
| 3 | Sonora specs + buyer FAQ | A document or email |
| 4 | OK to rewrite case-study titles | Yes/no (list follows) |
| 5 | Clients who'd leave a G2/Capterra/Google review | 5–10 names + contact person |
| 6 | For 3–5 case studies: client quote, Sonora vibration chart, photo of the damaged part, numbers, client's OK | Pick cases + material |
| 7 | 2–3 engineers shown as authors: name, title, experience, photo, LinkedIn | 2–3 people |
| 8 | Does Sonora connect to maintenance software, control systems, API, Teams/SMS, exports? | Yes/no per item |
| 9 | Translate the De Heus granulator case study into Polish | Yes/no |
| 10 | Legal name: Viezo, UAB or Nanoenergija? | One word |
| 11 | EU funding posts: keep separate? | Yes/no |
| 12 | Terms of Use text | Text or "remove" |
| 13 | Lithuanian version | Yes/no/later |
