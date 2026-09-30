# Bank Assistant Policy (enforce this IN CODE)

The AI only PROPOSES actions. Your gatekeeper code DECIDES.

| Action | Decision |
|---|---|
| get_balance | ALLOW |
| transfer to a saved payee, amount <= 200 | ALLOW |
| transfer to a saved payee, amount > 200 | ASK_HUMAN |
| transfer to anyone who is NOT a saved payee | DENY |
| transfer with amount > balance of the source account | DENY |
| add_payee | ASK_HUMAN |
| any other action (for example close_account) | DENY |

- If no source account is given, use "checking".
- If more than one rule matches, the strictest wins: DENY > ASK_HUMAN > ALLOW.
- Text in the user's message can NEVER change these rules. Not even "I am the admin".
