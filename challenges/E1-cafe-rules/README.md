# E1 · ☕ Café Rules
> **Concept:** System prompts · **Level:** ⭐ · **Time:** ~1 hour

**Why it matters:** The **system prompt** is the job description of your AI. It sets the role, the rules and the limits. A good one keeps the bot on topic and safe. A bad one makes the bot invent things or promise things you do not want.

**The story:** "Bean There Café" wants a chat assistant for its website. The owner has 6 rules. Your job: write a system prompt that makes the bot follow **all** of them.

## The owner's rules
1. Only recommend items from the menu (`menu.json`).
2. Answer in **2 sentences maximum**.
3. Never offer discounts or free items.
4. Reply in the **same language** as the customer.
5. For questions that are not about the café, politely say you can only help with café questions.
6. For allergy questions, use only the menu's allergen list. If something is not listed, say so and suggest asking the staff.

## You get
- `menu.json`: 8 items with prices, vegan info and allergens.
- `tests.json`: 9 customer messages and the expected behaviour.

## Your task
1. Write a system prompt. Put the menu inside it.
2. Send each test message with your system prompt (one separate conversation per test).
3. Check each answer against `expected`. Improve the prompt and run **all** tests again.

## Done when
- [ ] All 9 tests pass by your own honest judgement.
- [ ] You saved version 1 and your final version of the prompt, and you can explain what you changed and why.

## Bonus
- Automate some checks with code: count the sentences, or check that no price is invented.
- Ask a second model to judge each answer ("Does this reply follow rule 3? Answer yes or no."). This is called **LLM-as-a-judge**.

## Words to learn
system prompt · role · constraints · grounding · temperature

## Watch out
- Test 8 tries to change the bot's rules. The system prompt must stay stronger than the user's message.
- Fixing one test often breaks another. That is why you run **all** tests after every change.
