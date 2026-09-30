#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Bootstrap for challenge 01 (Goldfish Bot).
 *
 * Loads Composer, .env, and script.txt, then stops.
 * The chat loop is the exercise. See README.md in this folder.
 */

use AiMarathon\OpenRouter;
use Dotenv\Dotenv;

$root = dirname(__DIR__, 2);

require $root . '/vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable($root);
$dotenv->load();
$dotenv->required(['OPENROUTER_API_KEY', 'OPENROUTER_BASE_URL', 'AI_MODEL'])->notEmpty();

$scriptPath = __DIR__ . '/script.txt';
$lines = file($scriptPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if ($lines === false) {
    fwrite(STDERR, "Could not read {$scriptPath}\n");
    exit(1);
}

$client = OpenRouter::fromEnv();

echo 'Loaded ' . count($lines) . " lines from script.txt.\n";
echo 'Model: ' . getenv('AI_MODEL') . "\n";

// TODO step 1 (goldfish): loop over $lines. Each turn, send ONLY the newest
// line as a single user message via $client->chat(). Print the assistant reply.
// The last line should fail, because the model is stateless.
//
// TODO step 2: keep a $messages list. Append each user line and each assistant
// reply, and send the whole list on every call.
//
// TODO step 3: print usage.prompt_tokens after each call.
//
// TODO step 4: keep only the last 4 messages, plus a short summary or facts
// list (name, cat, job) that you send every time.

unset($client);
