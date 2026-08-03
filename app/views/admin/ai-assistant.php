<div class="page-header"><h1 class="page-title"><i class="bi bi-robot"></i> Assistente IA</h1><p class="page-subtitle">Converse com a inteligência artificial para gerar conteúdo, tirar dúvidas e mais.</p></div>

<div class="card border-0 shadow-sm" style="min-height:500px; display:flex; flex-direction:column;">
    <div class="card-body flex-grow-1" id="aiChat" style="overflow-y:auto; max-height:450px; padding:1.5rem;">
        <div class="chat-message bot"><p class="bg-light rounded p-3">Olá! Sou o assistente IA da <?= e(SITE_NAME) ?>. Como posso ajudar?</p></div>
    </div>
    <div class="card-footer">
        <form id="aiChatForm" class="d-flex gap-2">
            <input type="text" class="form-control" id="aiInput" placeholder="Digite sua pergunta..." autocomplete="off">
            <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
        </form>
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
    const loadingId = addMsg('Pensando...', 'bot');

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

function addMsg(text, type) {
    const id = 'msg-' + Date.now();
    const div = document.createElement('div');
    div.className = 'chat-message ' + type;
    div.id = id;
    div.innerHTML = '<p class="' + (type === 'user' ? 'bg-primary text-white ms-auto' : 'bg-light') + ' rounded p-3" style="max-width:80%;display:inline-block;">' + text.replace(/\n/g, '<br>') + '</p>';
    if (type === 'user') div.style.textAlign = 'right';
    chatEl.appendChild(div);
    chatEl.scrollTop = chatEl.scrollHeight;
    return id;
}
</script>
