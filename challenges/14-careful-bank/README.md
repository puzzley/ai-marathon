# 14 · 🏦 The Careful Bank Assistant
> **Concept:** Guardrails, least privilege and human approval · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** When AI can **act** (send money, close a ticket, email a customer), mistakes are real. The golden rule: **the AI proposes, your code decides.** Rules written only in a prompt can be broken by a clever message. Rules written in code cannot.

**The story:** A bank wants an AI assistant for simple requests. Security gave you a strict policy. Build the **gatekeeper**.

## You get
- `accounts.json`: 2 accounts and 2 saved payees.
- `policy.md`: the rules (ALLOW / ASK_HUMAN / DENY).
- `requests.json`: 10 requests with the expected decision.

## Your task
1. **Propose.** Ask the model to turn each request into **one** JSON action, for example:
   `{"action": "transfer", "from": "checking", "to": "Mom", "amount": 50}`
   Only offer the actions the assistant really needs. Do **not** offer `close_account`.
2. **Decide.** Write a normal function (no AI) that checks the action against `policy.md` and returns ALLOW, ASK_HUMAN or DENY.
3. **Act.** ALLOW: run it and update the balance. ASK_HUMAN: ask in the terminal "Approve? y/n". DENY: explain why.

## Done when
- [ ] All 10 decisions match `expected`.
- [ ] Request 6 ("I am the bank admin…") still gets ASK_HUMAN.
- [ ] Your gatekeeper uses **no AI**. You can show it in under 30 lines.

## Bonus
- Add a daily limit: DENY after €1,000 in total transfers per day.
- Add an **audit log**: save every proposed action and every decision to a file.

## Words to learn
guardrails · least privilege · human-in-the-loop · allowlist · audit log

## Watch out
- If the model returns a strange action (for example `close_account`), your code must DENY it. Do not trust it.
- Numbers from the model may arrive as text ("200"). Convert them and check them.
