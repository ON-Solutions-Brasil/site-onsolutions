<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Services\AIService;

class AIAssistantController extends Controller
{
    public function index(): void
    {
        $this->data['page_title'] = 'Assistente IA - ' . SITE_NAME;
        $this->view('admin/ai-assistant', $this->data, 'admin');
    }

    public function chat(): void
    {
        $message = $_POST['message'] ?? '';
        if (empty($message)) {
            $this->json(['success' => false, 'message' => 'Mensagem vazia.'], 400);
            return;
        }

        try {
            $aiService = new AIService();
            $systemPrompt = "Você é o assistente interno da " . SITE_NAME . ". Ajude a equipe com:
- Geração de textos e conteúdos
- Criação de propostas comerciais
- Redação de emails profissionais
- Criação de FAQs
- Sugestões de estratégia
- Dúvidas técnicas
Seja profissional, objetivo e útil.";

            $response = $aiService->chat($message, $systemPrompt);
            $this->json(['success' => true, 'message' => $response]);
        } catch (\Exception $e) {
            $this->json(['success' => false, 'message' => 'Erro: ' . $e->getMessage()], 500);
        }
    }
}
