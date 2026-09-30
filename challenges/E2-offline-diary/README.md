# E2 · ✈️ The Offline Diary
> **Concept:** Local models · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** Some data must never leave your computer or your company network (privacy, law, customer contracts). **Local models** run on your own machine: no internet, no API bill, no data sharing. The trade-off: they are usually weaker and need good hardware.

**The story:** A private diary app wants to tag the mood of each entry. The user says: "My diary must **never** go to the internet."

## You get
- `diary.json`: 5 entries with the correct mood (`happy`, `sad`, `angry`, `anxious`, `calm`).

## Your task
1. Install **Ollama** (ollama.com) and download a **small** model, for example 1 to 4 billion parameters: `ollama pull <model-name>`. Pick one from the Ollama library.
2. Call it from code. Ollama uses the **same request format as OpenRouter**. Change only the base URL to `http://localhost:11434/v1` and the model name.
3. For each entry, return `{"mood": "...", "summary": "max 12 words"}`.
4. **Turn off Wi-Fi** and run it again.
5. Run the same code with a cloud model on OpenRouter and compare.

## Done when
- [ ] It works with Wi-Fi **off**.
- [ ] A table: local vs cloud: correct moods (x/5), time per entry, cost.
- [ ] You changed **only** the base URL and model name to switch between local and cloud.

## Bonus
- Try 2 local models of different sizes. Where does quality become "good enough"?
- Watch RAM usage while the model runs.

## Words to learn
local model · open-weight model · parameters (1B, 7B…) · quantization · inference · privacy

## Watch out
- Big models need a lot of RAM. Start small.
- The first call is slow because the model loads into memory. Measure the time from the second call.
