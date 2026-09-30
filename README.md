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

## Setup

Clone the repository and run one script. No Docker. The script does not install system packages and does not change global PHP or Node settings.

### Required software

Install these yourself (any current version):

- Git
- PHP 8 or newer, with the `curl`, `json`, `mbstring`, and `openssl` extensions
- Composer
- Node.js
- npm

On Windows, install the same tools and run the commands from **Git Bash** or **WSL**.

### Run setup

```bash
git clone https://github.com/puzzley/ai-marathon.git
cd ai-marathon
./setup.sh
```

`./setup.sh` checks the commands above, prints their versions, runs `composer install` when `composer.json` exists, runs `npm install` when `package.json` exists, and creates `.env` from `.env.example` when `.env` is absent. Run it again any time. An existing `.env` is never overwritten.

The same steps are available as Make targets: `make setup`, `make install`, and `make health`.

### Configure OPENROUTER_API_KEY

OpenRouter is one API for many models. You can also point `OPENROUTER_BASE_URL` at another OpenAI-compatible API, such as a local Ollama server.

Edit `.env` (this file stays on your machine):

- `OPENROUTER_API_KEY` — the key from the organizers
- `AI_MODEL` — a model id from [openrouter.ai/models](https://openrouter.ai/models), shaped like `provider/model-name`
- `OPENROUTER_BASE_URL` — defaults to `https://openrouter.ai/api/v1`

A small, cheap model is enough for most challenges. Some challenges need **structured outputs** (02), **tools** (09), or **reasoning** (03). Filter for those on the models page.

### Health check

```bash
./health-check.php
```

You should see `PASS` on each line and `All checks passed.` The process exits `0` when PHP, the required extensions, `.env`, the three variables, and a basic HTTP request to `OPENROUTER_BASE_URL` are all fine. Any HTTP status counts as a working connection. DNS failures, timeouts, and refused connections do not. Any `FAIL` line exits non-zero.

The samples below read `OPENROUTER_API_KEY` and `MODEL` from the shell. After `.env` is filled in:

```bash
set -a
source .env
set +a
export MODEL="$AI_MODEL"
```

### Troubleshooting

- **`php`, `composer`, `node`, `npm`, or `git` not found.** Install that program and open a new terminal. `./setup.sh` will not install it.
- **Missing PHP extension (`curl`, `json`, `mbstring`, `openssl`).** Install the extension with your OS package manager, then run `./setup.sh` again. The script does not edit `php.ini`.
- **`.env` missing.** Run `./setup.sh` from the repository root. If `.env` already exists, the script leaves it alone.
- **Health check says a variable is empty.** Set it in `.env`. The example file keeps secrets blank on purpose.
- **HTTP check fails.** Check `OPENROUTER_BASE_URL` for a typo, then check VPN, DNS, or firewall access to that host.
- **`composer install` or `npm install` did nothing.** This pack has no root `composer.json` or `package.json` until you add one. A missing manifest is skipped. If a manifest is present, fix the error it prints.
- **OpenRouter error 402.** The key hit its spending limit. Tell the organizers.
- **`Permission denied` on `./setup.sh`.** Run `chmod +x setup.sh health-check.php` from the repository root.

### Your first call

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

- 🔑 Keys stay in `.env` or in environment variables. Never commit them.
- 🚫 **No real customer or company data** in any challenge. All data in this pack is invented.
- 💰 Your key has a spending limit. If you get error **402**, tell the organizers.
