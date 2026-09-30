#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Bootstrap for challenge 03 (The Token Accountant).
 *
 * Loads Composer, .env, hotel-guide.md, questions.json, and same-meaning.json.
 * Measuring tokens, cost, reasoning, and cache hits is the exercise.
 * See README.md in this folder. Word to learn: token.
 */

use AiMarathon\OpenRouter;
use Dotenv\Dotenv;

$root = dirname(__DIR__, 2);

require $root . '/vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable($root);
$dotenv->load();
$dotenv->required(['OPENROUTER_API_KEY', 'OPENROUTER_BASE_URL', 'AI_MODEL'])->notEmpty();

$guide = file_get_contents(__DIR__ . '/hotel-guide.md');
$questionsJson = file_get_contents(__DIR__ . '/questions.json');
$sameMeaningJson = file_get_contents(__DIR__ . '/same-meaning.json');

if ($guide === false || $questionsJson === false || $sameMeaningJson === false) {
    fwrite(STDERR, "Could not read hotel-guide.md, questions.json, or same-meaning.json\n");
    exit(1);
}

$questions = json_decode($questionsJson, true);
$sameMeaning = json_decode($sameMeaningJson, true);
if (!is_array($questions) || !is_array($sameMeaning)) {
    fwrite(STDERR, "questions.json or same-meaning.json is not valid JSON\n");
    exit(1);
}

$client = OpenRouter::fromEnv();

echo 'Loaded ' . count($questions) . " questions.\n";
echo 'Guide length: ' . strlen($guide) . " characters.\n";
echo 'Model: ' . getenv('AI_MODEL') . "\n";
echo "Client is ready. The measurements are still yours to write.\n";

// TODO step 1: answer every question with a small model and a big model.
// Put $guide in the system message and $question['question'] in the user message.
// Pass a different model with the second argument, which overrides AI_MODEL:
//
//   $started = microtime(true);
//   $response = $client->chat($messages, ['model' => 'provider/model-name']);
//   $seconds = microtime(true) - $started;
//
// Read usage.prompt_tokens, usage.completion_tokens, and usage.cost.
// Record whether the reply matches $question['answer'].
// Each call is also appended to cost.log in the project root.
//
// TODO step 2: on a reasoning model, run questions 1, 4, and 5 twice:
//   ['reasoning' => ['effort' => 'low']]
//   ['reasoning' => ['effort' => 'high']]
// Record usage.completion_tokens_details.reasoning_tokens.
//
// TODO step 3: add "Answer in one sentence." and compare completion_tokens
// with step 1.
//
// TODO step 4: keep the system message exactly the same and ask the 5
// questions one after another. Read usage.prompt_tokens_details.cached_tokens.
//
// Print one table: model, effort, input tokens, output tokens, reasoning
// tokens, cost, time, correct (yes/no).
//
// Bonus: send $sameMeaning['english'], then $sameMeaning['persian'], and
// compare prompt_tokens.

unset($client, $guide, $questions, $sameMeaning);
