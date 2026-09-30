---
name: sql-review
description: Review SQL queries for safety and performance problems. Use when someone asks you to check, review or improve SQL.
---

# SQL review

Check every query against this list. Report each problem you find.

## Checklist
1. **Missing WHERE**: `UPDATE` or `DELETE` without `WHERE` changes every row. Always **Critical**.
2. **SQL injection**: user input glued into the query string (for example `"... WHERE email = '" + email + "'"`). Always **Critical**. Fix: use parameters (`WHERE email = ?`).
3. **SELECT \***: returns columns you do not need. **Low**. Fix: list the needed columns.
4. **No LIMIT on a big table**: a list query without `LIMIT` can return millions of rows. **Medium**.
5. **Function on an indexed column**: for example `WHERE LOWER(email) = ...` cannot use a normal index. **Medium**.

## Output format
For each problem:
```
- [Severity] Problem: ... | Line: ... | Fix: ...
```
End with one line: `Verdict: safe to merge | fix before merge`.
If a query has no problems, say so. Do not invent problems.
