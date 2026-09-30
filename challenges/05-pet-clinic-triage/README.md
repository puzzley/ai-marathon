# 05 · 🐶 Pet Clinic Triage
> **Concept:** Evals (measuring AI quality) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** "It looks good" is not a measurement. An **eval** is a test set with correct answers plus a score. With an eval you can compare prompts and models, and you notice when a change makes things worse. This is the most important habit in AI engineering.

**The story:** "Happy Paws Clinic" gets many messages. An AI must send each one to the right queue. A mistake can be dangerous: a real emergency must never wait in the normal queue.

## You get
- `messages.json`: 24 messages with the correct `label`.
- `clinic-rules.md`: the clinic's routing rules.
- `starting-prompt.txt`: a simple first prompt.

## Your task
1. **Build the eval.** Write a script that runs all 24 messages, compares the answer with `label`, and prints the **accuracy** plus a list of the wrong ones.
2. **Measure the baseline** with `starting-prompt.txt`. Write the score down.
3. **Improve** the prompt (use the clinic rules, add examples) and run the eval again after every change.
4. **Run your best prompt 3 times.** Is the score the same every time?

## Done when
- [ ] Your script prints the accuracy and the wrong messages.
- [ ] Baseline score and final score are written down.
- [ ] Final prompt: at least **22/24** in all 3 runs.
- [ ] **Zero** real emergencies labelled as something else.

## Bonus
- Print a **confusion table** (true label vs predicted label).
- Ask the organizers for the **hidden test set**. Does your prompt still score well on messages it has never seen?

## Words to learn
eval · test set · accuracy · baseline · regression · few-shot examples · overfitting

## Watch out
- Some messages are tricky on purpose. Read `clinic-rules.md` carefully.
- If you tune your prompt for exactly these 24 messages, it may fail on new ones. That is **overfitting**.
