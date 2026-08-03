<?php

namespace App\Services;

use App\Core\Settings;

/**
 * Serviço de Inteligência Artificial.
 * Suporta OpenAI, Gemini, Claude e DeepSeek.
 */
class AIService
{
    private Settings $settings;
    private string $provider;

    public function __construct(?string $provider = null)
    {
        $this->settings = Settings::getInstance();
        $this->provider = $provider ?? $this->settings->get('ai_default_provider', 'openai');
    }

    /**
     * Envia mensagem para IA e retorna resposta.
     */
    public function chat(string $message, ?string $systemPrompt = null): string
    {
        return match ($this->provider) {
            'openai'   => $this->chatOpenAI($message, $systemPrompt),
            'gemini'   => $this->chatGemini($message, $systemPrompt),
            'claude'   => $this->chatClaude($message, $systemPrompt),
            'deepseek' => $this->chatDeepSeek($message, $systemPrompt),
            default    => $this->chatOpenAI($message, $systemPrompt),
        };
    }

    /**
     * Gera conteúdo para blog post.
     */
    public function generateBlogPost(string $topic, array $options = []): array
    {
        $prompt = $this->buildBlogPrompt($topic, $options);
        $response = $this->chat($prompt);

        // Tentar parsear JSON da resposta
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}');
        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonStr = substr($response, $jsonStart, $jsonEnd - $jsonStart + 1);
            $data = json_decode($jsonStr, true);
            if ($data) return $data;
        }

        // Fallback se não retornar JSON válido
        return [
            'title'            => $topic,
            'content'          => $response,
            'excerpt'          => truncate(strip_tags($response), 200),
            'meta_description' => truncate(strip_tags($response), 160),
            'keywords'         => '',
            'slug'             => slugify($topic),
        ];
    }

    private function chatOpenAI(string $message, ?string $systemPrompt): string
    {
        $apiKey = $this->settings->get('openai_api_key', '');
        $model = $this->settings->get('openai_model', 'gpt-4');

        if (empty($apiKey)) {
            throw new \RuntimeException('OpenAI API key não configurada.');
        }

        $messages = [];
        if ($systemPrompt) {
            $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        $response = $this->httpPost('https://api.openai.com/v1/chat/completions', [
            'model'    => $model,
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens'  => 4000,
        ], ['Authorization: Bearer ' . $apiKey]);

        return $response['choices'][0]['message']['content'] ?? '';
    }

    private function chatGemini(string $message, ?string $systemPrompt): string
    {
        $apiKey = $this->settings->get('gemini_api_key', '');
        if (empty($apiKey)) {
            throw new \RuntimeException('Gemini API key não configurada.');
        }

        $fullMessage = $systemPrompt ? "{$systemPrompt}\n\n{$message}" : $message;

        $response = $this->httpPost(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}",
            ['contents' => [['parts' => [['text' => $fullMessage]]]]]
        );

        return $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }

    private function chatClaude(string $message, ?string $systemPrompt): string
    {
        $apiKey = $this->settings->get('claude_api_key', '');
        if (empty($apiKey)) {
            throw new \RuntimeException('Claude API key não configurada.');
        }

        $body = [
            'model'      => 'claude-3-sonnet-20240229',
            'max_tokens' => 4000,
            'messages'   => [['role' => 'user', 'content' => $message]],
        ];
        if ($systemPrompt) {
            $body['system'] = $systemPrompt;
        }

        $response = $this->httpPost('https://api.anthropic.com/v1/messages', $body, [
            'x-api-key: ' . $apiKey,
            'anthropic-version: 2023-06-01',
        ]);

        return $response['content'][0]['text'] ?? '';
    }

    private function chatDeepSeek(string $message, ?string $systemPrompt): string
    {
        $apiKey = $this->settings->get('deepseek_api_key', '');
        if (empty($apiKey)) {
            throw new \RuntimeException('DeepSeek API key não configurada.');
        }

        $messages = [];
        if ($systemPrompt) {
            $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        $response = $this->httpPost('https://api.deepseek.com/v1/chat/completions', [
            'model'    => 'deepseek-chat',
            'messages' => $messages,
        ], ['Authorization: Bearer ' . $apiKey]);

        return $response['choices'][0]['message']['content'] ?? '';
    }

    private function buildBlogPrompt(string $topic, array $options): string
    {
        $style = $options['writing_style'] ?? $this->settings->get('blog_ai_writing_style', 'professional');
        $customPrompt = $options['custom_prompt'] ?? $this->settings->get('blog_ai_custom_prompt', '');

        $prompt = "Gere um artigo de blog completo sobre: \"{$topic}\"

Retorne um JSON válido com a seguinte estrutura:
{
    \"title\": \"Título do artigo\",
    \"content\": \"Conteúdo completo em HTML\",
    \"excerpt\": \"Resumo de 2-3 frases\",
    \"meta_description\": \"Meta description até 160 caracteres\",
    \"keywords\": \"palavra1, palavra2, palavra3\",
    \"slug\": \"slug-do-artigo\",
    \"suggested_tags\": [\"tag1\", \"tag2\", \"tag3\"]
}

Estilo de escrita: {$style}
O conteúdo deve ter pelo menos 1000 palavras.
Use subtítulos (h2, h3), parágrafos bem estruturados e listas quando apropriado.
O conteúdo deve ser original e otimizado para SEO.";

        if (!empty($customPrompt)) {
            $prompt .= "\n\nInstruções adicionais: {$customPrompt}";
        }

        return $prompt;
    }

    private function httpPost(string $url, array $data, array $extraHeaders = []): array
    {
        $headers = array_merge([
            'Content-Type: application/json',
        ], $extraHeaders);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException("Erro cURL: {$error}");
        }
        curl_close($ch);

        if ($httpCode >= 400) {
            throw new \RuntimeException("API retornou código {$httpCode}: {$response}");
        }

        return json_decode($response, true) ?? [];
    }
}
