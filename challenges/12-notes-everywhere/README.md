# 12 · 📝 My Notes, Everywhere
> **Concept:** MCP (Model Context Protocol) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** **MCP** is a standard plug between AI apps and tools. You write a small **MCP server** once, and **every** MCP-capable app can use its tools: IDE assistants, desktop chat apps and agents. Without MCP you would build a separate integration for every AI app.

**The story:** You keep personal notes in a JSON file. You want any AI assistant you use to answer *"What did I write about the dentist?"* Build one MCP server that works for all of them.

## You get
- `notes.json`: 6 notes.

## Your task
1. Build an MCP server with 3 tools: `list_notes()`, `search_notes(query)`, `add_note(title, text)`. They read and write `notes.json`.
2. Test it with the official **MCP Inspector** (works without any AI app): `npx -y @modelcontextprotocol/inspector`
3. Connect it to **one MCP-capable AI app** you already use, and ask it about your notes.

**Starter (Python, official MCP SDK v2).** Official SDKs exist for other languages too, for example TypeScript (`@modelcontextprotocol/sdk`) and PHP (`mcp/sdk`, still experimental).
```python
import json
from pathlib import Path
from mcp.server import MCPServer

NOTES = Path(__file__).with_name("notes.json")
mcp = MCPServer("My Notes")


@mcp.tool()
def list_notes() -> str:
    """List all notes (id and title)."""
    notes = json.loads(NOTES.read_text(encoding="utf-8"))
    return json.dumps([{"id": n["id"], "title": n["title"]} for n in notes])

# TODO: search_notes(query) and add_note(title, text)

if __name__ == "__main__":
    mcp.run()  # stdio: the AI app starts this file and talks to it
```

**Connecting an app.** Every app needs the same thing: **the command that starts your server**. Many apps use a JSON config like this. The file name and location depend on the app, so check its docs.
```json
{
  "mcpServers": {
    "my-notes": {
      "command": "uv",
      "args": ["run", "--with", "mcp[cli]", "mcp", "run", "/absolute/path/to/server.py"]
    }
  }
}
```

## Done when
- [ ] The Inspector lists your 3 tools, and you can call each one.
- [ ] `add_note` from the Inspector really changes `notes.json`.
- [ ] In an AI app, *"What did I write about the dentist?"* calls `search_notes` and answers "Tuesday at 16:00".

## Bonus
- Connect the **same** server to a **second** app without changing your code. This is the point of MCP.
- Add `delete_note(id)`. Does your app ask you before it runs it? Why does that matter? (See Challenge 14.)

## Words to learn
MCP · MCP server · MCP client / host · tool · resource · stdio · MCP Inspector

## Watch out
- In a stdio server, **never `print()` to stdout**. Stdout carries the protocol. Log to stderr instead.
- Use **absolute** paths. The app starts your server from its own folder, not yours.
- Most apps read their MCP config only at start. Restart or reload after a change.
