---
name: release-notes
description: Turn a list of commit messages into user-friendly release notes. Use when someone asks for release notes, a changelog or "what's new" text.
---

# Release notes

## Steps
1. Read every commit message. The prefix tells you the type: `feat`, `fix`, `perf`, `chore`, `docs`, `test`, `refactor`.
2. **Skip** `chore`, `docs`, `test` and `refactor`. Users do not care about them.
3. Put each remaining commit in exactly one section:
   - **New**: `feat`
   - **Fixed**: `fix`
   - **Improved**: `perf`
4. Rewrite each item for a normal user:
   - One short line. Start with a verb or a noun, not with "feat:" or "fix:".
   - No file names, class names, ticket numbers or version numbers of libraries.
   - Say what the user notices, not what the developer changed.
5. If a section has no items, leave it out.

## Output format
```
## What's new in this release

### New
- ...

### Fixed
- ...

### Improved
- ...
```

## Example
Input:
```
feat: add bulk archive button to project list
fix: calendar sync stopped after 30 days
chore: update eslint config
```
Output:
```
## What's new in this release

### New
- Archive many projects at once with the new bulk archive button.

### Fixed
- Calendar sync no longer stops after 30 days.
```
