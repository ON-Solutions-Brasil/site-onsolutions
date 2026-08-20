<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class ChatbotController extends Controller
{
    /**
     * Processa mensagem do chatbot (FAQ matching).
     */
    public function message(): void
    {
        $message = $_POST['message'] ?? '';

        if (empty($message)) {
            $this->json(['success' => false, 'message' => 'Mensagem vazia.'], 400);
            return;
        }

        // FAQ matching simples via backend (fallback)
        $response = $this->matchFaq($message);

        $this->json([
            'success' => true,
            'message' => $response,
        ]);
    }

    /**
     * Match de FAQ por keywords.
     */
    private function matchFaq(string $message): string
    {
        $message = mb_strtolower($message);

        $faqs = [
            [
                'keywords' => ['serviço', 'servico', 'oferecem', 'fazem', 'trabalham'],
                'answer' => 'Oferecemos: Sistemas Web, ERP, CRM, Integrações & APIs, Automações, Inteligência Artificial e Consultoria. Posso ajudar com mais alguma dúvida?',
            ],
            [
                'keywords' => ['orçamento', 'orcamento', 'preço', 'preco', 'valor', 'custo', 'quanto'],
                'answer' => 'Para solicitar um orçamento, preencha o formulário na página de contato ou nos chame no WhatsApp. Retornamos em até 2 horas!',
            ],
            [
                'keywords' => ['prazo', 'demora', 'tempo', 'entrega', 'quando'],
                'answer' => 'Os prazos variam: sites (1-3 semanas), sistemas simples (4-8 semanas), sistemas complexos (2-4 meses). Trabalhamos com entregas contínuas.',
            ],
            [
                'keywords' => ['tecnologia', 'linguagem', 'stack', 'framework'],
                'answer' => 'Utilizamos: PHP, Laravel, Node.js, Vue.js, React, MySQL, PostgreSQL, Redis, Docker, AWS e mais. Escolhemos a melhor stack para cada projeto.',
            ],
            [
                'keywords' => ['suporte', 'ajuda', 'manutenção', 'bug', 'problema'],
                'answer' => 'Sim! Oferecemos suporte contínuo, correção de bugs, manutenção evolutiva e monitoramento. Tempo médio de resposta: 2 horas.',
            ],
            [
                'keywords' => ['contato', 'falar', 'telefone', 'whatsapp', 'email'],
                'answer' => 'Você pode nos contatar via WhatsApp (resposta rápida), email contato@onsolutions.com.br ou pelo formulário de contato. Atendemos seg-sex 9h-18h.',
            ],
        ];

        foreach ($faqs as $faq) {
            foreach ($faq['keywords'] as $keyword) {
                if (str_contains($message, $keyword)) {
                    return $faq['answer'];
                }
            }
        }

        return 'Não encontrei uma resposta específica para sua pergunta. Você pode nos contatar pelo WhatsApp ou formulário de contato para falar com nossa equipe!';
    }
}
