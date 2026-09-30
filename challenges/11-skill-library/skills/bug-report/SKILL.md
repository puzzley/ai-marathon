---
name: bug-report
description: Turn a messy customer complaint into a clear bug report for developers. Use when someone pastes a customer message about something that is broken.
---

# Bug report

## Steps
1. Find the facts in the message: what the user did, what happened, what they expected, device or platform, how often.
2. Never invent facts. If something is missing, write `Unknown - ask the customer`.
3. Choose a severity:
   - **Critical**: data loss, security problem, or nobody can use the app.
   - **High**: a main feature is broken and there is no workaround.
   - **Medium**: a feature is broken but there is a workaround, or only some users are affected.
   - **Low**: cosmetic problems, typos, small layout issues.
4. Write the title as: `[Platform] Short description of the problem`.

## Output format
```
**Title:** [Platform] ...
**Severity:** Critical | High | Medium | Low (one sentence why)
**Steps to reproduce:**
1. ...
**Expected result:** ...
**Actual result:** ...
**Frequency:** ...
**Open questions for the customer:** ...
```

## Example
Customer: "the app logs me out every time i close it on my iphone, super annoying"
```
**Title:** [iOS] User is logged out every time the app is closed
**Severity:** Medium (login still works, but users must log in again every time)
**Steps to reproduce:**
1. Log in to the iOS app.
2. Close the app.
3. Open the app again.
**Expected result:** The user is still logged in.
**Actual result:** The user is logged out.
**Frequency:** Every time.
**Open questions for the customer:** iOS version? App version?
```
