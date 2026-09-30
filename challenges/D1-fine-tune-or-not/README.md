# D1 · 🤔 Fine-tune or Not?
> **Concept:** Choosing the right technique · **Level:** ⭐ · **Time:** 15 minutes, no code

**Why it matters:** People often say "let's fine-tune a model" too early. Fine-tuning means training a model further on your own examples. It is slow and costly, and it is **not** a good way to teach a model facts that change. Most problems are solved faster with other tools.

## The options
- **A.** A better prompt, with examples (few-shot)
- **B.** RAG (search your documents, then answer)
- **C.** Tool calling (get live data from a system)
- **D.** Fine-tuning a model
- **E.** A small specialized model (for example from Hugging Face)

## The situations
Choose the **best first step** for each. Discuss with a colleague, then check with the organizers.

1. The bot must tell customers the **current** status of their ticket.
2. The bot must answer questions from a 300-page product manual.
3. We want to sort tickets into 5 categories. We have 50 good examples.
4. We classify 2 million short messages per day for one narrow task. A big model is too expensive, and we have 20,000 labelled examples.
5. We must detect the language of every incoming message.
6. Replies must always follow our brand's friendly tone.
