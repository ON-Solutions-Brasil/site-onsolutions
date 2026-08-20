/**
 * ON Solutions - Chatbot FAQ Widget
 * Sistema de perguntas e respostas pré-montadas
 */
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.getElementById('chatbotToggle');
    var chatWindow = document.getElementById('chatbotWindow');
    var closeBtn = document.getElementById('chatbotClose');
    var form = document.getElementById('chatbotForm');
    var input = document.getElementById('chatbotInput');
    var messages = document.getElementById('chatbotMessages');
    var faqButtons = document.getElementById('chatbotFaqButtons');

    if (!toggle) return;

    // FAQ - Perguntas e respostas pré-montadas
    var faqData = {
        services: {
            question: 'Quais serviços vocês oferecem?',
            answer: 'Oferecemos uma ampla gama de serviços:<br><br>• <strong>Sistemas Web</strong> — Plataformas completas e escaláveis<br>• <strong>ERP & CRM</strong> — Gestão empresarial sob medida<br>• <strong>Integrações & APIs</strong> — Conecte seus sistemas<br>• <strong>Automações</strong> — Elimine processos manuais<br>• <strong>Inteligência Artificial</strong> — Chatbots, análise preditiva<br>• <strong>Consultoria</strong> — Diagnóstico e planejamento<br><br>Quer saber mais sobre algum serviço específico?'
        },
        quote: {
            question: 'Como solicitar um orçamento?',
            answer: 'Solicitar um orçamento é simples! Você pode:<br><br>1. 📋 <strong>Formulário de contato</strong> — Preencha nosso formulário na página de contato<br>2. 💬 <strong>WhatsApp</strong> — Nos chame diretamente para uma conversa rápida<br>3. 📧 <strong>Email</strong> — Envie detalhes do seu projeto para nosso email<br><br>Após receber sua solicitação, retornamos em até <strong>2 horas</strong> durante o horário comercial com uma proposta personalizada.'
        },
        deadline: {
            question: 'Qual o prazo de entrega?',
            answer: 'Os prazos variam conforme a complexidade do projeto:<br><br>• <strong>Landing pages e sites</strong> — 1 a 3 semanas<br>• <strong>Sistemas web simples</strong> — 4 a 8 semanas<br>• <strong>Sistemas complexos (ERP/CRM)</strong> — 2 a 4 meses<br>• <strong>Integrações e automações</strong> — 1 a 4 semanas<br><br>Trabalhamos com <strong>sprints semanais</strong> e entregas contínuas, para que você acompanhe o progresso desde o primeiro dia.'
        },
        technologies: {
            question: 'Quais tecnologias utilizam?',
            answer: 'Trabalhamos com as tecnologias mais modernas do mercado:<br><br>• <strong>Backend:</strong> PHP, Laravel, Node.js, Python<br>• <strong>Frontend:</strong> Vue.js, React, TypeScript<br>• <strong>Mobile:</strong> React Native, Flutter<br>• <strong>Banco de dados:</strong> MySQL, PostgreSQL, Redis<br>• <strong>Cloud:</strong> AWS, Docker, Kubernetes<br>• <strong>IA:</strong> OpenAI, LangChain, TensorFlow<br><br>Escolhemos a stack ideal para cada projeto baseado nas necessidades específicas.'
        },
        support: {
            question: 'Vocês oferecem suporte?',
            answer: 'Sim! Oferecemos suporte contínuo após a entrega:<br><br>• ✅ <strong>Suporte técnico</strong> — Correção de bugs e problemas<br>• ✅ <strong>Manutenção evolutiva</strong> — Novas funcionalidades<br>• ✅ <strong>Monitoramento</strong> — Acompanhamento de performance<br>• ✅ <strong>Atualizações de segurança</strong> — Proteção constante<br><br>Nosso tempo médio de resposta é de <strong>2 horas</strong> durante o horário comercial (seg-sex, 9h-18h).'
        },
        contact: {
            question: 'Como falar com alguém?',
            answer: 'Você pode entrar em contato conosco por:<br><br>• 💬 <strong>WhatsApp</strong> — Resposta rápida em minutos<br>• 📧 <strong>Email</strong> — contato@onsolutions.com.br<br>• 📋 <strong>Formulário</strong> — Na página de contato do site<br><br>Nosso horário de atendimento:<br>Segunda a Sexta: 9h às 18h<br>Sábado: 9h às 13h'
        }
    };

    // Keywords para matching de texto livre
    var keywords = {
        services: ['serviço', 'servico', 'oferecem', 'fazem', 'trabalham', 'service', 'what do'],
        quote: ['orçamento', 'orcamento', 'preço', 'preco', 'valor', 'custo', 'quanto custa', 'price', 'quote', 'budget'],
        deadline: ['prazo', 'demora', 'tempo', 'entrega', 'quando fica pronto', 'deadline', 'how long'],
        technologies: ['tecnologia', 'linguagem', 'stack', 'framework', 'ferramenta', 'technology', 'tech'],
        support: ['suporte', 'ajuda', 'manutenção', 'manutencao', 'bug', 'problema', 'support', 'help'],
        contact: ['contato', 'falar', 'telefone', 'whatsapp', 'email', 'contact', 'talk']
    };

    // Toggle chatbot
    toggle.addEventListener('click', function() {
        var isOpen = chatWindow.style.display !== 'none';
        chatWindow.style.display = isOpen ? 'none' : 'flex';
        if (!isOpen) input.focus();
    });

    closeBtn.addEventListener('click', function() {
        chatWindow.style.display = 'none';
    });

    // FAQ button clicks
    faqButtons.addEventListener('click', function(e) {
        var btn = e.target.closest('.chatbot-faq-btn');
        if (!btn) return;
        var faqKey = btn.dataset.faq;
        handleFaq(faqKey);
    });

    // Form submit (texto livre)
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var message = input.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        input.value = '';

        // Tentar encontrar FAQ relevante
        var matchedFaq = matchKeywords(message);
        
        setTimeout(function() {
            if (matchedFaq) {
                addMessageHtml(faqData[matchedFaq].answer, 'bot');
                setTimeout(function() {
                    showFollowUp();
                }, 800);
            } else {
                addMessageHtml('Não encontrei uma resposta específica para sua pergunta. 🤔<br><br>Posso ajudar com estes assuntos:', 'bot');
                setTimeout(function() {
                    showFaqButtons();
                }, 500);
            }
        }, 500);
    });

    function handleFaq(key) {
        if (!faqData[key]) return;
        
        // Esconder os botões FAQ iniciais
        if (faqButtons) faqButtons.style.display = 'none';

        // Mostrar pergunta do usuário
        addMessage(faqData[key].question, 'user');

        // Mostrar resposta com delay (simula digitação)
        setTimeout(function() {
            addMessageHtml(faqData[key].answer, 'bot');
            
            // Mostrar follow-up depois da resposta com delay extra
            setTimeout(function() {
                showFollowUp();
            }, 800);
        }, 600);
    }

    function matchKeywords(text) {
        text = text.toLowerCase();
        var bestMatch = null;
        var bestScore = 0;

        for (var key in keywords) {
            var score = 0;
            keywords[key].forEach(function(kw) {
                if (text.indexOf(kw.toLowerCase()) !== -1) {
                    score++;
                }
            });
            if (score > bestScore) {
                bestScore = score;
                bestMatch = key;
            }
        }

        return bestScore > 0 ? bestMatch : null;
    }

    function showFollowUp() {
        var div = document.createElement('div');
        div.className = 'chatbot-followup';
        div.innerHTML = '<p class="chatbot-followup-text">Posso ajudar com mais alguma coisa?</p><div class="chatbot-faq-buttons chatbot-faq-buttons--inline"></div>';
        
        var btnsContainer = div.querySelector('.chatbot-faq-buttons');
        for (var key in faqData) {
            var btn = document.createElement('button');
            btn.className = 'chatbot-faq-btn';
            btn.dataset.faq = key;
            btn.textContent = faqData[key].question;
            btnsContainer.appendChild(btn);
        }
        
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;

        // Delegate clicks
        btnsContainer.addEventListener('click', function(e) {
            var btn = e.target.closest('.chatbot-faq-btn');
            if (!btn) return;
            div.remove();
            handleFaq(btn.dataset.faq);
        });
    }

    function showFaqButtons() {
        var div = document.createElement('div');
        div.className = 'chatbot-faq-buttons chatbot-faq-buttons--inline';
        
        for (var key in faqData) {
            var btn = document.createElement('button');
            btn.className = 'chatbot-faq-btn';
            btn.dataset.faq = key;
            btn.textContent = faqData[key].question;
            div.appendChild(btn);
        }
        
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;

        div.addEventListener('click', function(e) {
            var btn = e.target.closest('.chatbot-faq-btn');
            if (!btn) return;
            div.remove();
            handleFaq(btn.dataset.faq);
        });
    }

    function addMessage(text, type) {
        var div = document.createElement('div');
        div.className = 'chat-message ' + type;
        div.innerHTML = '<p>' + escapeHtml(text) + '</p>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function addMessageHtml(html, type) {
        var div = document.createElement('div');
        div.className = 'chat-message ' + type;
        div.innerHTML = '<p>' + html + '</p>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
});
