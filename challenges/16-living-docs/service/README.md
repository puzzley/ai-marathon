# Ticket Service

A small HTTP API for support tickets.

## Setup
1. Set `DB_URL` to your database connection string.
2. Start the service. It runs on port **8080** by default.

## Endpoints
- `GET /tickets`: list all tickets
- `POST /tickets`: create a ticket (a `title` is required)
- `GET /tickets/export`: download all tickets as CSV

## Rules
- Rate limit: 100 requests per minute per user.
- Passwords must have at least 8 characters.
- All times are in UTC.
