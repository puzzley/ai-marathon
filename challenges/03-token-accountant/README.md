# 03 · 🧾 The Token Accountant
> **Concept:** Tokens, cost and "thinking" · **Level:** ⭐ · **Time:** ~1 hour

**Why it matters:** You pay for AI by the **token** (a piece of a word). You pay for tokens you send (**input**), tokens you get back (**output**) and, with "thinking" models, hidden **reasoning tokens**. Three levers decide most of the bill:
- **Which model** you use.
- **How much thinking** you ask for.
- **Whether repeated input is cached** (reused at a lower price).

**The story:** The Galaxy Hotel wants an AI that answers guest questions from its guide. The manager asks: "How much will it cost, and how do we get correct answers without paying for more than we need?"

## You get
- `hotel-guide.md`: the guest guide.
- `questions.json`: 3 easy lookup questions and 2 questions that need reasoning, with the correct answers.
- `same-meaning.json`: the same sentence in English and in Persian (for the bonus).

## Your task
1. **Measure.** Put the guide in the **system** message and the question in the **user** message. Answer all 5 questions with 2 models, a small one and a big one. For every call, record from `usage`: `prompt_tokens`, `completion_tokens` and `cost`. Also record the time and whether the answer is correct.
2. **Thinking.** Pick a model that supports reasoning. Run questions 1, 4 and 5 twice: once with `"reasoning": {"effort": "low"}` and once with `"high"`. Record `usage.completion_tokens_details.reasoning_tokens`. Where does more thinking help, and where is it wasted?
3. **Short answers.** Add "Answer in one sentence." Compare `completion_tokens` with step 1.
4. **Caching.** Keep the system message **exactly** the same and ask the 5 questions one after another. Look at `usage.prompt_tokens_details.cached_tokens`.

## Done when
- [ ] A table with model, effort, input tokens, output tokens, reasoning tokens, cost, time and correct (yes/no).
- [ ] You found the **cheapest setup that answers 5/5 correctly**.
- [ ] You saw `cached_tokens` above 0, **or** you can explain why your model did not cache.
- [ ] You can answer: *Why must the repeated part go first? When is high reasoning effort worth the money?*

## Bonus
- Send only the English sentence, then only the Persian one. Compare `prompt_tokens`. What does this mean for the cost of a non-English product?
- Estimate the monthly cost of your cheapest setup for 10,000 questions per day.

## Words to learn
token · input / output / reasoning tokens · reasoning effort · prompt caching · cache hit · `max_tokens` · latency

## Watch out
- Caching works on the **beginning** of the prompt. If anything at the start changes (even a date or a space), the cache is missed.
- Some providers cache automatically above a minimum prompt size, and others need you to mark the cached part. Check your model's notes on the OpenRouter models page.
- With reasoning models, a small `max_tokens` can cut the answer off, because thinking uses tokens too.
- A cheap answer is worthless if it is wrong. Check correctness first.
