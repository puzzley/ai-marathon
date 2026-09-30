# ADR-0003: Store uploaded files on the local disk

- **Status:** Accepted
- **Date:** 2024-03-12
- **Deciders:** Backend team

## Context
Customers attach files (screenshots, PDFs) to tickets. We run a single application server, and file volume is small (about 5 GB).

## Decision
Store uploaded files on the local disk of the application server, in `/var/app/uploads`.

## Alternatives considered
- Object storage (S3-compatible): not needed yet for one server and 5 GB; adds a new service to run.

## Consequences
- Simple: no new infrastructure.
- Backups must include the uploads folder.
- If we add more servers, we must revisit this decision.
