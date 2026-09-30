# 07 · 📘 The Handbook Bot
> **Concept:** RAG (Retrieval-Augmented Generation) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** A model does not know your company's documents. Real documents are also too big to send in every prompt. **RAG** means: first **find** the few relevant pieces, then give **only those** to the model and ask it to answer from them. It is the most common pattern for "AI that answers from our own data".

**The story:** New employees at "Nimbus Games" keep asking HR the same questions. Build a bot that answers from the handbook, shows where the answer comes from, and **admits when the handbook does not say**.

## You get
- `handbook.md`: 20 sections.
- `questions.json`: 8 questions with the expected answer and section. 2 of them are **not** in the handbook.

## The rule of this challenge
Imagine the handbook has 5,000 pages. You may **not** send the whole handbook. Send **at most 3 pieces** per question.

## Your task
1. **Chunk:** split the handbook into pieces. One section per piece is a good start.
2. **Retrieve:** for each question, find the best 3 pieces. Use any method: keywords, embeddings (Challenge 06) or both.
3. **Generate:** send the question plus the 3 pieces. Tell the model to answer **only** from them, to name the section, and to say *"I can't find this in the handbook"* if the answer is not there.
4. Run all 8 questions.

## Done when
- [ ] 6/6 answerable questions are correct **and** name the right section.
- [ ] 2/2 unanswerable questions get "I can't find this in the handbook". No invented answer.
- [ ] You can show which 3 pieces were sent for each question.

## Bonus
- Print the retrieved pieces and check: when an answer is wrong, was it the **retrieval** or the **generation** that failed?
- Try smaller chunks (one paragraph each). Better or worse?

## Words to learn
RAG · chunking · retrieval · top-k · context · grounding · citation · hallucination

## Watch out
- Question 4 says "thrown away" and question 5 says "extra hours". Keyword search may miss them. That is why people use embeddings.
- Without the "say you don't know" rule, models invent friendly answers.
