# 16 · 📚 Living Docs
> **Concept:** Keeping documentation true (drift checks and ADRs) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** Wrong docs are worse than no docs. They mislead people **and** AI agents, because docs become the agents' context. Two simple habits keep docs true:
- **Check docs against the code automatically.** An AI can compare them and point out where they no longer match. A human then decides what to fix.
- **Record decisions as ADRs** (Architecture Decision Records). An ADR is a short, dated note: *what we decided, why, what else we considered, and the consequences*. ADRs never go stale, because you **never edit** an old one. When a decision changes, you write a new ADR, and the old one only gets the status "Superseded".

**The story:** The Ticket Service README has not been updated for a year. And yesterday the team made a big decision in a chat thread, which nobody wrote down.

## You get
- `service/app.py` and `service/README.md`: code and its old README.
- `adr/0003-…md`: an old ADR. `adr/template.md`: the ADR template. `adr/discussion.md`: the chat thread.

## Part A: The drift detector (~35 min)
1. Write a script that sends the README and the code to a model. It asks for a JSON list of findings:
   ```json
   {"doc_says": "...", "code_says": "...", "code_quote": "exact line from app.py",
    "status": "outdated | undocumented | ok"}
   ```
   Check every statement in the README, and also look for code that the README does not mention.
2. Verify with code that every `code_quote` really exists in `app.py` (like Challenge 08).
3. Print a short report.

## Part B: The ADR (~25 min)
1. Ask a model to write `adr/0007-…md` from `discussion.md`, using `template.md`.
2. Check it yourself: is **every** fact in the discussion? Are there no invented numbers, dates or names?
3. Change **only** the status line of ADR-0003 to `Superseded by ADR-0007`. Leave its body unchanged.

## Done when
- [ ] Part A finds **at least 5 of the 6** real mismatches, with **no false alarms** on statements that are still true.
- [ ] Every `code_quote` is verified by your code.
- [ ] ADR-0007 has all template sections, at least 2 rejected alternatives with reasons, and at least 1 negative consequence. Every fact comes from the discussion.
- [ ] ADR-0003: only the status changed.

## Bonus
- Run the drift detector in your CI on every pull request that changes code or docs.
- Ask the model to **propose** a fixed README. A human reviews it. Never let it rewrite docs without review.

## Words to learn
docs-as-code · documentation drift · ADR · immutable record · superseded · single source of truth

## Watch out
- An AI drift check gives **suggestions**, not truth. Verified quotes make its findings easy to check.
- The best docs are the ones you do not need to write by hand: generate what you can from code (for example API specs), and keep the rest short and close to the code.
