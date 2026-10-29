# Release 2026-10-29 · Case-study titles + cookie consent (theme 2.4.0 / 2.4.1)

**2.4.1** adds a structured-data fix on top of 2.4.0; deploy 2.4.1 either way.

## What's in it

| Backlog | Change | Where |
|---|---|---|
| C-03 | Approved titles and Google descriptions for all 30 case studies, EN + PL, no client names, URLs unchanged. In Google: "<title> \| Viezo case study" / "\| Studium przypadku Viezo" | seed `seo-case-study-titles`, `vzo__seo_case_study_title()` in `inc/seo.php` |
| M-05 | Cookie banner (EN/PL) with equal "Accept all" / "Reject optional" buttons; "Cookie settings" link in the footer reopens it; GA4 analytics cookies and Microsoft Clarity only after "Accept all"; "Reject optional" later revokes consent and deletes the analytics cookies; asks again after 12 months. Replaces the GlowCookies banner (CDN, English only, single "OK"). Visitors who clicked "OK" before count as accepted. | `inc/consent.php`, `inc/analytics.php`, `footer.php`, `src/scss/global/_consent.scss` |

### 2.4.1 · Search Console "Either 'offers', 'review' or 'aggregateRating' should be specified"

Search Console reported this error on every case study (item name "Sonora"). The cause: Sonora was marked up as a **Product**, both on the Sonora pages and inside each case study's `mentions`. Google validates every Product for a product rich result, which needs a price or reviews. Viezo publishes neither, so it could never pass. Sonora is now a **Service** (sensors plus analysis reviewed by Viezo's analysts), and case studies reference it by `@id` in their own language. No Product items are left on the site. The specs remain on the Sonora page and in llms-full.txt.

**After deploying:** Search Console → Enhancements → Product snippets (or Merchant listings) → open the error → **Validate fix**. Google rechecks over a few days to weeks. The Product report then empties, because there are no products any more; that's expected.

## Deploy

1. `npm run zip` → upload `dist/viezo-YYYYMMDD-HHMM.zip` (Replace current with uploaded).
2. **Tools → Viezo seeds → SEO: case-study titles and descriptions → Run.** Expected: "60 pages updated" (30 EN + 30 PL) and no "Not found". Running it again reports "0 pages updated, 60 already up to date".
3. Clear the LiteSpeed cache, if active.
4. Search Console → URL inspection → Request indexing for the case studies with the most impressions: exhaust-fan-motor-bearing-fault, gearbox-fault-detected-on-a-conveyor-drive, fan-fault, motor-defect, fan-bearing-wear.

## Verify

- A case study, e.g. /case-study/pump-failure/: the heading is "Shaft misalignment on an oil circulation pump caught early". Page source has `<title>… | Viezo case study` and the new meta description. Same on a Polish case study with "| Studium przypadku Viezo".
- /case-studies/: the cards show the new titles.
- Cookie banner, in a private window:
  1. The banner shows. DevTools → Application → Cookies has no `_ga`, `_clck` or `_clsk`.
  2. Click "Accept all": `_ga` and `_clck` appear.
  3. Click "Cookie settings" at the bottom, then "Reject optional": they disappear.
  4. Reload: no banner, and Clarity isn't loaded.
- On a Polish page the banner is in Polish and links to /pl/polityka-prywatnosci/.

## Notes

- **Card excerpts still name clients.** The short text under each card on /case-studies/ is the post excerpt (e.g. "Learn how Sonora detected … at Ulmas"). The approved Google descriptions could replace them; that needs Viezo's OK, since it changes visible text.
- **Polish Terms of Use** is still empty, so it stays out of Google until it has text. The English one (1,160 words) became indexable automatically.
- **Tidio chat** loads on every page independently of the banner, and stores its own data for the chat. It's usually treated as a functional service the visitor uses. If Viezo wants it behind consent too, it can wait for "Accept all" (then visitors who reject get no chat).
- **GA4 before consent** runs in Consent Mode "advanced": no cookies, only anonymous pings (no identifiers) so Google can model visits. If Viezo prefers no requests to Google at all before consent ("basic" mode), GA4 can be loaded only after "Accept all"; reports then show only consenting visitors.
- `MUID` is a Microsoft cookie on clarity.ms/bing.com: the site can't delete it, but after "Reject optional" Clarity no longer loads, so it isn't refreshed.

## Tested locally (2026-10-29)

Titles seed: 58 pages updated (one case study exists only on production), re-run changes nothing, apostrophes render correctly, Yoast index rebuilt so the new descriptions show at once. Consent flow tested in headless Chrome: no analytics cookies before a choice → `_ga`, `_ga_*`, `_clck`, `_clsk` after "Accept all" → remembered on reload → "Cookie settings" reopens → "Reject optional" deletes them → Clarity not loaded after reload. Polish texts and policy link checked. Desktop and mobile layout checked.
