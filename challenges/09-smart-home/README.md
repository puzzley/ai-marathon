# 09 · 💡 Smart Home Assistant
> **Concept:** Tool calling (function calling) · **Level:** ⭐⭐ · **Time:** ~1 hour

**Why it matters:** A model can only produce text. With **tool calling**, the model can ask **your code** to run a function (read a database, call an API), and then it uses the result. This is how AI gets real data and takes real actions, for example "look up this customer's last order".

**The story:** Build a voice-style assistant for a smart home. The "home" is a JSON file.

## You get
- `devices.json`: 8 devices and their current state.
- `tools.json`: 3 tool definitions, ready to send in the `tools` parameter.
- `requests.json`: 6 requests and the expected behaviour.

## How tool calling works
1. You send the messages **plus** `tools`.
2. The model may reply with `tool_calls` instead of text:
   ```json
   {"role": "assistant", "tool_calls": [{"id": "call_1", "type": "function",
     "function": {"name": "get_device", "arguments": "{\"device_id\": \"kitchen_light\"}"}}]}
   ```
3. **Your code** runs the function and adds the result to the messages:
   ```json
   {"role": "tool", "tool_call_id": "call_1", "content": "{\"power\": \"off\", \"brightness\": 0}"}
   ```
4. You call the model again. Repeat until it answers with normal text.

## Your task
1. Write the 3 functions. They read and change `devices.json`.
2. Build the loop above. Print every tool call so you can see what happens.
3. Run all 6 requests. Start each request from the **original** `devices.json`.

## Done when
- [ ] All 6 requests behave as `expected`.
- [ ] Request 3 turns off **both** bedroom lights. The AC stays on.
- [ ] Request 5 makes **no** tool call.
- [ ] Your log shows every tool call with its arguments.

## Bonus
- Add a tool `get_weather(city)` that returns fake data. Ask: "Should I close the garage because of rain?"

## Words to learn
tool calling · function calling · tool schema · arguments · `tool_call_id` · `tool_choice`

## Watch out
- `arguments` is a JSON **string**. Parse it before you use it.
- Not every model supports tools. Filter for "tools" on the OpenRouter models page.
- The model can send a wrong `device_id`. Return a clear error message as the tool result so the model can correct itself.
