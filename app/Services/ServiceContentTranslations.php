<?php

namespace App\Services;

/**
 * Traduções dos conteúdos de serviços para EN e ES.
 */
class ServiceContentTranslations
{
    public static function getEnglishFeatures(string $slug): ?array
    {
        $features = [
            'sistemas-web' => ["Complete admin panels", "User and permission management", "Documented RESTful APIs", "Integrations with external systems", "Dynamic reports and export", "Real-time notifications", "Multi-language and multi-currency", "Automatic data backup", "Continuous deploy (CI/CD)", "Complete technical documentation", "Post-delivery support and maintenance", "Horizontal scalability"],
            'crm' => ["Contact and company management", "Visual sales pipeline (Kanban)", "Email and follow-up automation", "Complete interaction history", "Task scheduling and reminders", "Real-time reports and dashboards", "WhatsApp and email integration", "Proposal and quote management", "Advanced client segmentation", "Data import/export", "API for external integrations", "User and team permissions"],
            'erp-personalizado' => ["Complete financial module", "Stock and inventory management", "Purchasing and supplier control", "Sales and order management", "Production/manufacturing module", "HR and payroll management", "Advanced management reports", "Workflows and approvals", "Multi-company and branches", "Tax invoices and SEFAZ integration", "Executive dashboard", "Granular access control"],
            'integracoes-apis' => ["Documented RESTful APIs", "WhatsApp Business integrations", "Payment gateways (Stripe, PagSeguro, Pix)", "Marketplace integration", "Webhooks and real-time events", "Data synchronization between systems", "Asynchronous processing queues", "Integration logs and monitoring", "Automatic retry on failure", "Swagger/OpenAPI documentation", "Rate limiting and security", "API versioning"],
            'automacoes' => ["Email and notification automation", "Visual workflows (drag and drop)", "Event-based triggers", "Report automation", "Integration with existing tools", "Recurring task scheduling", "Batch processing", "Smart alerts and notifications", "Execution logs and auditing", "Social media automation", "Chatbots and automatic responses", "RPA (Robotic Process Automation)"],
            'dashboards-bi' => ["Real-time dashboards", "Custom KPIs and indicators", "Interactive charts and drill-down", "Automated reports (PDF/Excel)", "Goal alerts and notifications", "Integration with multiple data sources", "Dynamic filters and segmentation", "Sharing and permissions", "Mobile-friendly visualization", "ETL and data processing", "Forecasts and trends", "Multi-format export"],
            'aplicativos-mobile' => ["iOS and Android apps", "React Native (cross-platform)", "Flutter for high performance", "Push notifications", "Geolocation and maps", "In-app payments", "Camera and media", "Offline storage", "Biometric authentication", "App Store/Play Store publishing", "Usage analytics and metrics", "OTA (Over-the-Air) updates"],
            'saas' => ["Multi-tenant architecture", "Billing and subscription system", "Automated onboarding", "Client panel (self-service)", "Documented public API", "Webhooks and integrations", "Plan and permission management", "SaaS metrics (MRR, Churn, LTV)", "Customizable white-label", "SSO and enterprise authentication", "Horizontal scalability", "Monitoring and alerts"],
            'inteligencia-artificial' => ["Chatbots with generative AI", "Natural Language Processing (NLP)", "Predictive analysis and forecasting", "Automatic classification and categorization", "Personalized recommendations", "Computer vision", "Sentiment analysis", "AI content generation", "OCR and data extraction", "OpenAI/GPT integration", "Custom models", "Training with your own data"],
            'chatbots' => ["Advanced conversational AI", "WhatsApp Business integration", "24/7 automated service", "Lead qualification", "Transfer to human agent", "Conversation history", "Document-based responses", "Automatic multi-language", "Conversation analytics", "Segment personalization", "CRM integration", "Company data training"],
            'machine-learning' => ["Custom predictive models", "Classification and clustering", "Recommendation systems", "Anomaly and fraud detection", "Natural language processing", "Time series and forecasting", "Feature engineering", "Model validation and monitoring", "Model A/B testing", "Automated data pipeline", "Production model deploy", "Automatic retraining"],
            'consultoria' => ["Complete technology diagnosis", "Process mapping (AS-IS/TO-BE)", "Digital transformation roadmap", "Solution architecture", "Technology selection", "Technical due diligence", "Code review and audit", "Performance optimization", "Scalability planning", "Technical mentoring for teams", "Project management (PMO)", "Technical feasibility analysis"],
            'performance' => ["Load testing and benchmarks", "Database optimization", "Intelligent cache strategies", "CDN and static assets", "Code minification and compression", "Lazy loading and prefetch", "Backend monitoring (APM)", "Infrastructure auto-scaling", "Image and media optimization", "Slow query analysis", "Horizontal and vertical scaling", "SLA of 99.9% uptime"],
            'infraestrutura' => ["Cloud architecture (AWS/GCP/Azure)", "Docker and Kubernetes", "CI/CD pipelines", "Infrastructure as Code (Terraform)", "Monitoring and observability", "Automatic backups", "Load balancing", "Automatic scaling", "Security and firewalls", "SSL/TLS certificates", "Staging environments", "24/7 technical support"],
        ];
        return $features[$slug] ?? null;
    }

    public static function getSpanishFeatures(string $slug): ?array
    {
        $features = [
            'sistemas-web' => ["Paneles administrativos completos", "Gestión de usuarios y permisos", "APIs RESTful documentadas", "Integraciones con sistemas externos", "Informes dinámicos y exportación", "Notificaciones en tiempo real", "Multi-idioma y multi-moneda", "Backup automático de datos", "Deploy continuo (CI/CD)", "Documentación técnica completa", "Soporte y mantenimiento post-entrega", "Escalabilidad horizontal"],
            'crm' => ["Gestión de contactos y empresas", "Pipeline de ventas visual (Kanban)", "Automatización de emails y follow-ups", "Historial completo de interacciones", "Agendamiento de tareas y recordatorios", "Informes y dashboards en tiempo real", "Integración con WhatsApp y email", "Gestión de propuestas y presupuestos", "Segmentación avanzada de clientes", "Importación/exportación de datos", "API para integraciones externas", "Permisos por usuario y equipo"],
            'erp-personalizado' => ["Módulo financiero completo", "Gestión de inventario", "Control de compras y proveedores", "Gestión de ventas y pedidos", "Módulo de producción/manufactura", "Gestión de RRHH y nómina", "Informes gerenciales avanzados", "Workflows y aprobaciones", "Multi-empresa y sucursales", "Facturación electrónica", "Dashboard ejecutivo", "Control de accesos granular"],
            'integracoes-apis' => ["APIs RESTful documentadas", "Integraciones con WhatsApp Business", "Pasarelas de pago (Stripe, PagSeguro, Pix)", "Integración con marketplaces", "Webhooks y eventos en tiempo real", "Sincronización de datos entre sistemas", "Colas de procesamiento asíncrono", "Logs y monitoreo de integraciones", "Retry automático en caso de falla", "Documentación Swagger/OpenAPI", "Rate limiting y seguridad", "Versionado de APIs"],
            'automacoes' => ["Automatización de emails y notificaciones", "Workflows visuales (drag and drop)", "Triggers basados en eventos", "Automatización de informes", "Integración con herramientas existentes", "Programación de tareas recurrentes", "Procesamiento en lote", "Alertas y notificaciones inteligentes", "Logs y auditoría de ejecuciones", "Automatización de redes sociales", "Chatbots y respuestas automáticas", "RPA (Automatización Robótica de Procesos)"],
            'dashboards-bi' => ["Dashboards en tiempo real", "KPIs e indicadores personalizados", "Gráficos interactivos y drill-down", "Informes automatizados (PDF/Excel)", "Alertas y notificaciones de metas", "Integración con múltiples fuentes de datos", "Filtros dinámicos y segmentación", "Compartir y permisos", "Visualización mobile-friendly", "ETL y procesamiento de datos", "Previsiones y tendencias", "Exportación en múltiples formatos"],
            'aplicativos-mobile' => ["Apps para iOS y Android", "React Native (multiplataforma)", "Flutter para alto rendimiento", "Push notifications", "Geolocalización y mapas", "Pagos in-app", "Cámara y multimedia", "Almacenamiento offline", "Autenticación biométrica", "Publicación en App Store/Play Store", "Analytics y métricas de uso", "Actualizaciones OTA (Over-the-Air)"],
            'saas' => ["Arquitectura multi-tenant", "Sistema de facturación y suscripciones", "Onboarding automatizado", "Panel del cliente (self-service)", "API pública documentada", "Webhooks e integraciones", "Gestión de planes y permisos", "Métricas SaaS (MRR, Churn, LTV)", "White-label personalizable", "SSO y autenticación enterprise", "Escalabilidad horizontal", "Monitoreo y alertas"],
            'inteligencia-artificial' => ["Chatbots con IA generativa", "Procesamiento de Lenguaje Natural (NLP)", "Análisis predictivo y forecasting", "Clasificación y categorización automática", "Recomendaciones personalizadas", "Visión computacional", "Análisis de sentimiento", "Generación de contenido con IA", "OCR y extracción de datos", "Integración con OpenAI/GPT", "Modelos personalizados", "Entrenamiento con datos propios"],
            'chatbots' => ["IA conversacional avanzada", "Integración con WhatsApp Business", "Atención 24/7 automatizada", "Calificación de leads", "Transferencia a agente humano", "Historial de conversaciones", "Respuestas basadas en documentos", "Multi-idioma automático", "Analytics de conversaciones", "Personalización por segmento", "Integración con CRM", "Entrenamiento con datos de la empresa"],
            'machine-learning' => ["Modelos predictivos personalizados", "Clasificación y clustering", "Sistemas de recomendación", "Detección de anomalías y fraudes", "Procesamiento de lenguaje natural", "Series temporales y forecasting", "Feature engineering", "Validación y monitoreo de modelos", "A/B testing de modelos", "Pipeline de datos automatizado", "Deploy de modelos en producción", "Reentrenamiento automático"],
            'consultoria' => ["Diagnóstico tecnológico completo", "Mapeo de procesos (AS-IS/TO-BE)", "Roadmap de transformación digital", "Arquitectura de soluciones", "Selección de tecnologías", "Due diligence técnica", "Code review y auditoría", "Optimización de rendimiento", "Planificación de escalabilidad", "Mentoría técnica para equipos", "Gestión de proyectos (PMO)", "Análisis de viabilidad técnica"],
            'performance' => ["Pruebas de carga y benchmarks", "Optimización de base de datos", "Estrategias de caché inteligente", "CDN y assets estáticos", "Minificación y compresión de código", "Lazy loading y prefetch", "Monitoreo backend (APM)", "Auto-scaling de infraestructura", "Optimización de imágenes y medios", "Análisis de queries lentos", "Escalamiento horizontal y vertical", "SLA de 99.9% uptime"],
            'infraestrutura' => ["Arquitectura cloud (AWS/GCP/Azure)", "Docker y Kubernetes", "Pipelines CI/CD", "Infraestructura como Código (Terraform)", "Monitoreo y observabilidad", "Backups automáticos", "Balanceo de carga", "Escalamiento automático", "Seguridad y firewalls", "Certificados SSL/TLS", "Ambientes de staging", "Soporte técnico 24/7"],
        ];
        return $features[$slug] ?? null;
    }

    public static function getEnglish(string $slug): ?string
    {
        $content = [
            'sistemas-web' => '<h2>Custom Web Systems</h2>
<p>We develop complete and scalable web systems, from corporate platforms to complex SaaS applications. Each project is built with modern architecture, focusing on performance, security and future growth.</p>

<h2>How We Work</h2>
<p>Our process starts with a deep analysis of your business. We map processes, identify bottlenecks and propose solutions that truly solve problems. We don\'t just deliver code — we deliver a tool that transforms your company\'s operations.</p>

<h3>Scalable Architecture</h3>
<p>Systems built to grow with your business. We use microservices, intelligent caching and cloud infrastructure to ensure your application supports thousands of simultaneous users.</p>

<h3>Modern and Responsive Interface</h3>
<p>User experience is a priority. Intuitive, fast interfaces that work perfectly on any device — desktop, tablet or smartphone.</p>

<h3>Cutting-edge Security</h3>
<p>Robust authentication, data encryption, attack protection and automatic backups. Your data and your clients\' data are always protected.</p>',

            'crm' => '<h2>What is a CRM?</h2>
<p>CRM (Customer Relationship Management) is a client relationship management system that centralizes all interactions, communication history, negotiations and contact data in one place.</p>
<p>At ON Solutions, we develop custom CRMs that perfectly adapt to your company\'s workflow, eliminating manual processes and ensuring no opportunity is lost.</p>

<h2>Why invest in a custom CRM?</h2>
<p>Unlike generic solutions, a custom CRM is built to meet exactly your business needs. No unnecessary features or plan limitations — you get exactly what you need, with full control over data.</p>

<h3>Complete Sales Funnel Management</h3>
<p>Track every opportunity from first contact to closing. See which stage each deal is at, set automated actions for each stage and never lose a sale due to lack of follow-up.</p>

<h3>Follow-up Automation</h3>
<p>Set up automatic reminders, scheduled emails and notifications for your team. The system works for you, ensuring each client receives the right attention at the right time.</p>

<h3>Real-time Reports and Metrics</h3>
<p>Interactive dashboards show team performance, conversion rate, average ticket, sales cycle time and more. Make decisions based on real data.</p>

<h3>Integration with Your Tools</h3>
<p>Connect your CRM with WhatsApp, email, phone, social media and other tools your team already uses. All interactions centralized in one place.</p>',

            'erp-personalizado' => '<h2>Custom ERP for Your Company</h2>
<p>A custom ERP (Enterprise Resource Planning) integrates all departments of your company into a single platform. Finance, inventory, purchasing, sales, production and HR — all connected and working in harmony.</p>

<h2>Advantages of a Custom ERP</h2>
<p>Generic ERP systems force your company to adapt to the software. With a custom ERP, the software adapts to your business, respecting your processes and enhancing your differentials.</p>

<h3>Integrated Modules</h3>
<p>Finance, inventory, purchasing, sales, production, HR — all modules communicate in real time. A sale automatically updates inventory, generates financials and feeds management reports.</p>

<h3>Custom Workflows</h3>
<p>Define approvals, notifications and automated actions for each process in your company. The system follows your business rules, not the other way around.</p>',

            'integracoes-apis' => '<h2>Connect Your Systems</h2>
<p>Integrations and APIs allow your systems to communicate automatically and securely. We eliminate manual work of transferring data between platforms and ensure all your tools work in sync.</p>

<h2>What We Do</h2>
<p>We develop robust APIs, create integrations with existing platforms and automate data flows between systems. From ERPs to e-commerce, from CRMs to payment platforms — we connect everything.</p>

<h3>RESTful and GraphQL APIs</h3>
<p>We create well-documented, secure and high-performance APIs that allow any system to communicate with yours in a standardized way.</p>

<h3>Integrations with Popular Platforms</h3>
<p>WhatsApp Business API, payment gateways, marketplaces, ERPs, email marketing platforms, social networks and much more.</p>',

            'automacoes' => '<h2>Automate Repetitive Processes</h2>
<p>Automation eliminates manual tasks, reduces human errors and frees your team to focus on what really matters. We identify repetitive processes in your business and create solutions that work 24/7 for you.</p>

<h2>Where Automation Applies</h2>
<p>From sending emails to generating reports, from stock updates to notification triggers — any repetitive process can be automated for speed and precision.</p>

<h3>Marketing Automation</h3>
<p>Email sequences, lead segmentation, contact nurturing and personalized triggers based on user behavior.</p>

<h3>Operational Automation</h3>
<p>Automatic document generation, spreadsheet updates, data synchronization between systems and smart alerts.</p>',

            'inteligencia-artificial' => '<h2>AI Applied to Your Business</h2>
<p>Artificial Intelligence is no longer the future — it\'s the present. We implement AI solutions that solve real problems: intelligent chatbots, predictive analysis, natural language processing and computer vision.</p>

<h2>Practical AI Solutions</h2>
<p>We don\'t work with hype — we work with results. Each AI solution is implemented to solve a specific problem in your business, with clear success metrics.</p>

<h3>Chatbots and Virtual Assistants</h3>
<p>24/7 service, lead qualification, customer support and conversational process automation with generative AI.</p>

<h3>Predictive Analysis</h3>
<p>Sales forecasting, churn detection, lead scoring and process optimization based on historical patterns.</p>',

            'consultoria' => '<h2>Strategic Technology Consulting</h2>
<p>Sometimes the solution isn\'t building something new. Sometimes what your company needs is a specialized perspective to identify opportunities, solve bottlenecks and chart the best path for digital transformation.</p>

<h2>How We Help</h2>
<p>We analyze your current scenario, map processes, identify inefficiencies and propose practical solutions — whether technical, procedural or strategic.</p>

<h3>Technology Diagnosis</h3>
<p>We evaluate your current infrastructure, systems and processes to identify improvement points and optimization opportunities.</p>

<h3>Digital Transformation Roadmap</h3>
<p>We create a practical, prioritized plan to modernize your operation, with clear milestones and estimated ROI for each stage.</p>',
        ];

        return $content[$slug] ?? null;
    }

    public static function getSpanish(string $slug): ?string
    {
        $content = [
            'sistemas-web' => '<h2>Sistemas Web a Medida</h2>
<p>Desarrollamos sistemas web completos y escalables, desde plataformas corporativas hasta aplicaciones SaaS complejas. Cada proyecto se construye con arquitectura moderna, pensando en rendimiento, seguridad y crecimiento futuro.</p>

<h2>Cómo Trabajamos</h2>
<p>Nuestro proceso comienza con un análisis profundo de su negocio. Mapeamos procesos, identificamos cuellos de botella y proponemos soluciones que realmente resuelven problemas. No entregamos solo código — entregamos una herramienta que transforma la operación de su empresa.</p>

<h3>Arquitectura Escalable</h3>
<p>Sistemas preparados para crecer con su negocio. Utilizamos microservicios, caché inteligente e infraestructura cloud para garantizar que su aplicación soporte miles de usuarios simultáneos.</p>

<h3>Interfaz Moderna y Responsiva</h3>
<p>La experiencia del usuario es prioridad. Interfaces intuitivas, rápidas y que funcionan perfectamente en cualquier dispositivo — desktop, tablet o smartphone.</p>

<h3>Seguridad de Punta</h3>
<p>Autenticación robusta, criptografía de datos, protección contra ataques y backups automáticos. Sus datos y los datos de sus clientes están siempre protegidos.</p>',

            'crm' => '<h2>¿Qué es un CRM?</h2>
<p>CRM (Customer Relationship Management) es un sistema de gestión del relacionamiento con clientes que centraliza todas las interacciones, historial de comunicaciones, negociaciones y datos de sus contactos en un solo lugar.</p>
<p>En ON Solutions, desarrollamos CRMs personalizados que se adaptan perfectamente al flujo de trabajo de su empresa, eliminando procesos manuales y garantizando que ninguna oportunidad se pierda.</p>

<h2>¿Por qué invertir en un CRM personalizado?</h2>
<p>A diferencia de soluciones genéricas, un CRM a medida se construye para atender exactamente las necesidades de su negocio. No hay funcionalidades innecesarias ni limitaciones de planes — usted tiene exactamente lo que necesita, con control total sobre los datos.</p>

<h3>Gestión Completa del Embudo de Ventas</h3>
<p>Acompañe cada oportunidad desde el primer contacto hasta el cierre. Visualice en qué etapa se encuentra cada negociación, defina acciones automáticas para cada etapa y nunca más pierda una venta por falta de seguimiento.</p>

<h3>Automatización de Follow-ups</h3>
<p>Configure recordatorios automáticos, envío de emails programados y notificaciones para su equipo. El sistema trabaja por usted, garantizando que cada cliente reciba la atención necesaria en el momento correcto.</p>

<h3>Informes y Métricas en Tiempo Real</h3>
<p>Dashboards interactivos muestran el rendimiento del equipo, tasa de conversión, ticket promedio, tiempo de ciclo de ventas y mucho más. Tome decisiones basadas en datos reales.</p>

<h3>Integración con sus Herramientas</h3>
<p>Conecte su CRM con WhatsApp, email, telefonía, redes sociales y otras herramientas que su equipo ya utiliza. Todas las interacciones centralizadas en un solo lugar.</p>',

            'erp-personalizado' => '<h2>ERP a Medida para su Empresa</h2>
<p>Un ERP (Enterprise Resource Planning) personalizado integra todos los departamentos de su empresa en una única plataforma. Finanzas, inventario, compras, ventas, producción y RRHH — todo conectado y funcionando en armonía.</p>

<h2>Ventajas de un ERP Personalizado</h2>
<p>Sistemas ERP genéricos obligan a su empresa a adaptarse al software. Con un ERP a medida, el software se adapta a su negocio, respetando sus procesos y potenciando sus diferenciales.</p>

<h3>Módulos Integrados</h3>
<p>Finanzas, inventario, compras, ventas, producción, RRHH — todos los módulos se comunican en tiempo real. Una venta actualiza automáticamente el inventario, genera el financiero y alimenta los informes gerenciales.</p>

<h3>Workflows Personalizados</h3>
<p>Defina aprobaciones, notificaciones y acciones automáticas para cada proceso de su empresa. El sistema sigue las reglas de su negocio, no al revés.</p>',

            'integracoes-apis' => '<h2>Conecte sus Sistemas</h2>
<p>Integraciones y APIs permiten que sus sistemas se comuniquen de forma automática y segura. Eliminamos el trabajo manual de transferir datos entre plataformas y garantizamos que todas sus herramientas funcionen en sincronía.</p>

<h2>Qué Hacemos</h2>
<p>Desarrollamos APIs robustas, creamos integraciones con plataformas existentes y automatizamos flujos de datos entre sistemas. De ERPs a e-commerces, de CRMs a plataformas de pago — conectamos todo.</p>

<h3>APIs RESTful y GraphQL</h3>
<p>Creamos APIs bien documentadas, seguras y de alto rendimiento que permiten que cualquier sistema se comunique con el suyo de forma estandarizada.</p>

<h3>Integraciones con Plataformas Populares</h3>
<p>WhatsApp Business API, pasarelas de pago, marketplaces, ERPs, plataformas de email marketing, redes sociales y mucho más.</p>',

            'automacoes' => '<h2>Automatice Procesos Repetitivos</h2>
<p>La automatización elimina tareas manuales, reduce errores humanos y libera a su equipo para enfocarse en lo que realmente importa. Identificamos procesos repetitivos en su negocio y creamos soluciones que trabajan 24/7 por usted.</p>

<h2>Dónde se Aplica la Automatización</h2>
<p>Desde envío de emails hasta generación de informes, desde actualización de inventario hasta disparo de notificaciones — cualquier proceso repetitivo puede ser automatizado para ganar velocidad y precisión.</p>

<h3>Automatización de Marketing</h3>
<p>Secuencias de emails, segmentación de leads, nutrición de contactos y disparos personalizados basados en comportamiento del usuario.</p>

<h3>Automatización Operacional</h3>
<p>Generación automática de documentos, actualización de planillas, sincronización de datos entre sistemas y alertas inteligentes.</p>',

            'inteligencia-artificial' => '<h2>IA Aplicada a su Negocio</h2>
<p>La Inteligencia Artificial ya no es futuro — es presente. Implementamos soluciones de IA que resuelven problemas reales: chatbots inteligentes, análisis predictivo, procesamiento de lenguaje natural y visión computacional.</p>

<h2>Soluciones Prácticas con IA</h2>
<p>No trabajamos con hype — trabajamos con resultados. Cada solución de IA se implementa para resolver un problema específico de su negocio, con métricas claras de éxito.</p>

<h3>Chatbots y Asistentes Virtuales</h3>
<p>Atención 24/7, calificación de leads, soporte al cliente y automatización de procesos conversacionales con IA generativa.</p>

<h3>Análisis Predictivo</h3>
<p>Previsión de ventas, detección de churn, scoring de leads y optimización de procesos basada en patrones históricos.</p>',

            'consultoria' => '<h2>Consultoría Tecnológica Estratégica</h2>
<p>A veces la solución no es construir algo nuevo. A veces lo que su empresa necesita es una mirada especializada para identificar oportunidades, resolver cuellos de botella y trazar el mejor camino para la transformación digital.</p>

<h2>Cómo Ayudamos</h2>
<p>Analizamos su escenario actual, mapeamos procesos, identificamos ineficiencias y proponemos soluciones prácticas — ya sean técnicas, de procesos o estratégicas.</p>

<h3>Diagnóstico Tecnológico</h3>
<p>Evaluamos su infraestructura, sistemas y procesos actuales para identificar puntos de mejora y oportunidades de optimización.</p>

<h3>Roadmap de Transformación Digital</h3>
<p>Creamos un plan práctico y priorizado para modernizar su operación, con hitos claros y ROI estimado para cada etapa.</p>',
        ];

        return $content[$slug] ?? null;
    }
}
