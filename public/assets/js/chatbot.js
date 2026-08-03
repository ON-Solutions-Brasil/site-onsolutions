/**
 * On Solutions - Chatbot Widget
 */
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('chatbotToggle');
    const window_ = document.getElementById('chatbotWindow');
    const closeBtn = document.getElementById('chatbotClose');
    const form = document.getElementById('chatbotForm');
    const input = document.getElementById('chatbotInput');
    const messages = document.getElementById('chatbotMessages');

    if (!toggle) return;

    toggle.addEventListener('click', function() {
        const isOpen = window_.style.display !== 'none';
        window_.style.display = isOpen ? 'none' : 'flex';
        if (!isOpen) input.focus();
    });

    closeBtn?.addEventListener('click', function() {
        window_.style.display = 'none';
    });

    form?.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        // Add user message
        addMessage(message, 'user');
        input.value = '';

        // Show typing indicator
        const typingId = addMessage('Digitando...', 'bot');

        // Send to API
        const formData = new FormData();
        formData.append('message', message);

        fetch(window.location.origin + '/site-onsolutions/chatbot/message', {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(data => {
            removeMessage(typingId);
            if (data.success) {
                addMessage(data.message, 'bot');
            } else {
                addMessage('Desculpe, ocorreu um erro. Tente novamente.', 'bot');
            }
        })
        .catch(() => {
            removeMessage(typingId);
            addMessage('Desculpe, não consegui processar sua mensagem. Tente novamente.', 'bot');
        });
    });

    function addMessage(text, type) {
        const id = 'msg-' + Date.now();
        const div = document.createElement('div');
        div.className = 'chat-message ' + type;
        div.id = id;
        div.innerHTML = '<p>' + escapeHtml(text) + '</p>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
        return id;
    }

    function removeMessage(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
});
