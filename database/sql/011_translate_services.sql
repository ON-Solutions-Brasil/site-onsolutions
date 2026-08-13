-- ============================================================
-- ON Solutions - Script SQL #011
-- Tradução dos serviços para EN e ES
-- ============================================================

-- Sistemas Web
UPDATE `services` SET
    `title_en` = 'Web Systems',
    `title_es` = 'Sistemas Web',
    `short_description_en` = 'Development of complete and scalable web systems for your company.',
    `short_description_es` = 'Desarrollo de sistemas web completos y escalables para su empresa.'
WHERE `slug` = 'sistemas-web';

-- ERP Personalizado
UPDATE `services` SET
    `title_en` = 'Custom ERP',
    `title_es` = 'ERP Personalizado',
    `short_description_en` = 'Custom enterprise management systems developed to fit your business.',
    `short_description_es` = 'Sistemas de gestión empresarial desarrollados a medida para su negocio.'
WHERE `slug` = 'erp-personalizado';

-- CRM
UPDATE `services` SET
    `title_en` = 'CRM',
    `title_es` = 'CRM',
    `short_description_en` = 'Complete management of the relationship with your clients.',
    `short_description_es` = 'Gestión completa del relacionamiento con sus clientes.'
WHERE `slug` = 'crm';

-- Integrações & APIs
UPDATE `services` SET
    `title_en` = 'Integrations & APIs',
    `title_es` = 'Integraciones & APIs',
    `short_description_en` = 'Connect your systems and automate processes between platforms.',
    `short_description_es` = 'Conecte sus sistemas y automatice procesos entre plataformas.'
WHERE `slug` = 'integracoes-apis';

-- Automações
UPDATE `services` SET
    `title_en` = 'Automations',
    `title_es` = 'Automatizaciones',
    `short_description_en` = 'Automate repetitive processes and increase productivity.',
    `short_description_es` = 'Automatice procesos repetitivos y aumente la productividad.'
WHERE `slug` = 'automacoes';

-- Dashboards & BI
UPDATE `services` SET
    `title_en` = 'Dashboards & BI',
    `title_es` = 'Dashboards & BI',
    `short_description_en` = 'Control panels and business intelligence for decision making.',
    `short_description_es` = 'Paneles de control e inteligencia de negocios para toma de decisiones.'
WHERE `slug` = 'dashboards-bi';

-- Aplicações Móveis
UPDATE `services` SET
    `title_en` = 'Mobile Applications',
    `title_es` = 'Aplicaciones Móviles',
    `short_description_en` = 'Native and hybrid apps for iOS and Android.',
    `short_description_es` = 'Apps nativas e híbridas para iOS y Android.'
WHERE `slug` = 'aplicacoes-moveis';

-- SaaS
UPDATE `services` SET
    `title_en` = 'SaaS',
    `title_es` = 'SaaS',
    `short_description_en` = 'Scalable and multi-tenant SaaS platforms.',
    `short_description_es` = 'Plataformas SaaS escalables y multi-tenant.'
WHERE `slug` = 'saas';

-- Inteligência Artificial
UPDATE `services` SET
    `title_en` = 'Artificial Intelligence',
    `title_es` = 'Inteligencia Artificial',
    `short_description_en` = 'Solutions with AI, machine learning and intelligent chatbots.',
    `short_description_es` = 'Soluciones con IA, machine learning y chatbots inteligentes.'
WHERE `slug` = 'inteligencia-artificial';

-- Consultoria
UPDATE `services` SET
    `title_en` = 'Consulting',
    `title_es` = 'Consultoría',
    `short_description_en` = 'Technology consulting for digital transformation.',
    `short_description_es` = 'Consultoría tecnológica para transformación digital.'
WHERE `slug` = 'consultoria';
