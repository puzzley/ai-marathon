# 08 · 🔍 Trust, but Verify
> **Concept:** Preventing hallucinations · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** A **hallucination** is a confident answer that is not true. Models are trained to be helpful, so they often **invent** an answer instead of saying "I don't know". They also accept false ideas hidden inside a question. You cannot make hallucinations impossible, but you can make them **rare and easy to catch**:
- Give the model the source.
- Allow it to say "I don't know".
- Make it quote its evidence.
- **Check the quotes with code.**

**The story:** Nimbus Kitchen wants a chatbot for its kettles. Customers ask tricky questions. One wrong answer about a product can mean an angry customer or a legal problem.

## You get
- `specs.md`: the spec sheet for 3 kettles.
- `questions.json`: 10 questions. 4 are answerable, 3 are **not in the document**, and 3 contain a **false premise** (a wrong idea inside the question).

## Your task
1. **No source.** Ask the 10 questions **without** the spec sheet. Count the confident answers that are invented.
2. **Grounded.** Now send the spec sheet. Ask for JSON:
   ```json
   {"status": "answered | not_in_document | false_premise",
    "answer": "...",
    "quotes": ["exact sentence copied from the spec sheet"]}
   ```
   Tell the model: use only the document, copy quotes exactly, say `not_in_document` when the answer is missing, and correct wrong ideas in the question.
3. **Verify with code.** Check that every quote really appears in `specs.md`. Ignore extra spaces, but nothing else. Any answer with a fake quote fails. Optional: send the error back and ask again.
4. Score all 10 against `expected_status`.

## Done when
- [ ] Step 1: you counted the invented answers.
- [ ] Final version: **10/10** correct `status`.
- [ ] **Zero** quotes that your code cannot find in `specs.md`.
- [ ] Questions 8–10: the answer corrects the wrong idea instead of playing along.

## Bonus
- Run your final version 5 times. Is it stable? Does a lower `temperature` change anything?
- Add a second "checker" call: *"Is this answer fully supported by these quotes? yes/no"*.

## Words to learn
hallucination · grounding · citation · quote verification · false premise · abstaining ("I don't know") · temperature

## Watch out
- A lower temperature makes answers more **repeatable**, not more **true**.
- Quotes can be real but still not support the answer. Code catches fake quotes; for wrong reasoning you need an eval (Challenge 05) or a checker.
