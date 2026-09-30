# 15 · 🧑‍⚖️ The Laptop Committee
> **Concept:** Multi-agent orchestration · **Level:** ⭐⭐⭐ · **Time:** ~1 hour

**Why it matters:** In a **multi-agent** system, one **orchestrator** splits a big job into parts, gives each part to a **worker** (a separate model call with its **own, small context**), then combines the results. It helps when a job splits into **independent** parts, or when all the material together is too big for one context. The price is high: one well-known report measured multi-agent systems using about **15 times more tokens** than a normal chat. So the real skill is knowing **when not** to use it.

**The story:** Your team needs new laptops. There are 4 candidates, each with a long, marketing-heavy product sheet. Build a small committee of AI agents to find the one that meets **all** requirements.

## You get
- `requirements.md`: 6 must-have requirements.
- `laptops/`: 4 product sheets.
- `expected.json`: the answer key. **Look at it only after your run.**

## Your task
1. **Single agent.** One call with the requirements plus **all 4** sheets: "Which laptop meets all requirements?" Record tokens, time and the answer.
2. **Workers.** For each laptop, make a separate call that sees the requirements plus **only that one sheet**. It returns JSON:
   ```json
   {"laptop": "...", "ram_gb": 0, "ssd_gb": 0, "weight_kg": 0, "battery_h": 0,
    "price_eur": 0, "linux_supported": true, "meets_all": false,
    "evidence": {"ram_gb": "exact quote from the sheet", "...": "..."}}
   ```
3. **Orchestrator.** Your code sends the 4 jobs (in parallel if you can), collects the JSON and picks the winner. The comparison can be plain code; it does not need AI.
4. **Compare.** Single agent vs committee: tokens, time, correct winner, and correct reason for every rejected laptop.

## Done when
- [ ] The committee picks the right laptop, and every rejection has the right reason (check `expected.json`).
- [ ] Each worker saw **only its own** sheet.
- [ ] A table: single agent vs committee, with total tokens, time and correctness.
- [ ] You wrote 3 sentences: *When is multi-agent worth the extra tokens, and when is one agent better?*

## Bonus
- Add a **reviewer** agent that checks each worker's evidence against its sheet before the orchestrator decides.
- Imagine 40 laptops with 30-page manuals. Which approach still works, and why?

## Words to learn
multi-agent · orchestrator · worker / subagent · context isolation · parallel calls · fan-out / fan-in · evaluator (reviewer)

## Watch out
- Watch the traps: weights in grams, "up to" battery claims, and marketing text that sounds positive but hides a missing requirement.
- More agents means more calls, more tokens and more places to fail. Start with the simplest design that works.
