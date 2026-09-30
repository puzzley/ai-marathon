# 01 · 🐟 The Goldfish Bot
> **Concept:** Conversation memory · **Level:** ⭐ · **Time:** ~1 hour

**Why it matters:** An AI model remembers **nothing** between API calls. The "memory" you see in chat apps is created by the app, which sends the conversation again every time. Every chatbot, including a support chatbot, must solve this problem.

**The story:** You built a chatbot, but it has the memory of a goldfish. Sara tells it her name, and three messages later it has forgotten. Fix it.

## You get
- `script.txt`: 12 messages. Send them one by one. The last message tests the bot's memory.

## Your task
1. **Goldfish version.** Build a small chat loop in the terminal. Send **only the newest message** to the model each time. Run the script and see the bot fail the last question.
2. **Full memory.** Keep a `messages` list. Add every user message **and** every assistant reply, and send the whole list each time. Run the script again.
3. **Watch the cost grow.** Print `usage.prompt_tokens` after each call. What happens to the number?
4. **Small memory.** Limit the history to the **last 4 messages**. The last question fails again. Fix it by also keeping a short **summary** or a **facts list** (for example "name: Sara") that you send in every call.

## Done when
- [ ] Step 1: the bot does **not** know Sara's name.
- [ ] Step 2: the bot answers "Sara, Pepper, nurse".
- [ ] Step 3: you can explain why `prompt_tokens` keeps growing.
- [ ] Step 4: with only 4 recent messages **plus** your summary, the bot still answers "Sara, Pepper, nurse".

## Bonus
- Let the model update the summary itself: "Here is the old summary and the new messages. Write the new summary."

## Words to learn
stateless · context window · `messages` array · roles (`system`, `user`, `assistant`) · summarization

## Watch out
- Forgetting to add the **assistant's** replies to the history.
- A summary that is too vague. "User talked about pets" loses "the cat is called Pepper".
