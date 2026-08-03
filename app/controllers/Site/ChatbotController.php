<?php

namespace App\Controllers\Site;

use App\Core\Controller;
use App\Services\AIService;

class ChatbotController extends Controller
{
    /**
     * Processa mensagem do chatbot.
     */
    public function message(): void
    {
        $message = $_POST['message'] ?? '';

        if (empty($message)) {
            $this->json(['success' => false, 'message' => 'Mensagem vazia.'], 400);
            return;
        }

        $chatbotEnabled = $this->settings->get('chatbot_enabled', '1');
        if ($chatbotEnabled !== '1') {
            $this->json(['success' => false, 'message' => 'Chatbot desabilitado.'], 503);
            return;
        }

        try {
            $aiService = new AIService();
            $systemPrompt = $this->buildSystemPrompt();
            $response = $aiService->chat($message, $systemPrompt);

            $this->json([
                'success' => true,
                'message' => $response,
            ]);
        } catch (\Exception $e) {
            appLog("Erro no chatbot: " . $e->getMessage(), 'error');
            $this->json([
                'success' => true,
                'message' => __('chatbot.error_response'),
            ]);
        }
    }

    /**
     * Monta o prompt do sistema para o chatbot.
     */
    private function buildSystemPrompt(): string
    {
        $siteName = SITE_NAME;
        $services = $this->db->fetchAll("SELECT title_pt, short_description_pt FROM services WHERE is_active = 1");
        $servicesList = '';
        foreach ($services as $s) {
            $servicesList .= "- {$s['title_pt']}: {$s['short_description_pt']}\n";
        }

        $whatsapp = $this->settings->get('whatsapp_number', '');
        $email = $this->settings->get('email', '');

        return "Você é o assistente virtual da {$siteName}, uma empresa especializada em desenvolvimento de software sob medida.
        
Seus serviços incluem:
{$servicesList}

Informações de contato:
- WhatsApp: {$whatsapp}
- Email: {$email}

Regras:
- Seja educado, profissional e objetivo
- Responda em português brasileiro
- Se o cliente quiser falar com um humano, direcione para o WhatsApp
- Não invente informações sobre preços ou prazos
- Foque em entender a necessidade do cliente e direcionar para contato";
    }
}
