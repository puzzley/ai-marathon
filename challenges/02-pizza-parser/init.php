#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Bootstrap for challenge 02 (Pizza Order Parser).
 *
 * Loads Composer, .env, menu.txt, schema.json, and orders.json.
 * The prompt, the JSON parse, and the score are the exercise.
 * See README.md in this folder. Word to learn: response_format.
 */

use AiMarathon\OpenRouter;
use Dotenv\Dotenv;

$root = dirname(__DIR__, 2);

require $root . '/vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable($root);
$dotenv->load();
$dotenv->required(['OPENROUTER_API_KEY', 'OPENROUTER_BASE_URL', 'AI_MODEL'])->notEmpty();

$menu = file_get_contents(__DIR__ . '/menu.txt');
$schemaJson = file_get_contents(__DIR__ . '/schema.json');
$ordersJson = file_get_contents(__DIR__ . '/orders.json');

if ($menu === false || $schemaJson === false || $ordersJson === false) {
    fwrite(STDERR, "Could not read menu.txt, schema.json, or orders.json\n");
    exit(1);
}

$schema = json_decode($schemaJson, true);
$orders = json_decode($ordersJson, true);
if (!is_array($schema) || !is_array($orders)) {
    fwrite(STDERR, "schema.json or orders.json is not valid JSON\n");
    exit(1);
}

$client = OpenRouter::fromEnv();

echo 'Loaded ' . count($orders) . " orders.\n";
echo 'Menu length: ' . strlen($menu) . " characters.\n";
echo 'Model: ' . getenv('AI_MODEL') . "\n";
echo "Client is ready. The parser is still yours to write.\n";

// TODO step 1: for each order, call the model and ask for JSON that matches
// $schema. Pass the schema through response_format:
//
//   $client->chat($messages, [
//       'response_format' => [
//           'type' => 'json_schema',
//           'json_schema' => [
//               'name' => 'pizza_order',
//               'strict' => true,
//               'schema' => $schema,
//           ],
//       ],
//   ]);
//
// You write $messages. Put the menu and the customer's message in them.
// Not every model supports json_schema.
//
// TODO step 2: json_decode the assistant text. Compare it with
// $order['expected']. Item order in the list does not matter.
//
// TODO step 3: print a score, for example "7/8 correct".

unset($client, $menu, $schema, $orders);
