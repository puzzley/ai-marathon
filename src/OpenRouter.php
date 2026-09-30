<?php

declare(strict_types=1);

namespace AiMarathon;

use GuzzleHttp\Client;
use RuntimeException;

/**
 * Small OpenRouter chat client. The challenge code decides which messages to send.
 */
final class OpenRouter
{
    public function __construct(
        private readonly Client $http,
        private readonly string $model,
    ) {
    }

    public static function fromEnv(): self
    {
        $baseUrl = rtrim((string) getenv('OPENROUTER_BASE_URL'), '/');
        $apiKey = (string) getenv('OPENROUTER_API_KEY');
        $model = (string) getenv('AI_MODEL');

        $client = new Client([
            'base_uri' => $baseUrl . '/',
            'timeout' => 60,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);

        return new self($client, $model);
    }

    /**
     * POST /chat/completions.
     *
     * Extra keys in $options are sent in the JSON body. Challenge 02 uses
     * this for response_format.
     *
     * @param list<array{role: string, content: string}> $messages
     * @param array<string, mixed> $options
     * @return array<string, mixed>
     */
    public function chat(array $messages, array $options = []): array
    {
        $response = $this->http->post('chat/completions', [
            'json' => array_merge([
                'model' => $this->model,
                'messages' => $messages,
            ], $options),
        ]);

        $data = json_decode((string) $response->getBody(), true);
        if (!is_array($data)) {
            throw new RuntimeException('OpenRouter returned invalid JSON');
        }

        $this->logCost($data);

        return $data;
    }

    /**
     * Append one JSON line per call to cost.log in the project root.
     *
     * @param array<string, mixed> $data
     */
    private function logCost(array $data): void
    {
        $usage = is_array($data['usage'] ?? null) ? $data['usage'] : [];
        $cost = isset($usage['cost']) && is_numeric($usage['cost']) ? (float) $usage['cost'] : null;

        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cost.log';
        $total = $cost ?? 0.0;
        if (is_file($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (is_array($lines) && $lines !== []) {
                $last = json_decode((string) $lines[array_key_last($lines)], true);
                if (is_array($last) && isset($last['total_cost']) && is_numeric($last['total_cost'])) {
                    $total = (float) $last['total_cost'] + ($cost ?? 0.0);
                }
            }
        }

        $entry = [
            'time' => date(DATE_ATOM),
            'model' => $this->model,
            'id' => is_string($data['id'] ?? null) ? $data['id'] : null,
            'prompt_tokens' => $usage['prompt_tokens'] ?? null,
            'completion_tokens' => $usage['completion_tokens'] ?? null,
            'total_tokens' => $usage['total_tokens'] ?? null,
            'cost' => $cost,
            'total_cost' => $total,
        ];

        file_put_contents(
            $path,
            json_encode($entry, JSON_UNESCAPED_SLASHES) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}
