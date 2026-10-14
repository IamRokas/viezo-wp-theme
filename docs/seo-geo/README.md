# SEO & GEO workspace

Ongoing work on viezo.lt visibility in Google and in AI answers (ChatGPT, Perplexity, Gemini, Copilot). Everything dated uses `YYYY-MM-DD`. Newest facts win; old files are kept, not overwritten, so we can see what changed.

| Folder | What goes in it | Updated |
|---|---|---|
| [00-audit/](00-audit/) | Site audits of viezo.lt. One file per audit, named by date. | Each re-audit (quarterly) |
| [01-competitors/](01-competitors/) | One profile per competitor, the comparison matrix, and how we score them. | Profiles: quarterly. Matrix: after profile updates |
| [02-insights/](02-insights/) | What we learn from competitors and data: patterns, gaps, ideas. | When a profile or tracking round adds something |
| [03-keywords-prompts/](03-keywords-prompts/) | Search terms (EN/PL) and the AI buyer questions we track. | When Search Console data arrives, then monthly |
| [04-backlog/](04-backlog/) | Single prioritised task list (audit + competitor ideas). Source of truth for what's next. | Every work session |
| [05-tracking/](05-tracking/) | Monthly AI visibility checks and metric snapshots (GSC, GA4, CWV). | Monthly |

## Workflow

1. **Audit** viezo.lt → findings go to `00-audit/`, tasks to `04-backlog/backlog.md`.
2. **Research** competitors → update `01-competitors/profiles/<slug>.md` (use `_template.md`), then `comparison-matrix.md`.
3. **Synthesise** → new patterns into `02-insights/learnings.md`; anything actionable becomes a backlog item with an ID.
4. **Track** monthly → run the prompts in `03-keywords-prompts/ai-prompts.md`, log in `05-tracking/ai-visibility/YYYY-MM.md`.
5. **Log** what shipped in `changelog.md` so results can be tied to changes.

## Conventions

- Competitor slugs: lowercase brand, e.g. `tractian`, `skf`, `schaeffler`.
- Backlog IDs: `T-xx` technical, `C-xx` content, `S-xx` structured data / GEO, `A-xx` authority/off-site, `M-xx` measurement.
- Every claim about a competitor links to its source URL and the date it was checked; their sites change.
- Client-facing reports are HTML and live in `00-audit/` or `02-insights/`; working notes stay Markdown.
