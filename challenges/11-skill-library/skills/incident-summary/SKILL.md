---
name: incident-summary
description: Write a blameless summary of a production incident from raw notes. Use when someone shares notes, chat logs or a timeline about an outage or incident.
---

# Incident summary

## Rules
- **Blameless**: describe what the system and the process did, never who is guilty. Write "the deploy included a wrong config", not "Ali broke production".
- Use times in UTC.
- Use only facts from the notes. If something is unknown, write `Unknown`.
- Action items must be concrete, with an owner role (not a person's name) and a due date if one is given.

## Output format
```
## Incident summary: <short title>
**Impact:** who was affected, how, and for how long
**Timeline (UTC):**
- HH:MM ...
**Root cause:** ...
**What went well:** ...
**Action items:**
- [ ] ... (owner role)
```
