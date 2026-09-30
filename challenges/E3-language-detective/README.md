# E3 · 🌍 The Language Detective
> **Concept:** Small specialized models (Hugging Face) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** Not every problem needs a big chat model. **Hugging Face** hosts thousands of small models trained for one job (detect language, sentiment, spam…). They are fast, free to run and private. The skill is to **find** the right model and **read its model card**.

**The story:** A support inbox gets messages in many languages. Before any AI replies, we must know the language. Do it without an LLM.

## You get
- `phrases.json`: 22 short phrases with the correct language code.

## Your task
1. On **huggingface.co/models**, search for "language detection" (task: text classification). Pick a model and **read its model card**. Which languages does it support?
2. Run it locally on all phrases. Python is the easiest here:
   ```python
   from transformers import pipeline  # pip install transformers torch

   detect = pipeline("text-classification", model="<model-id-you-picked>")
   print(detect("Oggi fa molto caldo.", top_k=1, truncation=True))
   ```
3. Measure accuracy and total time.
4. Do the same 22 phrases with a small LLM on OpenRouter. Compare accuracy, speed and cost.

## Done when
- [ ] Accuracy on the phrases in languages your model supports is **at least 18 of 20**.
- [ ] You can explain what happened with the **2 Persian phrases**, and why (hint: the model card).
- [ ] A small table: small model vs LLM, with accuracy, time and cost.

## Bonus
- Find a model on Hugging Face that **does** support Persian and try again.
- Try another task on the same phrases, for example sentiment analysis.

## Words to learn
Hugging Face · model card · pipeline · text classification · labels · inference

## Watch out
- The first run downloads the model (a few hundred MB). Do it before you turn off the internet.
- A model can only answer with labels it was trained on. It will not say "I don't know this language".
