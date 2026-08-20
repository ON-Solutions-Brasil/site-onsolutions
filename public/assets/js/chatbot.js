/**
 * ON Solutions - Chatbot FAQ
 */
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.getElementById('chatbotToggle');
    var chatWindow = document.getElementById('chatbotWindow');
    var closeBtn = document.getElementById('chatbotClose');
    var form = document.getElementById('chatbotForm');
    var input = document.getElementById('chatbotInput');
    var messages = document.getElementById('chatbotMessages');

    if (!toggle) return;

    // FAQ - Perguntas e respostas
    var faqData = {
        services: {
            question: 'Quais servicos voces oferecem?',
            answer: 'Oferecemos: Sistemas Web, ERP Personalizado, CRM, Integracoes e APIs, Automacoes, Inteligencia Artificial, Dashboards e BI, Aplicativos Mobile, SaaS e Consultoria Tecnologica.'
        },
        quote: {
            question: 'Como solicitar um orcamento?',
            answer: 'Voce pode solicitar um orcamento pelo formulario na pagina de contato, pelo WhatsApp ou por email. Apos receber sua solicitacao, retornamos em ate 2 horas durante o horario comercial.'
        },
        deadline: {
            question: 'Qual o prazo de entrega?',
            answer: 'Os prazos variam conforme a complexidade: Landing pages e sites de 1 a 3 semanas, Sistemas web simples de 4 a 8 semanas, Sistemas complexos (ERP/CRM) de 2 a 4 meses. Trabalhamos com entregas continuas.'
        },
        technologies: {
            question: 'Quais tecnologias utilizam?',
            answer: 'Utilizamos PHP, Laravel, Node.js, Vue.js, React, MySQL, PostgreSQL, Redis, Docker, AWS, Python, entre outras. Escolhemos a melhor stack para cada projeto.'
        },
        support: {
            question: 'Voces oferecem suporte?',
            answer: 'Sim. Oferecemos suporte tecnico, manutencao evolutiva, monitoramento de performance e atualizacoes de seguranca. Nosso tempo medio de resposta e de 2 horas em horario comercial.'
        },
        contact: {
            question: 'Como falar com alguem?',
            answer: 'Voce pode entrar em contato pelo WhatsApp para resposta rapida, por email em contato@onsolutions.com.br ou pelo formulario na pagina de contato. Atendemos de segunda a sexta, das 9h as 18h.'
        }
    };

    // Keywords para matching
    var keywords = {
        services: ['servico', 'serviço', 'oferecem', 'fazem', 'trabalham'],
        quote: ['orcamento', 'orçamento', 'preco', 'preço', 'valor', 'custo', 'quanto'],
        deadline: ['prazo', 'demora', 'tempo', 'entrega', 'quando'],
        technologies: ['tecnologia', 'linguagem', 'stack', 'framework', 'ferramenta'],
        support: ['suporte', 'ajuda', 'manutencao', 'manutenção', 'bug', 'problema'],
        contact: ['contato', 'falar', 'telefone', 'whatsapp', 'email']
    };

    // Iniciar com greeting + opções
    showGreetingAndOptions();

    // Toggle
    toggle.addEventListener('click', function() {
        var isOpen = chatWindow.style.display !== 'none';
        chatWindow.style.display = isOpen ? 'none' : 'flex';
        if (!isOpen) input.focus();
    });

    closeBtn.addEventListener('click', function() {
        chatWindow.style.display = 'none';
    });

    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var message = input.value.trim();
        if (!message) return;

        clearMessages();
        addMessage(message, 'user');
        input.value = '';

        var matchedFaq = matchKeywords(message);

        setTimeout(function() {
            if (matchedFaq) {
                addMessage(faqData[matchedFaq].answer, 'bot');
            } else {
                addMessage('Nao encontrei uma resposta para sua pergunta. Voce pode nos contatar pelo WhatsApp ou formulario de contato para falar com nossa equipe.', 'bot');
            }
            addBackButton();
        }, 400);
    });

    function showGreetingAndOptions() {
        clearMessages();
        addMessage('Ola! Como posso ajuda-lo? Selecione uma opcao ou digite sua duvida:', 'bot');
        showOptions();
    }

    function showOptions() {
        var div = document.createElement('div');
        div.className = 'chatbot-options';

        for (var key in faqData) {
            var btn = document.createElement('button');
            btn.className = 'chatbot-option-btn';
            btn.dataset.faq = key;
            btn.textContent = faqData[key].question;
            div.appendChild(btn);
        }

        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;

        div.addEventListener('click', function(e) {
            var btn = e.target.closest('.chatbot-option-btn');
            if (!btn) return;
            handleFaqClick(btn.dataset.faq);
        });
    }

    function handleFaqClick(key) {
        if (!faqData[key]) return;

        clearMessages();
        addMessage(faqData[key].question, 'user');

        setTimeout(function() {
            addMessage(faqData[key].answer, 'bot');
            addBackButton();
        }, 400);
    }

    function addBackButton() {
        var div = document.createElement('div');
        div.className = 'chatbot-back';
        var btn = document.createElement('button');
        btn.className = 'chatbot-back-btn';
        btn.innerHTML = '<i class="bi bi-arrow-left"></i> Voltar as opcoes';
        btn.addEventListener('click', function() {
            showGreetingAndOptions();
        });
        div.appendChild(btn);
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function matchKeywords(text) {
        text = text.toLowerCase();
        var bestMatch = null;
        var bestScore = 0;

        for (var key in keywords) {
            var score = 0;
            keywords[key].forEach(function(kw) {
                if (text.indexOf(kw) !== -1) score++;
            });
            if (score > bestScore) {
                bestScore = score;
                bestMatch = key;
            }
        }
        return bestScore > 0 ? bestMatch : null;
    }

    function clearMessages() {
        messages.innerHTML = '';
    }

    function addMessage(text, type) {
        var div = document.createElement('div');
        div.className = 'chat-message ' + type;
        div.innerHTML = '<p>' + text + '</p>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }
});
