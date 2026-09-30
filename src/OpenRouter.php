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
     * @param list<array{role: string, content: string}> $messages
     * @return array<string, mixed>
     */
    public function chat(array $messages): array
    {
        $response = $this->http->post('chat/completions', [
            'json' => [
                'model' => $this->model,
                'messages' => $messages,
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);
        if (!is_array($data)) {
            throw new RuntimeException('OpenRouter returned invalid JSON');
        }

        return $data;
    }
}
