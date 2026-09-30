# 11 · 🧰 The Skill Library
> **Concept:** Skills vs context files · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** Every AI assistant needs to know two kinds of things:
- **Context files** (for example `AGENTS.md`) hold short facts and rules that are true **all the time**. They are loaded in **every** request.
- **Skills** (`SKILL.md`) hold **step-by-step know-how for one kind of task**. Only a short name and description are always loaded. The full instructions are loaded **only when a task needs them**. This is called **progressive disclosure**.

Both are open, plain-Markdown formats that many AI tools understand. In this challenge you build the loading mechanism yourself, so you see exactly how it works and what it costs.

**The story:** The Taskly team has 4 skills and a context file. They want to know: "Why not just put everything into every prompt?"

## You get
- `context-file.md`: the always-on project context.
- `skills/`: 4 skills. Each folder has a `SKILL.md` with frontmatter (`name`, `description`) and instructions.
- `tasks.json`: 5 tasks. 4 need a skill, 1 needs none. Each task has a `check`.

## Your task
1. **Version A: everything always.** System prompt = context file + **all 4 skills** in full. Run the 5 tasks. Record `prompt_tokens` for each task.
2. **Version B: skills on demand.**
   - Build a **skill index** from the frontmatter only (name + description of each skill).
   - System prompt = context file + skill index + this rule: *"If a skill fits the task, reply only with `LOAD: <skill-name>`. Otherwise answer directly."*
   - When the model replies `LOAD: …`, your code adds that skill's full `SKILL.md` to the conversation and asks again.
   - Run the 5 tasks and record the tokens of **all** calls.
3. Check every answer against its `check`.

## Done when
- [ ] Version B loads the right skill for tasks 1–4 and **no** skill for task 5.
- [ ] Answers in both versions pass their `check`.
- [ ] A table: A vs B, with total input tokens for the 5 tasks.
- [ ] You calculated A vs B for **50 skills** (estimate the size of one skill from yours).
- [ ] You can say in one sentence what belongs in a **context file** and what belongs in a **skill**.

## Bonus
- Write your own skill for a real task from your job, and a short context file for a real project.
- Use the same files with the AI coding tool you already use. Most tools read `AGENTS.md` and `SKILL.md`; check your tool's docs for the folder location.
- Use tool calling (Challenge 09) instead of the `LOAD:` text protocol.

## Words to learn
context file · `AGENTS.md` · skill · `SKILL.md` · frontmatter · progressive disclosure · skill index

## Watch out
- The **description** decides whether a skill gets loaded. "Helps with SQL" is weak. "Review SQL queries for safety and performance. Use when someone asks you to check SQL" is strong.
- Context files grow and go stale. Keep them short, and keep only what is true for **every** task.
