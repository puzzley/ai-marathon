"""Ticket service: a small HTTP API for support tickets."""
import os

PORT = int(os.environ.get("PORT", 3000))
DATABASE_URL = os.environ["DATABASE_URL"]      # required
RATE_LIMIT_PER_MINUTE = 60
PASSWORD_MIN_LENGTH = 12
TIMEZONE = "UTC"                               # all timestamps are stored and returned in UTC

ROUTES = {
    ("GET", "/tickets"): "list_tickets",
    ("GET", "/tickets/{id}"): "get_ticket",
    ("POST", "/tickets"): "create_ticket",
    ("DELETE", "/tickets/{id}"): "delete_ticket",  # admins only
}


def create_ticket(body):
    if not body.get("title"):
        return 422, {"error": "title is required"}
    ticket = save_ticket(title=body["title"], description=body.get("description", ""))
    return 201, ticket


def delete_ticket(user, ticket_id):
    if not user.is_admin:
        return 403, {"error": "only admins can delete tickets"}
    remove_ticket(ticket_id)
    return 204, None


def validate_password(password):
    return len(password) >= PASSWORD_MIN_LENGTH
