<!-- Chatbot FAQ -->
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
        </div>
        
        <div class="chatbot-input">
            <form id="chatbotForm">
                <input type="text" id="chatbotInput" placeholder="Digite sua dúvida..." autocomplete="off">
                <button type="submit" aria-label="Enviar"><i class="bi bi-send-fill"></i></button>
            </form>
        </div>
    </div>
</div>
