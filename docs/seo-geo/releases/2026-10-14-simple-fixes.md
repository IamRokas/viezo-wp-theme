# Release 2026-10-14 · Simple SEO/GEO fixes (theme 2.2.0)

**Status: deployed to viezo.lt on 2026-10-14 and verified.** On production PHP cannot write the site root, so the `seo-server` seed could not change `robots.txt` or `.htaccess`. Both were changed by hand over SSH (see "If something fails"); backups are `robots.txt.viezo-backup` and `.htaccess.backup-20261014` in `/var/www/viezo.lt/`. Checked after deploy: robots.txt is served by the theme; gzip is on for HTML (home 137 KB → 21.9 KB), main.css (135 KB → 26 KB), index.js and style.css; llms.txt, Organization schema, x-default and the 4.8 MB hero video are live. Apache has mod_deflate and mod_filter loaded.

Production facts learned here:
- The theme folder on production is `wp-content/themes/viezo/`. At deploy time it was `viezo_2026_10_08/`, with an old inactive `viezo/` copy. After the deploy it was renamed to `viezo/` and the old themes were deleted (2026-10-14). `npm run zip` packages under `viezo/`.
- PHP can't write the site root (`robots.txt`, `.htaccess`): server-file changes need SSH (`ec2-user`, `sudo`).
- Check compression with a GET, not `curl -I`: Apache doesn't gzip HEAD responses from PHP, so `-I` wrongly shows the home page as uncompressed.

The fixes from the backlog that need no client input. Everything ships in the theme. Three one-click seeds then change the settings, server files and media the theme can't change by itself.

## What's in it

| Backlog | Change | Where | Live after |
|---|---|---|---|
| T-01, S-07 | robots.txt allows everything except /wp-admin/ (images included), names AI crawlers, links sitemap and llms.txt | `inc/seo.php` + seed `seo-server` | seed |
| T-02 | gzip for HTML, CSS, JS, SVG, fonts | seed `seo-server` (.htaccess) | seed |
| T-03 | Home hero video 50 MB → 4.8 MB (720p, no audio), poster image shown while loading | seed `seo-home-video`, `partials/page-header.php` | seed |
| T-05 | `hreflang="x-default"` → English version on every page | `inc/seo.php` | upload |
| T-05 | Polish meta description on /pl/studia-przypadkow/ (was English) | `inc/seo.php` | upload |
| T-06 | Terms of Use (EN/PL) noindex and out of the sitemap while empty; indexable again automatically once they have 100+ words | `inc/seo.php` | upload |
| S-01 | Organization schema: name, legal name "Viezo, UAB", logo, Vilnius address, email, phone, LinkedIn, what Viezo does | `inc/seo.php` + seed `seo-organization` | seed |
| S-02 | Product schema for Sonora (EN + PL Sonora pages), no price/rating yet | `inc/seo.php` | upload |
| S-03 | Article schema on all case studies: author Viezo, about vibration monitoring + industry, mentions Sonora and the client | `inc/seo.php` | upload (+ seed for Organization) |
| S-04, S-06 | `/llms.txt` and `/llms-full.txt`, generated from the site (pages, descriptions, all case studies EN + PL), states that viezo.com and similar names are unrelated | `inc/llms.php` | upload |

Not in this release:
- **T-04 WebP:** done with the WebP Express plugin instead (see step 5).
- **T-05 missing translation:** the granulator case study has no Polish version, so there is nothing to link. It needs a translation (content).
- **T-06 EU funding posts:** not merged or redirected. Three are EU project publicity notices, which funded projects usually have to keep public, and `/eu-funding-inoconnect/` has 719 impressions. Needs Viezo's decision.
- **M-02 GA4 AI-referral report:** set up in the GA4 interface (step 7).

## Deploy

1. **Back up**: database and the site root's `robots.txt` and `.htaccess` (the seed also keeps a robots backup).
2. **Build the package** locally: `npm run zip` → `dist/viezo-YYYYMMDD-HHMM.zip` (about 9 MB, top folder `viezo/` = production's theme folder).
3. **Upload**: Appearance → Themes → Add New → Upload Theme → choose the zip → **Replace current with uploaded**. (Or copy the unzipped folder over `wp-content/themes/viezo/` via SFTP.)
4. **Run the seeds**: Tools → Viezo seeds, then run in this order:
   1. **SEO: organization for schema (Yoast)**
   2. **SEO: server files (robots.txt, compression)**: read its message. If it says robots.txt or .htaccess is not writable, or the site is NOT compressed, see "If something fails".
   3. **SEO: compressed home hero video**
5. **WebP Express**: install and activate, keep the defaults (convert on upload + "Varied image responses" or `<picture>` tags), then use **Bulk convert** on existing images.
6. **Clear caches**: LiteSpeed Cache (if active) and any CDN.
7. **GA4 (M-02)**: Explore → Free form → dimension *Session source*, filter matches regex `chatgpt|openai|perplexity|copilot|gemini|claude|bing.com/chat`. Save it as "AI referrals".

## Verify (5 minutes)

- https://viezo.lt/robots.txt: no `Disallow: /wp-content/uploads/`, lists GPTBot, ClaudeBot and others.
- https://viezo.lt/llms.txt and /llms-full.txt: load as text and list the case studies.
- Compression: `curl -s -D - -o /dev/null -H "Accept-Encoding: gzip" https://viezo.lt/ | grep -i content-encoding` shows `gzip` (use a GET; `curl -I` gives a false negative for PHP pages).
- Home page: video starts quickly. In DevTools → Network the hero mp4 is about 4.8 MB.
- Schema: https://validator.schema.org on the home page (Organization), the Sonora page (Product) and one case study (Article). Google's Rich Results Test should report no errors.
- View source on any page: `hreflang="x-default"`.
- https://viezo.lt/terms-of-use/ source: `noindex, follow`.
- Search Console: inspect the home page and request indexing. Resubmit the sitemap.

## If something fails

- **robots.txt not writable** (the case on production): over SSH, `cd /var/www/viezo.lt && sudo cp -p robots.txt robots.txt.viezo-backup && sudo rm robots.txt`. WordPress then serves the theme's version.
- **.htaccess not writable** (the case on production): back it up (`sudo cp -p .htaccess .htaccess.backup-YYYYMMDD`), then append this block with `sudo tee -a /var/www/viezo.lt/.htaccess`:

  ```apache
  # BEGIN Viezo compression
  <IfModule mod_deflate.c>
  	<IfModule mod_filter.c>
  		AddOutputFilterByType DEFLATE text/html text/plain text/css text/xml text/javascript
  		AddOutputFilterByType DEFLATE application/javascript application/x-javascript application/json application/ld+json
  		AddOutputFilterByType DEFLATE application/xml application/xhtml+xml application/rss+xml image/svg+xml
  		AddOutputFilterByType DEFLATE font/ttf font/otf application/x-font-ttf application/vnd.ms-fontobject
  	</IfModule>
  </IfModule>
  # END Viezo compression
  ```

- **Still not compressed**: `mod_deflate` / `mod_filter` aren't loaded in Apache. Enable them on the server (`a2enmod`, or on Amazon Linux check `/etc/httpd/conf.modules.d/00-base.conf`), or put Cloudflare in front (backlog T-07).

## Rollback

- Theme: upload the previous zip.
- robots.txt: rename `robots.txt.viezo-backup` back to `robots.txt`.
- Compression: delete the `# BEGIN/END Viezo compression` block from `.htaccess`.
- Video: set the home pages' *Header background* back to `Indutrial-Web-video-main-page-1-1.mp4` (still in the Media Library).
- Organization: Yoast → Settings → Site representation.

## Tested locally (2026-10-14)

All three seeds ran. robots.txt was served by WordPress. Home and style.css were gzipped (nginx locally, so the .htaccess block itself could not be exercised). Organization, Product and Article schema were present with no Person piece. x-default was present. Terms was noindex and Privacy indexable. The PL archive showed the Polish description. llms.txt listed EN + PL pages and case studies with the translated archive URL.
