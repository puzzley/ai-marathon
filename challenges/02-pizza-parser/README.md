# 02 · 🍕 Pizza Order Parser
> **Concept:** Structured output (JSON) · **Level:** ⭐ · **Time:** ~1 hour

**Why it matters:** Your code cannot use "Sure! Here is your order…". It needs clean data that it can save in a database or send to another system. At work, this is how you turn a messy support ticket into `{category, priority, customer_id}`.

**The story:** Customers of "Luigi's Pizza" write messy chat messages. Turn each one into clean JSON that the kitchen system can read.

## You get
- `menu.txt`: pizzas, sizes, extras and the default size.
- `schema.json`: the exact JSON shape you must return.
- `orders.json`: 8 messages, each with the `expected` JSON.

## Your task
1. Send each message and ask for JSON. Use the `response_format` parameter with your schema:
   ```json
   "response_format": {
     "type": "json_schema",
     "json_schema": { "name": "pizza_order", "strict": true, "schema": { "...": "paste schema.json here" } }
   }
   ```
2. Parse the reply in your code (`json.loads`, `json_decode`, `JSON.parse`) and compare it with `expected`. Ignore the order of items in the list.
3. Print a score, for example `7/8 correct`.

## Done when
- [ ] All 8 replies parse as valid JSON (no crashes).
- [ ] At least 7 of 8 match `expected`.
- [ ] You can explain the difference between "asking for JSON in the prompt" and "using a JSON schema".

## Bonus
- Try the same task **without** `response_format`, only asking in the prompt. How often does parsing break?
- Add a **retry**: if the JSON is invalid, send the error back to the model and ask it to fix it.

## Words to learn
structured output · JSON Schema · `response_format` · enum · validation · retry

## Watch out
- Not every model supports `json_schema`. Filter for "structured outputs" on the OpenRouter models page.
- Order 5 never says "hawaiian". The model must use the menu to understand "ham and pineapple".
