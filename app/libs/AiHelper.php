<?php

class AiHelper {
    private static $apiKey = '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';
    private static $endpoint = 'https://models.inference.ai.azure.com/chat/completions';

    public static function generatePoints($type, $eventTitle, $category) {
        $prompts = [
            'instructions' => "Generate 15 unique, professional, and practical instructions for attendees of an event titled '$eventTitle' in the '$category' category. Format as a simple numbered list without extra text.",
            'affirmations' => "Generate 15 unique, motivating, and category-specific daily affirmations for attendees of an event titled '$eventTitle' ($category). Format as a simple numbered list.",
            'terms' => "Generate 15 unique, professional terms and conditions for an event titled '$eventTitle'. Format as a simple numbered list."
        ];

        $prompt = $prompts[$type] ?? $prompts['instructions'];

        $data = [
            'messages' => [
                ['role' => 'system', 'content' => 'You are a professional event coordinator. Provide only the numbered list, no intro or outro.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'model' => 'gpt-4o',
            'temperature' => 0.8,
            'max_tokens' => 800
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\nAuthorization: Bearer " . self::$apiKey . "\r\nUser-Agent: PHP\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];

        $context  = stream_context_create($options);
        $result = @file_get_contents(self::$endpoint, false, $context);
        
        if ($result === FALSE) return [];

        $response = json_decode($result, true);
        $content = $response['choices'][0]['message']['content'] ?? '';
        
        // Parse numbered list into array
        $lines = explode("\n", $content);
        $points = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^\d+\.\s*(.*)/', $line, $matches)) {
                $points[] = $matches[1];
            }
        }

        return array_slice($points, 0, 15);
    }
}
