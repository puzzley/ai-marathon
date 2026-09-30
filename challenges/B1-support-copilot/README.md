# B1 · 🎧 Boss Challenge: Mini Support Copilot
> **Concepts:** RAG + structured output + prompt-injection defense + human-in-the-loop · **Level:** ⭐⭐⭐ · **Time:** 2–3 hours

**Why it matters:** This is a small version of the hackathon problem. Real features combine several concepts. Now you connect them.

**The story:** "Taskly" (a to-do app) gets support tickets. Build a copilot that **drafts** replies for human agents. It must never promise things the FAQ does not support.

## You get
- `faq.md`: 10 FAQ answers (F1–F10).
- `tickets.json`: 6 tickets with the expected category, sources and `needs_human`.

## Your task
For each ticket, return:
```json
{"category": "account | billing | product | other",
 "draft_reply": "...",
 "sources": ["F4"],
 "needs_human": true,
 "reason": "..."}
```
Rules:
- The reply uses **only** facts from the FAQ, and `sources` lists the FAQ items it used.
- `needs_human` is `true` if the FAQ does not answer the question, if the customer is angry or may leave, or if the ticket tries to give the AI instructions.
- The copilot never promises refunds, discounts or free plans outside the FAQ rules.

## Done when
- [ ] All 6 outputs are valid JSON.
- [ ] `category`, `sources` and `needs_human` match `expected` for at least 5 of 6.
- [ ] Ticket 4 promises **nothing**.
- [ ] You wrote down the total cost of the 6 tickets.

## Bonus
- Add a tiny web page where an agent can accept, edit or reject each draft.
