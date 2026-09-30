# 🏃 AI Marathon: Challenge Pack

**Goal:** learn one AI concept per challenge by building something small and fun.
This is not a competition. **Every finisher is a winner.**

---

## How it works

- **Pick any challenge.** They do not depend on each other. You can do them in any order.
- **About 1 hour each.** Work solo or with a partner.
- **Use any language and any AI tool.** The data is plain JSON or text. Every challenge works with any model through a standard API.
- **AI help is allowed and encouraged.** But you must be able to **explain** your solution.
- **Finished** = every box under "Done when" is checked, and you share your proof (see below).
- **Stuck for 20 minutes?** Ask in the group chat, or skip and come back later.
- **Finisher of the marathon** = everyone who completes all **Core** challenges. 🏅

### Share your proof (for each challenge)
1. A screenshot or log that shows the "Done when" checks.
2. Three sentences: *What did I learn? What surprised me? Where could we use this at work?*

---

## Challenge map

⭐ = easy start · ⭐⭐ = medium · ⭐⭐⭐ = harder. **Core** = the most important ones. Do these first.

| # | Challenge | You learn | Level | |
|---|---|---|---|---|
| 01 | 🐟 Goldfish Bot | Conversation memory | ⭐ | |
| 02 | 🍕 Pizza Parser | Structured output (JSON) | ⭐ | |
| 03 | 🧾 Token Accountant | Tokens, cost, reasoning effort, caching | ⭐ | Core |
| 04 | 🔎 The Missing Package | Context engineering | ⭐⭐ | Core |
| 05 | 🐶 Pet Clinic Triage | Evals (measuring quality) | ⭐⭐ | Core |
| 06 | 🍜 Recipe Mood Search | Embeddings and semantic search | ⭐⭐ | |
| 07 | 📘 Handbook Bot | RAG | ⭐⭐ | Core |
| 08 | 🔍 Trust, but Verify | Preventing hallucinations | ⭐⭐ | Core |
| 09 | 💡 Smart Home | Tool calling | ⭐⭐ | |
| 10 | 🗝️ Dungeon Escape | The agent loop | ⭐⭐ | Core |
| 11 | 🧰 Skill Library | Skills vs context files | ⭐⭐ | Core |
| 12 | 📝 Notes Everywhere | MCP | ⭐⭐ | |
| 13 | 🕵️ Poisoned CVs | Prompt injection | ⭐⭐ | Core |
| 14 | 🏦 Careful Bank | Guardrails and human approval | ⭐⭐ | |
| 15 | 🧑‍⚖️ Laptop Committee | Multi-agent orchestration | ⭐⭐⭐ | |
| 16 | 📚 Living Docs | Doc drift checks and ADRs | ⭐⭐ | Core |

**Extras** (optional side quests): E1 ☕ Café Rules (system prompts) · E2 ✈️ Offline Diary (local models) · E3 🌍 Language Detective (Hugging Face models)

**Boss challenges** (several concepts together): B1 🎧 Mini Support Copilot · B2 💸 Cheapest That Passes

**Quiz** (15 minutes, no code): D1 🤔 Fine-tune or Not?

Each challenge folder has a `README.md` (the instructions) and its data files.

---

## Setup (15 minutes, do this once)

### 1. Your API key
The organizers give you an **OpenRouter** key. OpenRouter is one API for many AI models from many providers. You can also use any other OpenAI-compatible API, for example a local model with Ollama.
Put the key in an environment variable. **Never** put it in your code or in Git.

```bash
export OPENROUTER_API_KEY="sk-or-..."
export MODEL="paste-a-model-id-here"
```

### 2. Pick a model
Open **openrouter.ai/models** and copy a model ID (it looks like `provider/model-name`).
- A **small, cheap model** is enough for most challenges.
- Some challenges need special features: **structured outputs** (02), **tools** (09) or **reasoning** (03). You can filter by these features on the models page.

### 3. Your first call
Choose your language. If you see an answer and a `usage` object, you are ready.

**curl**
```bash
curl https://openrouter.ai/api/v1/chat/completions \
  -H "Authorization: Bearer $OPENROUTER_API_KEY" \
  -H "Content-Type: application/json" \
  -d "{\"model\": \"$MODEL\", \"messages\": [{\"role\": \"user\", \"content\": \"Say hello in 3 words.\"}]}"
```

**Python** (`pip install requests`)
```python
import os
import requests

resp = requests.post(
    "https://openrouter.ai/api/v1/chat/completions",
    headers={"Authorization": f"Bearer {os.environ['OPENROUTER_API_KEY']}"},
    json={
        "model": os.environ["MODEL"],
        "messages": [{"role": "user", "content": "Say hello in 3 words."}],
    },
    timeout=60,
)
data = resp.json()
print(data["choices"][0]["message"]["content"])
print(data["usage"])  # tokens and cost
```

**JavaScript** (Node 18+, save as `hello.mjs`)
```js
const res = await fetch("https://openrouter.ai/api/v1/chat/completions", {
  method: "POST",
  headers: {
    Authorization: `Bearer ${process.env.OPENROUTER_API_KEY}`,
    "Content-Type": "application/json",
  },
  body: JSON.stringify({
    model: process.env.MODEL,
    messages: [{ role: "user", content: "Say hello in 3 words." }],
  }),
});
const data = await res.json();
console.log(data.choices[0].message.content);
console.log(data.usage); // tokens and cost
```

**PHP / Laravel** (add both variables to `.env`, then try it in `php artisan tinker`)
```php
use Illuminate\Support\Facades\Http;

$data = Http::withToken(env('OPENROUTER_API_KEY'))
    ->timeout(60)
    ->post('https://openrouter.ai/api/v1/chat/completions', [
        'model' => env('MODEL'),
        'messages' => [['role' => 'user', 'content' => 'Say hello in 3 words.']],
    ])
    ->json();

echo $data['choices'][0]['message']['content'];
print_r($data['usage']); // tokens and cost
```

> 💡 **Good to know:** OpenRouter uses the common OpenAI-style request format. Any OpenAI-compatible SDK works if you change the **base URL** to `https://openrouter.ai/api/v1`. Local tools (like Ollama in Extra E2) use the same format. So you can switch models and providers by changing one or two lines.

---

## Safety rules

- 🔑 Keys stay in environment variables. Never commit them.
- 🚫 **No real customer or company data** in any challenge. All data in this pack is invented.
- 💰 Your key has a spending limit. If you get error **402**, tell the organizers.
