# On Solutions - Site Institucional & Painel Administrativo

Sistema completo desenvolvido em PHP 8+ com arquitetura MVC pura para a **On Solutions**, empresa especializada em desenvolvimento de software sob medida, integrações, automações e inteligência artificial.

## Stack Tecnológica

- **PHP 8+** (sem frameworks)
- **MySQL 8+**
- **Bootstrap 5**
- **JavaScript Vanilla**
- **Composer** (autoload + PHPMailer)
- **Arquitetura MVC** personalizada

## Estrutura do Projeto

```
/
├── app/
│   ├── controllers/      # Controllers da aplicação
│   ├── models/           # Models (acesso a dados)
│   ├── views/            # Views (templates)
│   │   ├── layouts/      # Layouts base (site, admin, auth)
│   │   ├── site/         # Views do site institucional
│   │   ├── admin/        # Views do painel administrativo
│   │   ├── auth/         # Views de autenticação
│   │   └── errors/       # Páginas de erro (404, 500, etc.)
│   ├── helpers/          # Funções auxiliares
│   ├── middlewares/      # Middlewares (auth, permission, csrf)
│   ├── services/         # Serviços (email, IA, backup, etc.)
│   └── repositories/    # Repositórios de dados
├── config/               # Configurações da aplicação
├── database/
│   └── sql/              # Scripts SQL numerados
├── docs/                 # Documentação técnica
├── lang/                 # Traduções (pt, en, es)
│   ├── pt/
│   ├── en/
│   └── es/
├── public/               # Pasta pública (DocumentRoot)
│   ├── assets/           # CSS, JS, imagens, fontes
│   ├── uploads/          # Uploads públicos
│   └── index.php         # Front controller
├── routes/               # Definição de rotas
├── storage/              # Armazenamento privado
│   ├── logs/
│   ├── cache/
│   ├── backups/
│   └── uploads/
├── vendor/               # Dependências (Composer)
├── .htaccess             # Rewrite rules
├── index.php             # Entry point raiz
└── composer.json         # Dependências PHP
```

## Requisitos

- PHP 8.0+
- MySQL 8.0+
- Apache com mod_rewrite habilitado
- Composer
- Extensões PHP: pdo_mysql, mbstring, openssl, curl, gd, json, fileinfo

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/on-solutions/site-onsolutions.git
cd site-onsolutions
```

2. Instale as dependências:
```bash
composer install
```

3. Execute os scripts SQL em ordem no banco de dados:
```bash
# Execute cada arquivo da pasta database/sql/ em ordem numérica
mysql -u usuario -p banco_de_dados < database/sql/001_create_tables.sql
mysql -u usuario -p banco_de_dados < database/sql/002_create_blog.sql
# ... e assim por diante
```

4. Configure o arquivo `config/database.php` com as credenciais do banco.

5. Acesse o sistema e faça login com o super administrador padrão:
   - **Email:** admin@onsolutions.com.br
   - **Senha:** OnSolutions@2024!

6. Acesse **Configurações** no painel administrativo e configure:
   - SMTP
   - WhatsApp
   - APIs de IA
   - Google Analytics
   - Informações gerais

## Funcionalidades

### Site Institucional
- Homepage premium com múltiplas seções
- Páginas de serviços individuais
- Blog com geração automática por IA
- Portfólio com cases de sucesso
- Chatbot flutuante com IA
- Botão WhatsApp
- Multilíngue (PT, EN, ES)
- SEO completo (Schema.org, Open Graph, Sitemap)
- Páginas legais (LGPD, Privacidade, Termos, Cookies)

### Painel Administrativo
- Dashboard com métricas
- CRM (clientes, funil, histórico)
- Projetos (equipe, prazos, arquivos)
- Orçamentos (PDF, assinatura digital)
- Financeiro (receitas, despesas, fluxo de caixa)
- Blog (CRUD + geração por IA)
- Portfólio (cases, tecnologias, resultados)
- Newsletter (cadastros, exportação)
- Configurações gerais (SMTP, APIs, integrações)
- Sistema de permissões por perfil
- Logs de atividade
- Backup manual e automático
- Versionamento interno
- Assistente IA integrado
- CMS (criação de páginas dinâmicas)

### Perfis de Usuário
- Super Administrador
- Administrador
- Editor
- Comercial
- Financeiro
- Marketing
- Desenvolvedor

## Segurança

- Proteção CSRF em todos os formulários
- Sanitização contra XSS
- Prepared statements (SQL Injection)
- Bcrypt para hash de senhas
- Rate limiting em login
- Sessões seguras com regeneração de ID
- Logs de acesso e alterações

## Multilíngue

O sistema suporta três idiomas:
- 🇧🇷 Português (padrão)
- 🇺🇸 Inglês
- 🇪🇸 Espanhol

A troca de idioma é feita via URL prefix (`/en/`, `/es/`) ou seletor no site.

## Licença

Propriedade de **On Solutions**. Todos os direitos reservados.

## Parceria

Desenvolvido em parceria com **LRV Web** - [lrvweb.com.br](https://lrvweb.com.br)
