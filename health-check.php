#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Environment check for the AI Marathon challenge pack.
 * Exit 0 when every check passes, 1 otherwise.
 */

$failures = 0;

function pass(string $message): void
{
    echo "PASS  {$message}\n";
}

function fail(string $message): void
{
    echo "FAIL  {$message}\n";
}

function load_dotenv(string $path): bool
{
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        fail(".env exists but could not be read");
        return false;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (str_starts_with($line, 'export ')) {
            $line = trim(substr($line, 7));
        }

        $eq = strpos($line, '=');
        if ($eq === false) {
            continue;
        }

        $key = trim(substr($line, 0, $eq));
        $value = trim(substr($line, $eq + 1));
        if ($key === '' || preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $key) !== 1) {
            continue;
        }

        $length = strlen($value);
        if ($length >= 2) {
            $first = $value[0];
            $last = $value[$length - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        $existing = getenv($key);
        if ($existing !== false && $existing !== '') {
            continue;
        }

        putenv($key . '=' . $value);
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }

    return true;
}

function env_value(string $name): ?string
{
    $value = getenv($name);
    if ($value === false) {
        return null;
    }

    return trim($value);
}

function check_http(string $baseUrl): bool
{
    if (preg_match('#^https?://#i', $baseUrl) !== 1) {
        fail("OPENROUTER_BASE_URL is not an http(s) URL");
        return false;
    }

    $ch = curl_init($baseUrl);
    if ($ch === false) {
        fail('Could not start an HTTP request');
        return false;
    }

    curl_setopt_array($ch, [
        CURLOPT_HTTPGET => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_USERAGENT => 'ai-marathon-health-check',
    ]);

    curl_exec($ch);
    $errno = curl_errno($ch);
    $error = curl_error($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    if ($errno !== 0) {
        fail("HTTP request failed: {$error}");
        return false;
    }
    if ($status < 100) {
        fail('HTTP request finished without a status code');
        return false;
    }

    pass("HTTP connection works (server responded {$status})");
    return true;
}

echo "AI Marathon health check\n";

pass('PHP ' . PHP_VERSION . ' is executable');

$extensions = ['curl', 'json', 'mbstring', 'openssl'];
$curlReady = true;
foreach ($extensions as $extension) {
    if (extension_loaded($extension)) {
        pass("PHP extension {$extension}");
        continue;
    }

    fail("PHP extension {$extension} is missing");
    $failures++;
    if ($extension === 'curl') {
        $curlReady = false;
    }
}

$envFile = __DIR__ . DIRECTORY_SEPARATOR . '.env';
if (!is_file($envFile)) {
    fail('.env is missing. Run ./setup.sh, then set OPENROUTER_API_KEY and AI_MODEL.');
    $failures++;
} else {
    pass('.env exists');
    if (!load_dotenv($envFile)) {
        $failures++;
    }
}

$required = [
    'OPENROUTER_API_KEY' => 'the key from the organizers',
    'OPENROUTER_BASE_URL' => 'the API root, usually https://openrouter.ai/api/v1',
    'AI_MODEL' => 'a model id such as provider/model-name',
];

foreach ($required as $name => $hint) {
    $value = env_value($name);
    if ($value === null) {
        fail("{$name} is not set ({$hint})");
        $failures++;
        continue;
    }
    if ($value === '') {
        fail("{$name} is empty ({$hint})");
        $failures++;
        continue;
    }

    pass("{$name} is set");
}

$baseUrl = env_value('OPENROUTER_BASE_URL');
if (!$curlReady) {
    echo "SKIP  HTTP request (PHP curl extension is missing)\n";
} elseif ($baseUrl === null || $baseUrl === '') {
    echo "SKIP  HTTP request (OPENROUTER_BASE_URL is not set)\n";
} elseif (!check_http($baseUrl)) {
    $failures++;
}

echo "\n";
if ($failures === 0) {
    echo "All checks passed.\n";
    exit(0);
}

$label = $failures === 1 ? 'check' : 'checks';
echo "{$failures} {$label} failed.\n";
exit(1);
