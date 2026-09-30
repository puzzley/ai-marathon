# 04 · 🔎 The Missing Package
> **Concept:** Context engineering · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** The model only knows what you put in its **context** (the prompt). Too little, and it guesses. Too much, and it gets slower, more expensive and **less accurate**, because important facts get lost in the noise. Context engineering means sending **the smallest set of useful information, in a clear structure**. It is the main skill behind good results at low cost, both in AI features and in coding agents.

**The story:** A customer writes to "ShopRight" support. The answer is somewhere in thousands of lines of data, and one important fact is hidden where no search will find it.

## You get
- `question.txt`: the customer's message.
- `orders.json`: 40 orders.
- `shipping-log.txt`: the courier log for all orders.
- `chat-history.json`: earlier chat messages with this customer.
- `policies.md` and `product-faq.md`: company documents.

## The rule of this challenge
Your final prompt (instructions + context + question) must be **at most 1,500 input tokens**. Check `usage.prompt_tokens`.

## Your task
1. **Dump everything.** Send all files plus the question. Record the tokens, the cost and the answer.
2. **Select with code.** Use plain code, not AI, to keep only what matters: the right order, its log lines, the relevant policy sections. This is the cheapest context engineering there is.
3. **Compress.** The chat history is long, and the important fact in it does not mention the order number. Reduce it to the few facts that matter. You can use a cheap model for this, but count its tokens too.
4. **Structure.** Build the prompt in clear, labelled sections, for example `## Instructions`, `## Order`, `## Shipping events`, `## Customer notes`, `## Policy`, with the question at the end.
5. Compare step 1 with your final version.

## Done when
- [ ] Your final answer contains all **4 key facts** (find them yourself, then check with the organizers).
- [ ] Final prompt: **1,500 input tokens or fewer.**
- [ ] A table: "dump everything" vs "engineered", with tokens, cost and the number of key facts found.
- [ ] You can explain which parts you chose with **code** and which with **AI**, and why.

## Bonus
- Put the most important fact in the **middle** of a very long prompt. Is it still used? Search for "lost in the middle".
- Instead of choosing the context yourself, give the model tools like `get_order(id)` and `search_log(order_id)` and let it fetch what it needs. This is called **just-in-time context**.

## Words to learn
context window · context engineering · signal vs noise · selection · compression · summarization · structure · context rot

## Watch out
- "Dump everything" can still give a correct answer. Then compare the **cost**, and run it 3 times: is it correct every time?
- A summary that drops the important detail is worse than no summary.
