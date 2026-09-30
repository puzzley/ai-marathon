# 10 · 🗝️ Dungeon Escape
> **Concept:** The agent loop · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** An **agent** is a model in a loop: *look → decide → act → look again*, until the goal is reached. It plans many steps by itself. The same idea powers AI coding agents. Loops also need **limits**, or they run forever and cost a lot.

**The story:** Your AI wakes up in a locked dungeon. It must find its way out alone. You only write the loop, not the solution.

## You get
- `dungeon.json`: the map, items and rules.
- `game.py`: a ready game engine (Python). Other languages: ask your coding agent to port it. It is about 60 lines.

## Your task
1. **The protocol.** Tell the model (system prompt): the goal, the commands, and "Reply with exactly one line: `ACTION: <command>`".
2. **The loop.**
   - Send the current observation (start with `game.observe()`).
   - Read the model's action, run it with `game.step(action)`, and add the result to the history.
   - Stop when `game.won` is true **or** after **25 steps**.
3. Print each step: step number, action, result.

## Done when
- [ ] The agent escapes **without help** from you.
- [ ] The loop always stops (win or 25-step limit).
- [ ] You print the total tokens used for the whole run.

## Bonus
- Ask the model to write one short `THOUGHT:` line before each `ACTION:`. Does it get better or worse?
- Use native tool calling (Challenge 09) instead of the text protocol.
- The best possible run is 10 steps. How close does your agent get?

## Words to learn
agent · agent loop · observation · action · stop condition · max iterations · ReAct

## Watch out
- If you forget to send the history, the agent walks in circles (see Challenge 01).
- Models sometimes add extra words. Make your code find the `ACTION:` line and ignore the rest.
