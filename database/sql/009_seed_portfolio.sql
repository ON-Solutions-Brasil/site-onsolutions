-- ============================================================
-- On Solutions - Script SQL #009
-- Seed: Itens de Portfólio (demonstração)
-- ============================================================

SET NAMES utf8mb4;

INSERT INTO `portfolio_items` (`title_pt`, `title_en`, `title_es`, `slug`, `short_description_pt`, `client_name`, `category_id`, `cover_image`, `technologies`, `is_featured`, `is_active`, `order_position`, `completed_at`) VALUES

('Sistema de Gestão Empresarial', 'Enterprise Management System', 'Sistema de Gestión Empresarial', 'sistema-gestao-empresarial', 'ERP completo com módulos de financeiro, estoque, vendas e RH integrados.', 'TechCorp Brasil', 2, NULL, '["PHP", "Laravel", "Vue.js", "MySQL", "Redis"]', 1, 1, 1, '2024-03-15'),

('Plataforma E-commerce B2B', 'B2B E-commerce Platform', 'Plataforma E-commerce B2B', 'plataforma-ecommerce-b2b', 'Marketplace B2B com gestão de pedidos, catálogo inteligente e integração com ERPs.', 'Distribuidora Nacional', 7, NULL, '["Node.js", "React", "PostgreSQL", "AWS", "Stripe"]', 1, 1, 2, '2024-06-20'),

('CRM Personalizado', 'Custom CRM', 'CRM Personalizado', 'crm-personalizado', 'Sistema CRM sob medida com pipeline de vendas, automações e relatórios avançados.', 'Grupo Inovare', 3, NULL, '["PHP", "Alpine.js", "Tailwind CSS", "MySQL"]', 0, 1, 3, '2024-01-10'),

('Integração Multi-sistema', 'Multi-system Integration', 'Integración Multi-sistema', 'integracao-multi-sistema', 'Hub de integrações conectando ERP, CRM, e-commerce e logística via APIs REST.', 'LogiTech Solutions', 4, NULL, '["Python", "FastAPI", "RabbitMQ", "Docker", "AWS Lambda"]', 1, 1, 4, '2024-08-05'),

('App de Gestão de Frota', 'Fleet Management App', 'App de Gestión de Flota', 'app-gestao-frota', 'Aplicativo mobile para rastreamento e gestão de frotas com telemetria em tempo real.', 'TransLog Express', 5, NULL, '["React Native", "Node.js", "MongoDB", "Socket.io", "Google Maps"]', 0, 1, 5, '2024-04-22'),

('Assistente IA para Atendimento', 'AI Customer Service Assistant', 'Asistente IA para Atención', 'assistente-ia-atendimento', 'Chatbot inteligente com NLP treinado em dados da empresa para atendimento 24/7.', 'Banco Digital+', 6, NULL, '["Python", "OpenAI", "LangChain", "FastAPI", "Redis"]', 1, 1, 6, '2024-09-12'),

('Portal SaaS de RH', 'HR SaaS Portal', 'Portal SaaS de RRHH', 'portal-saas-rh', 'Plataforma multi-tenant de gestão de pessoas com folha, ponto e recrutamento.', 'PeopleFirst', 8, NULL, '["Laravel", "Livewire", "PostgreSQL", "Stripe", "Docker"]', 0, 1, 7, '2024-07-30'),

('Sistema Web para Clínicas', 'Clinic Web System', 'Sistema Web para Clínicas', 'sistema-web-clinicas', 'Sistema completo para gestão de clínicas médicas com agendamento e prontuário eletrônico.', 'Rede Saúde+', 1, NULL, '["PHP", "Vue.js", "MySQL", "WebSockets", "AWS"]', 1, 1, 8, '2024-05-18'),

('Automação de Marketing', 'Marketing Automation', 'Automatización de Marketing', 'automacao-marketing', 'Plataforma de automação com fluxos de email, lead scoring e analytics integrado.', 'Digital Growth', 1, NULL, '["Node.js", "React", "MongoDB", "SendGrid", "Segment"]', 0, 1, 9, '2024-02-28');
