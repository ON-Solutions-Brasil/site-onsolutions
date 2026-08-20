<!-- Chatbot FAQ Flutuante -->
<div class="chatbot-widget" id="chatbot">
    <button class="chatbot-toggle" id="chatbotToggle" aria-label="Abrir chat">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
    
    <div class="chatbot-window" id="chatbotWindow" style="display:none;">
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <i class="bi bi-headset"></i>
                <div>
                    <strong><?= e(SITE_NAME) ?></strong>
                    <small>Atendimento</small>
                </div>
            </div>
            <button class="chatbot-close" id="chatbotClose" aria-label="Fechar chat">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="chatbot-messages" id="chatbotMessages">
            <div class="chat-message bot">
                <p>Olá! 👋 Como posso ajudá-lo? Selecione uma opção abaixo ou digite sua dúvida:</p>
            </div>
            <div class="chatbot-faq-buttons" id="chatbotFaqButtons">
                <button class="chatbot-faq-btn" data-faq="services">🛠️ Quais serviços vocês oferecem?</button>
                <button class="chatbot-faq-btn" data-faq="quote">💰 Como solicitar um orçamento?</button>
                <button class="chatbot-faq-btn" data-faq="deadline">⏱️ Qual o prazo de entrega?</button>
                <button class="chatbot-faq-btn" data-faq="technologies">💻 Quais tecnologias utilizam?</button>
                <button class="chatbot-faq-btn" data-faq="support">🔧 Vocês oferecem suporte?</button>
                <button class="chatbot-faq-btn" data-faq="contact">📞 Como falar com alguém?</button>
            </div>
        </div>
        
        <div class="chatbot-input">
            <form id="chatbotForm">
                <input type="text" id="chatbotInput" placeholder="Digite sua dúvida..." autocomplete="off">
                <button type="submit" aria-label="Enviar"><i class="bi bi-send-fill"></i></button>
            </form>
        </div>
    </div>
</div>
