<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class ServicesController extends Controller
{
    /**
     * Lista todos os serviços.
     */
    public function index(): void
    {
        $this->data['page_title'] = __('services.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('services.meta_description');

        $this->data['services'] = $this->db->fetchAll(
            "SELECT * FROM services WHERE is_active = 1 ORDER BY order_position ASC"
        );

        $this->view('site/services', $this->data);
    }

    /**
     * Página individual do serviço.
     */
    public function show(string $slug): void
    {
        $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';

        $service = $this->db->fetch(
            "SELECT * FROM services WHERE slug = ? AND is_active = 1",
            [$slug]
        );

        if (!$service) {
            http_response_code(404);
            $errorController = new \App\Controllers\ErrorController();
            $errorController->notFound();
            return;
        }

        $titleField = "title_{$lang}";
        $descField = "meta_description_{$lang}";

        $this->data['page_title'] = ($service[$titleField] ?? $service['title_pt']) . ' - ' . SITE_NAME;
        $this->data['meta_description'] = $service[$descField] ?? $service['meta_description_pt'] ?? '';

        // Aplicar conteúdo fallback se o campo content_pt estiver vazio
        if (empty($service['content_pt'])) {
            $fallback = $this->getServiceFallbackContent($slug);
            if ($fallback) {
                $service = array_merge($service, $fallback);
            }
        }

        $this->data['service'] = $service;

        // Outros serviços (exclui o serviço atual)
        $this->data['other_services'] = $this->db->fetchAll(
            "SELECT id, slug, icon, title_pt, title_en, title_es, short_description_pt, short_description_en, short_description_es FROM services WHERE is_active = 1 AND slug != ? ORDER BY order_position ASC",
            [$slug]
        );

        // Portfólio relacionado
        $this->data['related_portfolio'] = $this->db->fetchAll(
            "SELECT * FROM portfolio_items WHERE is_active = 1 ORDER BY RAND() LIMIT 3"
        );

        $this->view('site/service-detail', $this->data);
    }

    /**
     * Conteúdo fallback para serviços sem content_pt no banco.
     */
    private function getServiceFallbackContent(string $slug): ?array
    {
        $data = [
            'crm' => [
                'content_pt' => '<h2>O que é um CRM?</h2>
<p>CRM (Customer Relationship Management) é um sistema de gestão do relacionamento com clientes que centraliza todas as interações, histórico de comunicações, negociações e dados dos seus contatos em um único lugar.</p>
<p>Na On Solutions, desenvolvemos CRMs personalizados que se adaptam perfeitamente ao fluxo de trabalho da sua empresa, eliminando processos manuais e garantindo que nenhuma oportunidade seja perdida.</p>

<h2>Por que investir em um CRM personalizado?</h2>
<p>Diferente de soluções genéricas, um CRM sob medida é construído para atender exatamente as necessidades do seu negócio. Não há funcionalidades desnecessárias ou limitações de planos — você tem exatamente o que precisa, com total controle sobre os dados.</p>

<h3>Gestão completa do funil de vendas</h3>
<p>Acompanhe cada oportunidade desde o primeiro contato até o fechamento. Visualize em qual etapa cada negociação se encontra, defina ações automáticas para cada estágio e nunca mais perca uma venda por falta de acompanhamento.</p>

<h3>Automação de follow-ups</h3>
<p>Configure lembretes automáticos, envio de e-mails programados e notificações para sua equipe. O sistema trabalha por você, garantindo que cada cliente receba a atenção necessária no momento certo.</p>

<h3>Relatórios e métricas em tempo real</h3>
<p>Dashboards interativos mostram a performance da equipe, taxa de conversão, ticket médio, tempo de ciclo de vendas e muito mais. Tome decisões baseadas em dados reais.</p>

<h3>Integração com suas ferramentas</h3>
<p>Conecte seu CRM com WhatsApp, e-mail, telefonia, redes sociais e outras ferramentas que sua equipe já utiliza. Todas as interações centralizadas em um só lugar.</p>',
                'features' => json_encode(["Gestão de contatos e empresas", "Pipeline de vendas visual (Kanban)", "Automação de e-mails e follow-ups", "Histórico completo de interações", "Agendamento de tarefas e lembretes", "Relatórios e dashboards em tempo real", "Integração com WhatsApp e e-mail", "Gestão de propostas e orçamentos", "Segmentação avançada de clientes", "Importação/exportação de dados", "API para integrações externas", "Permissões por usuário e equipe"]),
                'technologies' => json_encode(["PHP", "Laravel", "Vue.js", "MySQL", "Redis", "REST API", "WebSockets", "Bootstrap", "Chart.js"]),
            ],
            'sistemas-web' => [
                'content_pt' => '<h2>Sistemas Web sob medida</h2>
<p>Desenvolvemos sistemas web completos e escaláveis, desde plataformas corporativas até aplicações SaaS complexas. Cada projeto é construído com arquitetura moderna, pensando em performance, segurança e crescimento futuro.</p>

<h2>Como trabalhamos</h2>
<p>Nosso processo começa com uma análise profunda do seu negócio. Mapeamos processos, identificamos gargalos e propomos soluções que realmente resolvem problemas. Não entregamos apenas código — entregamos uma ferramenta que transforma a operação da sua empresa.</p>

<h3>Arquitetura escalável</h3>
<p>Sistemas preparados para crescer com seu negócio. Utilizamos microsserviços, cache inteligente e infraestrutura cloud para garantir que sua aplicação suporte milhares de usuários simultâneos.</p>

<h3>Interface moderna e responsiva</h3>
<p>Experiência do usuário é prioridade. Interfaces intuitivas, rápidas e que funcionam perfeitamente em qualquer dispositivo — desktop, tablet ou smartphone.</p>

<h3>Segurança de ponta</h3>
<p>Autenticação robusta, criptografia de dados, proteção contra ataques e backups automáticos. Seus dados e os dados dos seus clientes estão sempre protegidos.</p>',
                'features' => json_encode(["Painéis administrativos completos", "Gestão de usuários e permissões", "APIs RESTful documentadas", "Integrações com sistemas externos", "Relatórios dinâmicos e exportação", "Notificações em tempo real", "Multi-idioma e multi-moeda", "Backup automático de dados", "Deploy contínuo (CI/CD)", "Documentação técnica completa", "Suporte e manutenção pós-entrega", "Escalabilidade horizontal"]),
                'technologies' => json_encode(["PHP", "Laravel", "Node.js", "Vue.js", "React", "MySQL", "PostgreSQL", "Redis", "Docker", "AWS", "REST API", "GraphQL"]),
            ],
            'erp-personalizado' => [
                'content_pt' => '<h2>ERP sob medida para sua empresa</h2>
<p>Um ERP (Enterprise Resource Planning) personalizado integra todos os departamentos da sua empresa em uma única plataforma. Finanças, estoque, compras, vendas, produção e RH — tudo conectado e funcionando em harmonia.</p>

<h2>Vantagens de um ERP personalizado</h2>
<p>Sistemas ERP genéricos forçam sua empresa a se adaptar ao software. Com um ERP sob medida, o software se adapta ao seu negócio, respeitando seus processos e potencializando seus diferenciais.</p>

<h3>Módulos integrados</h3>
<p>Financeiro, estoque, compras, vendas, produção, RH — todos os módulos conversam entre si em tempo real. Uma venda atualiza automaticamente o estoque, gera o financeiro e alimenta os relatórios gerenciais.</p>

<h3>Workflows customizados</h3>
<p>Defina aprovações, notificações e ações automáticas para cada processo da sua empresa. O sistema segue as regras do seu negócio, não o contrário.</p>',
                'features' => json_encode(["Módulo financeiro completo", "Gestão de estoque e inventário", "Controle de compras e fornecedores", "Gestão de vendas e pedidos", "Módulo de produção/manufatura", "Gestão de RH e folha", "Relatórios gerenciais avançados", "Workflows e aprovações", "Multi-empresa e filiais", "Notas fiscais e integração SEFAZ", "Dashboard executivo", "Controle de acessos granular"]),
                'technologies' => json_encode(["PHP", "Laravel", "Vue.js", "MySQL", "Redis", "REST API", "Docker", "ElasticSearch", "RabbitMQ"]),
            ],
            'integracoes-apis' => [
                'content_pt' => '<h2>Conecte seus sistemas</h2>
<p>Integrações e APIs permitem que seus sistemas conversem entre si de forma automática e segura. Eliminamos o trabalho manual de transferir dados entre plataformas e garantimos que todas as suas ferramentas funcionem em sincronia.</p>

<h2>O que fazemos</h2>
<p>Desenvolvemos APIs robustas, criamos integrações com plataformas existentes e automatizamos fluxos de dados entre sistemas. De ERPs a e-commerces, de CRMs a plataformas de pagamento — conectamos tudo.</p>

<h3>APIs RESTful e GraphQL</h3>
<p>Criamos APIs bem documentadas, seguras e performáticas que permitem que qualquer sistema se comunique com o seu de forma padronizada.</p>

<h3>Integrações com plataformas populares</h3>
<p>WhatsApp Business API, gateways de pagamento, marketplaces, ERPs, plataformas de e-mail marketing, redes sociais e muito mais.</p>',
                'features' => json_encode(["APIs RESTful documentadas", "Integrações com WhatsApp Business", "Gateways de pagamento (Stripe, PagSeguro, Pix)", "Integração com marketplaces", "Webhooks e eventos em tempo real", "Sincronização de dados entre sistemas", "Filas de processamento assíncrono", "Logs e monitoramento de integrações", "Retry automático em caso de falha", "Documentação Swagger/OpenAPI", "Rate limiting e segurança", "Versionamento de APIs"]),
                'technologies' => json_encode(["REST API", "GraphQL", "Node.js", "PHP", "Python", "RabbitMQ", "Redis", "WebSockets", "OAuth 2.0", "Swagger", "Docker"]),
            ],
            'automacoes' => [
                'content_pt' => '<h2>Automatize processos repetitivos</h2>
<p>A automação elimina tarefas manuais, reduz erros humanos e libera sua equipe para focar no que realmente importa. Identificamos processos repetitivos no seu negócio e criamos soluções que trabalham 24/7 por você.</p>

<h2>Onde a automação se aplica</h2>
<p>De envio de e-mails a geração de relatórios, de atualização de estoque a disparo de notificações — qualquer processo repetitivo pode ser automatizado para ganhar velocidade e precisão.</p>

<h3>Automação de marketing</h3>
<p>Sequências de e-mails, segmentação de leads, nutrição de contatos e disparos personalizados baseados em comportamento do usuário.</p>

<h3>Automação operacional</h3>
<p>Geração automática de documentos, atualização de planilhas, sincronização de dados entre sistemas e alertas inteligentes.</p>',
                'features' => json_encode(["Automação de e-mails e notificações", "Workflows visuais (drag and drop)", "Triggers baseados em eventos", "Automação de relatórios", "Integração com ferramentas existentes", "Agendamento de tarefas recorrentes", "Processamento em lote", "Alertas e notificações inteligentes", "Logs e auditoria de execuções", "Automação de social media", "Chatbots e respostas automáticas", "RPA (Automação Robótica de Processos)"]),
                'technologies' => json_encode(["Node.js", "Python", "n8n", "Redis", "RabbitMQ", "Cron Jobs", "Puppeteer", "REST API", "Webhooks"]),
            ],
            'dashboards-bi' => [
                'content_pt' => '<h2>Decisões baseadas em dados</h2>
<p>Dashboards e Business Intelligence transformam dados brutos em insights acionáveis. Criamos painéis interativos que mostram em tempo real o que está acontecendo no seu negócio, permitindo decisões rápidas e assertivas.</p>

<h2>O que entregamos</h2>
<p>Desde painéis executivos para diretoria até dashboards operacionais para equipes, cada visualização é pensada para o público-alvo e para o tipo de decisão que precisa ser tomada.</p>

<h3>Visualizações interativas</h3>
<p>Gráficos, tabelas, mapas e indicadores que respondem a filtros em tempo real. Drill-down para explorar dados em profundidade.</p>

<h3>KPIs e alertas</h3>
<p>Defina indicadores-chave e receba alertas quando metas são atingidas ou quando algo precisa de atenção imediata.</p>',
                'features' => json_encode(["Dashboards em tempo real", "KPIs e indicadores personalizados", "Gráficos interativos e drill-down", "Relatórios automatizados (PDF/Excel)", "Alertas e notificações de metas", "Integração com múltiplas fontes de dados", "Filtros dinâmicos e segmentação", "Compartilhamento e permissões", "Visualização mobile-friendly", "ETL e processamento de dados", "Previsões e tendências", "Exportação em múltiplos formatos"]),
                'technologies' => json_encode(["Chart.js", "D3.js", "Apache ECharts", "PHP", "Python", "MySQL", "PostgreSQL", "Redis", "ElasticSearch", "REST API"]),
            ],
            'aplicativos-mobile' => [
                'content_pt' => '<h2>Apps para iOS e Android</h2>
<p>Desenvolvemos aplicativos mobile nativos e híbridos que oferecem experiência premium aos seus usuários. De apps corporativos a produtos para o consumidor final, criamos soluções mobile que geram resultado.</p>

<h2>Nossa abordagem</h2>
<p>Combinamos design centrado no usuário com tecnologia de ponta para criar apps rápidos, bonitos e funcionais. Cada tela é pensada para facilitar a jornada do usuário e atingir os objetivos do negócio.</p>

<h3>Apps nativos e híbridos</h3>
<p>Escolhemos a melhor tecnologia para cada projeto. React Native para entregas rápidas multiplataforma ou desenvolvimento nativo para máxima performance.</p>

<h3>UX/UI para mobile</h3>
<p>Interfaces que seguem as guidelines de cada plataforma, com navegação intuitiva e design que encanta os usuários.</p>',
                'features' => json_encode(["Apps para iOS e Android", "React Native (multiplataforma)", "Flutter para alta performance", "Push notifications", "Geolocalização e mapas", "Pagamentos in-app", "Câmera e mídia", "Armazenamento offline", "Autenticação biométrica", "Publicação nas lojas (App Store/Play Store)", "Analytics e métricas de uso", "Atualizações OTA (Over-the-Air)"]),
                'technologies' => json_encode(["React Native", "Flutter", "Swift", "Kotlin", "Firebase", "REST API", "GraphQL", "SQLite", "Redux", "TypeScript"]),
            ],
            'saas' => [
                'content_pt' => '<h2>Plataformas SaaS escaláveis</h2>
<p>Criamos plataformas SaaS (Software as a Service) prontas para escalar. Arquitetura multi-tenant, billing automatizado, onboarding de clientes e toda a infraestrutura que seu produto digital precisa para crescer.</p>

<h2>Do MVP ao produto maduro</h2>
<p>Ajudamos desde a validação da ideia com um MVP enxuto até a evolução para uma plataforma robusta com milhares de usuários. Cada decisão técnica é tomada pensando no crescimento sustentável.</p>

<h3>Arquitetura multi-tenant</h3>
<p>Cada cliente tem seus dados isolados, mas compartilha a mesma infraestrutura. Escalabilidade com eficiência de custos.</p>

<h3>Billing e assinaturas</h3>
<p>Gestão completa de planos, cobranças recorrentes, trials, upgrades e downgrades integrada à plataforma.</p>',
                'features' => json_encode(["Arquitetura multi-tenant", "Sistema de billing e assinaturas", "Onboarding automatizado", "Painel do cliente (self-service)", "API pública documentada", "Webhooks e integrações", "Gestão de planos e permissões", "Métricas SaaS (MRR, Churn, LTV)", "White-label customizável", "SSO e autenticação enterprise", "Escalabilidade horizontal", "Monitoramento e alertas"]),
                'technologies' => json_encode(["Laravel", "Vue.js", "React", "PostgreSQL", "Redis", "Stripe", "Docker", "Kubernetes", "AWS", "Terraform", "CI/CD"]),
            ],
            'inteligencia-artificial' => [
                'content_pt' => '<h2>IA aplicada ao seu negócio</h2>
<p>Inteligência Artificial não é mais futuro — é presente. Implementamos soluções de IA que resolvem problemas reais: chatbots inteligentes, análise preditiva, processamento de linguagem natural e visão computacional.</p>

<h2>Soluções práticas com IA</h2>
<p>Não trabalhamos com hype — trabalhamos com resultados. Cada solução de IA é implementada para resolver um problema específico do seu negócio, com métricas claras de sucesso.</p>

<h3>Chatbots e assistentes virtuais</h3>
<p>Atendimento 24/7, qualificação de leads, suporte ao cliente e automação de processos conversacionais com IA generativa.</p>

<h3>Análise preditiva</h3>
<p>Previsão de vendas, detecção de churn, scoring de leads e otimização de processos baseada em padrões históricos.</p>',
                'features' => json_encode(["Chatbots com IA generativa", "Processamento de linguagem natural (NLP)", "Análise preditiva e forecasting", "Classificação e categorização automática", "Recomendações personalizadas", "Visão computacional", "Análise de sentimento", "Geração de conteúdo com IA", "OCR e extração de dados", "Integração com OpenAI/GPT", "Modelos customizados", "Treinamento com dados próprios"]),
                'technologies' => json_encode(["Python", "OpenAI API", "LangChain", "TensorFlow", "PyTorch", "scikit-learn", "FastAPI", "PostgreSQL", "Redis", "Docker", "Pinecone"]),
            ],
            'chatbots' => [
                'content_pt' => '<h2>Chatbots inteligentes</h2>
<p>Chatbots vão muito além de respostas automáticas. Desenvolvemos assistentes virtuais que entendem contexto, aprendem com interações e resolvem problemas reais dos seus clientes — 24 horas por dia, 7 dias por semana.</p>

<h2>Aplicações práticas</h2>
<p>De atendimento ao cliente a qualificação de leads, de suporte técnico a vendas assistidas — chatbots inteligentes transformam a experiência do seu cliente e reduzem custos operacionais.</p>

<h3>IA Conversacional</h3>
<p>Nossos chatbots utilizam modelos de linguagem avançados para entender intenções, manter contexto na conversa e fornecer respostas relevantes e personalizadas.</p>

<h3>Integração omnichannel</h3>
<p>O mesmo chatbot funciona no WhatsApp, site, Instagram, Telegram e onde mais seus clientes estiverem.</p>',
                'features' => json_encode(["IA conversacional avançada", "Integração com WhatsApp Business", "Atendimento 24/7 automatizado", "Qualificação de leads", "Transferência para atendente humano", "Histórico de conversas", "Respostas baseadas em documentos", "Multi-idioma automático", "Analytics de conversas", "Personalização por segmento", "Integração com CRM", "Treinamento com dados da empresa"]),
                'technologies' => json_encode(["OpenAI API", "LangChain", "Node.js", "Python", "WhatsApp Cloud API", "WebSockets", "Redis", "PostgreSQL", "Pinecone", "FastAPI"]),
            ],
            'machine-learning' => [
                'content_pt' => '<h2>Machine Learning aplicado</h2>
<p>Machine Learning permite que sistemas aprendam com dados e melhorem continuamente sem programação explícita. Aplicamos ML para resolver problemas complexos de previsão, classificação e otimização.</p>

<h2>Casos de uso</h2>
<p>De previsão de demanda a detecção de fraudes, de segmentação de clientes a otimização de preços — Machine Learning encontra padrões que humanos não conseguem ver.</p>

<h3>Modelos preditivos</h3>
<p>Previsão de vendas, churn, demanda de estoque e comportamento do cliente baseada em dados históricos e variáveis contextuais.</p>

<h3>Sistemas de recomendação</h3>
<p>Sugira produtos, conteúdos ou ações relevantes para cada usuário baseado em comportamento e perfil.</p>',
                'features' => json_encode(["Modelos preditivos customizados", "Classificação e clustering", "Sistemas de recomendação", "Detecção de anomalias e fraudes", "Processamento de linguagem natural", "Séries temporais e forecasting", "Feature engineering", "Validação e monitoramento de modelos", "A/B testing de modelos", "Pipeline de dados automatizado", "Deploy de modelos em produção", "Retreinamento automático"]),
                'technologies' => json_encode(["Python", "scikit-learn", "TensorFlow", "PyTorch", "Pandas", "NumPy", "MLflow", "Apache Spark", "PostgreSQL", "Docker", "FastAPI"]),
            ],
            'consultoria' => [
                'content_pt' => '<h2>Consultoria tecnológica estratégica</h2>
<p>Nem sempre a solução é construir algo novo. Às vezes o que sua empresa precisa é de um olhar especializado para identificar oportunidades, resolver gargalos e traçar o melhor caminho para a transformação digital.</p>

<h2>Como ajudamos</h2>
<p>Analisamos seu cenário atual, mapeamos processos, identificamos ineficiências e propomos soluções práticas — sejam elas técnicas, processuais ou estratégicas.</p>

<h3>Diagnóstico tecnológico</h3>
<p>Avaliamos sua infraestrutura, sistemas e processos atuais para identificar pontos de melhoria e oportunidades de otimização.</p>

<h3>Roadmap de transformação digital</h3>
<p>Criamos um plano prático e priorizado para modernizar sua operação, com marcos claros e ROI estimado para cada etapa.</p>',
                'features' => json_encode(["Diagnóstico tecnológico completo", "Mapeamento de processos (AS-IS/TO-BE)", "Roadmap de transformação digital", "Arquitetura de soluções", "Seleção de tecnologias", "Due diligence técnica", "Code review e auditoria", "Otimização de performance", "Planejamento de escalabilidade", "Mentoria técnica para equipes", "Gestão de projetos (PMO)", "Análise de viabilidade técnica"]),
                'technologies' => json_encode(["UML", "BPMN", "Cloud Architecture", "Docker", "Kubernetes", "AWS", "Azure", "GCP", "Terraform", "CI/CD", "Agile/Scrum"]),
            ],
            'performance' => [
                'content_pt' => '<h2>Performance e escalabilidade</h2>
<p>Um sistema lento custa dinheiro — em clientes perdidos, em produtividade e em reputação. Otimizamos a performance de aplicações web para que carreguem rápido, suportem picos de tráfego e ofereçam a melhor experiência possível.</p>

<h2>O que otimizamos</h2>
<p>De queries de banco de dados a estratégias de cache, de compressão de assets a CDN — cada milissegundo importa e cada camada da sua aplicação tem espaço para melhorar.</p>

<h3>Otimização de banco de dados</h3>
<p>Análise de queries lentas, criação de índices, normalização/desnormalização estratégica e configuração de cache para reduzir tempo de resposta.</p>

<h3>Escalabilidade</h3>
<p>Arquitetura preparada para crescimento: load balancing, auto-scaling, microserviços e filas de processamento assíncrono.</p>',
                'features' => json_encode(["Auditoria de performance", "Otimização de queries SQL", "Implementação de cache (Redis/Memcached)", "CDN e otimização de assets", "Lazy loading e code splitting", "Compressão e minificação", "Load balancing", "Auto-scaling configurado", "Monitoramento de APM", "Core Web Vitals (Google)", "Stress testing e benchmarks", "Otimização de servidor"]),
                'technologies' => json_encode(["Redis", "Varnish", "Nginx", "CloudFlare", "New Relic", "Datadog", "Docker", "Kubernetes", "AWS", "Load Balancer", "ElasticSearch"]),
            ],
            'infraestrutura' => [
                'content_pt' => '<h2>Infraestrutura moderna e escalável</h2>
<p>Infraestrutura é a base de tudo. Configuramos e gerenciamos ambientes cloud, implementamos DevOps e garantimos que sua aplicação esteja sempre disponível, segura e preparada para crescer.</p>

<h2>O que oferecemos</h2>
<p>De configuração inicial de servidores a pipelines de deploy automatizado, de monitoramento 24/7 a disaster recovery — cuidamos de toda a infraestrutura para que você foque no produto.</p>

<h3>Cloud Computing</h3>
<p>Migração para cloud, configuração de ambientes em AWS, GCP ou Azure, com otimização de custos e máxima disponibilidade.</p>

<h3>DevOps e CI/CD</h3>
<p>Pipelines automatizados de build, test e deploy. Containers Docker, orquestração com Kubernetes e infrastructure as code.</p>',
                'features' => json_encode(["Configuração de servidores cloud", "Docker e containerização", "Kubernetes (orquestração)", "CI/CD pipelines", "Infrastructure as Code (Terraform)", "Monitoramento e alertas 24/7", "Backup e disaster recovery", "SSL/TLS e segurança", "Load balancing e alta disponibilidade", "Migração para cloud", "Otimização de custos cloud", "Gestão de ambientes (dev/staging/prod)"]),
                'technologies' => json_encode(["AWS", "GCP", "Azure", "Docker", "Kubernetes", "Terraform", "Ansible", "GitHub Actions", "GitLab CI", "Nginx", "CloudFlare", "Prometheus"]),
            ],
        ];

        return $data[$slug] ?? null;
    }
}
