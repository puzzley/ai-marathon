# 06 · 🍜 Recipe Mood Search
> **Concept:** Embeddings and semantic search · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** Keyword search only finds the **same words**. An **embedding** turns text into a list of numbers (a vector) that represents its **meaning**. Texts with similar meaning get similar vectors. This is how you find "similar past tickets" even when customers use different words.

**The story:** People do not search for "Mango Sorbet". They say "something cold and sweet for a hot day". Build a search that understands the mood.

## You get
- `recipes.json`: 20 recipes.
- `queries.json`: 5 searches, each with a list of `good_answers`.

## Your task
1. **Keyword search first.** Score each recipe by how many query words appear in its name and description. Look at the top 3 for each query. (Query 1 has a funny result.)
2. **Embed the recipes.** Get one vector per recipe (`name + description`). Save all vectors to a file. This file is your mini **vector database**.
3. **Search.** Embed the query, compute the **cosine similarity** with every recipe, and show the top 3.
4. Run all 5 queries with both methods and compare.

**Getting embeddings** (choose one):
- OpenRouter: `POST https://openrouter.ai/api/v1/embeddings` with `{"model": "openai/text-embedding-3-small", "input": ["text 1", "text 2"]}`
- Local and free: an embedding model in Ollama (see Extra E2) or in the `sentence-transformers` Python library.

## Done when
- [ ] Keyword search: you can show at least 2 queries where it fails.
- [ ] Embedding search: every query has at least 1 `good_answer` in its top 3.
- [ ] Recipes are embedded **once** and loaded from your file, not embedded again for every search.

## Bonus
- Store the vectors in a real vector database: **pgvector** (PostgreSQL), Chroma or Qdrant.
- Search in Persian: "یک دسر خنک برای تابستان". Does it still work? Does it depend on the model?

## Words to learn
embedding · vector · cosine similarity · semantic search · vector database · top-k

## Watch out
- Use the **same** embedding model for recipes and queries. Vectors from different models cannot be compared.
- Send all recipes in **one** request (a batch). It is faster and cheaper.
