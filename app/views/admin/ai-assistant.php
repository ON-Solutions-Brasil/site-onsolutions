<div class="ai-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Assistente IA</h1>
            <p class="page-subtitle">Converse com a inteligência artificial para gerar conteúdo, tirar dúvidas e mais.</p>
        </div>
        <div class="ai-header-info">
            <span class="ai-provider-badge">
                <i class="bi bi-cpu"></i>
                <?= e(ucfirst(setting('ai_default_provider', 'openai'))) ?>
            </span>
        </div>
    </div>

    <div class="ai-chat-card">
        <div class="ai-chat-card__header">
            <div class="ai-chat-card__header-icon">
                <i class="bi bi-robot"></i>
            </div>
            <div>
                <h3 class="ai-chat-card__title">Chat com IA</h3>
                <p class="ai-chat-card__desc">Assistente inteligente da <?= e(SITE_NAME) ?></p>
            </div>
            <div class="ai-chat-card__status">
                <span class="ai-status-dot"></span> Online
            </div>
        </div>

        <div class="ai-chat-body" id="aiChat">
            <div class="ai-msg ai-msg--bot">
                <div class="ai-msg__avatar">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="ai-msg__bubble">
                    Olá! Sou o assistente IA da <?= e(SITE_NAME) ?>. Como posso ajudar?
                </div>
            </div>
        </div>

        <div class="ai-chat-footer">
            <form id="aiChatForm" class="ai-chat-form">
                <div class="ai-chat-input-wrapper">
                    <input type="text" class="ai-chat-input" id="aiInput" placeholder="Digite sua pergunta..." autocomplete="off">
                    <button type="submit" class="ai-chat-send" aria-label="Enviar mensagem">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
                <p class="ai-chat-hint">Pressione Enter para enviar. A IA pode cometer erros.</p>
            </form>
        </div>
    </div>
</div>

<script>
const chatEl = document.getElementById('aiChat');
const form = document.getElementById('aiChatForm');
const input = document.getElementById('aiInput');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    const msg = input.value.trim();
    if (!msg) return;

    addMsg(msg, 'user');
    input.value = '';
    const loadingId = addMsg('Pensando...', 'bot', true);

    const fd = new FormData();
    fd.append('message', msg);
    fd.append('_token', '<?= e($_SESSION['csrf_token'] ?? '') ?>');

    fetch('<?= url("admin/ai-assistant/chat") ?>', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(data => {
            document.getElementById(loadingId)?.remove();
            addMsg(data.message || 'Erro ao processar.', 'bot');
        })
        .catch(() => { document.getElementById(loadingId)?.remove(); addMsg('Erro de conexão.', 'bot'); });
});

function addMsg(text, type, isLoading = false) {
    const id = 'msg-' + Date.now();
    const div = document.createElement('div');
    div.className = 'ai-msg ai-msg--' + type;
    div.id = id;
    
    const avatar = type === 'user' 
        ? '<div class="ai-msg__avatar ai-msg__avatar--user"><i class="bi bi-person"></i></div>'
        : '<div class="ai-msg__avatar"><i class="bi bi-robot"></i></div>';
    
    const bubbleClass = isLoading ? 'ai-msg__bubble ai-msg__bubble--loading' : 'ai-msg__bubble';
    const content = text.replace(/\n/g, '<br>');
    
    div.innerHTML = avatar + '<div class="' + bubbleClass + '">' + content + '</div>';
    chatEl.appendChild(div);
    chatEl.scrollTop = chatEl.scrollHeight;
    return id;
}
</script>
