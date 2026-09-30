# B2 · 💸 Boss Challenge: The Cheapest Model That Passes
> **Concepts:** evals + cost + model routing · **Level:** ⭐⭐⭐ · **Time:** 2 hours

**Why it matters:** In production the question is not "which model is best?". The question is **"which is the cheapest setup that is good enough?"** You can only answer it with an eval.

**The story:** Happy Paws Clinic (Challenge 05) wants to classify 5,000 messages per day. Find the cheapest setup that is still safe.

## You get
- The data from `../05-pet-clinic-triage/` (you do not need to have done Challenge 05).
- The **hidden test set**: ask the organizers.

## Your task
1. Build an eval runner that prints **accuracy, missed emergencies and total cost** per setup.
2. Try at least 4 setups, for example a small model, a big model, a small model with few-shot examples, and a local model.
3. **Routing:** send each message to a cheap model first. If it answers EMERGENCY or is unsure, ask a stronger model.
4. Choose a winner. The rules: **zero missed emergencies**, at least 90% accuracy on the hidden test set, lowest cost.

## Done when
- [ ] A table: setup, accuracy, missed emergencies, cost per 1,000 messages.
- [ ] A winner that passes the rules on the **hidden** test set.
- [ ] A 3-sentence recommendation to the "clinic manager".
