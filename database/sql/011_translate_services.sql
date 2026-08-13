-- ============================================================
-- ON Solutions - Script SQL #011
-- Tradução dos serviços para EN e ES (short_description)
-- ============================================================

-- Sistemas Web
UPDATE `services` SET
    `short_description_en` = 'Development of complete and scalable web systems for your company.',
    `short_description_es` = 'Desarrollo de sistemas web completos y escalables para su empresa.'
WHERE `slug` = 'sistemas-web';

-- ERP Personalizado
UPDATE `services` SET
    `short_description_en` = 'Custom enterprise management systems developed to fit your business.',
    `short_description_es` = 'Sistemas de gestión empresarial desarrollados a medida para su negocio.'
WHERE `slug` = 'erp-personalizado';

-- CRM
UPDATE `services` SET
    `short_description_en` = 'Complete management of your client relationships.',
    `short_description_es` = 'Gestión completa del relacionamiento con sus clientes.'
WHERE `slug` = 'crm';

-- Integrações & APIs
UPDATE `services` SET
    `short_description_en` = 'Connect your systems and automate processes between platforms.',
    `short_description_es` = 'Conecte sus sistemas y automatice procesos entre plataformas.'
WHERE `slug` = 'integracoes-apis';

-- Automações
UPDATE `services` SET
    `short_description_en` = 'Automate repetitive processes and increase productivity.',
    `short_description_es` = 'Automatice procesos repetitivos y aumente la productividad.'
WHERE `slug` = 'automacoes';

-- Dashboards & BI
UPDATE `services` SET
    `short_description_en` = 'Control panels and business intelligence for decision making.',
    `short_description_es` = 'Paneles de control e inteligencia de negocios para toma de decisiones.'
WHERE `slug` = 'dashboards-bi';

-- Aplicativos Mobile
UPDATE `services` SET
    `short_description_en` = 'Native and hybrid apps for iOS and Android.',
    `short_description_es` = 'Apps nativos e híbridos para iOS y Android.'
WHERE `slug` = 'aplicativos-mobile';

-- SaaS
UPDATE `services` SET
    `short_description_en` = 'Scalable and multi-tenant SaaS platforms.',
    `short_description_es` = 'Plataformas SaaS escalables y multi-tenant.'
WHERE `slug` = 'saas';

-- Inteligência Artificial
UPDATE `services` SET
    `short_description_en` = 'Solutions with AI, machine learning and intelligent chatbots.',
    `short_description_es` = 'Soluciones con IA, machine learning y chatbots inteligentes.'
WHERE `slug` = 'inteligencia-artificial';

-- Chatbots
UPDATE `services` SET
    `short_description_en` = 'Intelligent chatbots for customer service and sales.',
    `short_description_es` = 'Chatbots inteligentes para atención al cliente y ventas.'
WHERE `slug` = 'chatbots';

-- Machine Learning
UPDATE `services` SET
    `short_description_en` = 'Predictive models and advanced data analysis.',
    `short_description_es` = 'Modelos predictivos y análisis de datos avanzado.'
WHERE `slug` = 'machine-learning';

-- Consultoria
UPDATE `services` SET
    `short_description_en` = 'Technology consulting for digital transformation.',
    `short_description_es` = 'Consultoría tecnológica para transformación digital.'
WHERE `slug` = 'consultoria';

-- Performance
UPDATE `services` SET
    `short_description_en` = 'Performance optimization and system scalability.',
    `short_description_es` = 'Optimización de rendimiento y escalabilidad de sistemas.'
WHERE `slug` = 'performance';

-- Infraestrutura
UPDATE `services` SET
    `short_description_en` = 'Cloud computing, DevOps and scalable infrastructure.',
    `short_description_es` = 'Cloud computing, DevOps e infraestructura escalable.'
WHERE `slug` = 'infraestrutura';
