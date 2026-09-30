"""Tiny text-adventure engine for Challenge 09.
Your AGENT plays this game. You do not need to change this file.
Other languages: ask your coding agent to port it (about 60 lines).

Usage from your code:
    from game import Game
    game = Game("dungeon.json")
    print(game.observe())            # text for the model
    result = game.step("go north")   # returns a text observation
    game.won                         # True when the agent escaped
"""
import json


class Game:
    def __init__(self, path="dungeon.json"):
        with open(path, encoding="utf-8") as f:
            self.world = json.load(f)
        self.rooms = self.world["rooms"]
        self.room = self.world["start"]
        self.inventory = []
        self.unlocked = False
        self.won = False
        self.steps = 0

    def _can_see(self):
        return not self.rooms[self.room].get("dark") or "lamp" in self.inventory

    def observe(self):
        r = self.rooms[self.room]
        if not self._can_see():
            return f"You are in the {self.room}. It is too dark to see anything. Exits: {', '.join(r['exits'])}."
        items = ", ".join(r["items"]) or "nothing"
        return (f"You are in the {self.room}. {r['description']} "
                f"You see: {items}. Exits: {', '.join(r['exits'])}.")

    def step(self, command):
        self.steps += 1
        parts = command.strip().lower().split(" ", 1)
        verb, arg = parts[0], (parts[1].strip() if len(parts) > 1 else "")
        r = self.rooms[self.room]

        if verb == "look":
            return self.observe()
        if verb == "inventory":
            return "You carry: " + (", ".join(self.inventory) or "nothing") + "."
        if verb == "go":
            if arg not in r["exits"]:
                return f"You cannot go '{arg}' from here. Exits: {', '.join(r['exits'])}."
            lock = r.get("locked_exit")
            if lock and lock["direction"] == arg and not self.unlocked:
                return "The door is locked."
            self.room = r["exits"][arg]
            if self.room == "outside":
                self.won = True
                return "You step outside into the fresh air. YOU ESCAPED!"
            return self.observe()
        if verb == "take":
            if not self._can_see():
                return "It is too dark. You cannot find anything."
            if arg not in r["items"]:
                return f"There is no '{arg}' here."
            r["items"].remove(arg)
            self.inventory.append(arg)
            return f"You take the {arg}."
        if verb == "use":
            if arg not in self.inventory:
                return f"You do not have '{arg}'."
            lock = r.get("locked_exit")
            if lock and lock["key"] == arg:
                self.unlocked = True
                return "Click! The door is now unlocked."
            return f"Nothing happens when you use the {arg} here."
        return "Unknown command. Use: look | go <direction> | take <item> | use <item> | inventory"
