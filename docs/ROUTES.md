# Documentação de Rotas

## Site Institucional (público)

| Método | Rota | Controller | Descrição |
|--------|------|-----------|-----------|
| GET | `/` | Site\HomeController@index | Homepage |
| GET | `/quem-somos` | Site\AboutController@index | Sobre |
| GET | `/servicos` | Site\ServicesController@index | Lista serviços |
| GET | `/servicos/{slug}` | Site\ServicesController@show | Serviço individual |
| GET | `/portfolio` | Site\PortfolioController@index | Portfólio |
| GET | `/portfolio/{slug}` | Site\PortfolioController@show | Item do portfólio |
| GET | `/blog` | Site\BlogController@index | Lista de posts |
| GET | `/blog/{slug}` | Site\BlogController@show | Post individual |
| GET | `/blog/categoria/{slug}` | Site\BlogController@category | Posts por categoria |
| GET | `/blog/tag/{slug}` | Site\BlogController@tag | Posts por tag |
| GET | `/contato` | Site\ContactController@index | Formulário de contato |
| POST | `/contato` | Site\ContactController@send | Enviar contato |
| GET | `/parceiros` | Site\PartnersController@index | Parceiros |
| GET | `/consultores` | Site\PartnersController@consultants | Consultores |
| POST | `/newsletter/subscribe` | Site\NewsletterController@subscribe | Inscrição |
| POST | `/chatbot/message` | Site\ChatbotController@message | Chat IA |
| GET | `/politica-de-privacidade` | Site\LegalController@privacy | Privacidade |
| GET | `/termos-de-uso` | Site\LegalController@terms | Termos |
| GET | `/politica-de-cookies` | Site\LegalController@cookies | Cookies |
| GET | `/lgpd` | Site\LegalController@lgpd | LGPD |
| GET | `/sitemap.xml` | Site\SeoController@sitemap | Sitemap |
| GET | `/robots.txt` | Site\SeoController@robots | Robots |
| GET | `/busca` | Site\SearchController@index | Busca |
| GET | `/{slug}` | Site\PageController@show | Página CMS |

## Autenticação

| Método | Rota | Controller | Descrição |
|--------|------|-----------|-----------|
| GET | `/admin/login` | Auth\LoginController@showForm | Formulário login |
| POST | `/admin/login` | Auth\LoginController@login | Processar login |
| GET | `/admin/logout` | Auth\LoginController@logout | Logout |
| GET | `/admin/forgot-password` | Auth\ForgotPasswordController@showForm | Esqueci senha |
| POST | `/admin/forgot-password` | Auth\ForgotPasswordController@sendReset | Enviar reset |
| GET | `/admin/reset-password/{token}` | Auth\ResetPasswordController@showForm | Nova senha |
| POST | `/admin/reset-password` | Auth\ResetPasswordController@reset | Processar reset |

## Painel Administrativo (autenticado)

Prefixo: `/admin/` - Requer AuthMiddleware

### Dashboard, Perfil, Configurações, Equipe, Blog, Portfólio, CRM, Projetos, Orçamentos, Financeiro, Newsletter, Páginas CMS, Logs, Backup, Versões, Assistente IA

Cada módulo segue o padrão CRUD:
- `GET /admin/{modulo}` - Lista
- `GET /admin/{modulo}/create` - Formulário criar
- `POST /admin/{modulo}` - Salvar novo
- `GET /admin/{modulo}/{id}` - Detalhe
- `GET /admin/{modulo}/{id}/edit` - Formulário editar
- `POST /admin/{modulo}/{id}` - Atualizar
- `POST /admin/{modulo}/{id}/delete` - Excluir

## API (v1)

Prefixo: `/api/v1/` - Requer Bearer Token

| Método | Rota | Descrição |
|--------|------|-----------|
| GET | `/api/v1/clients` | Listar clientes |
| GET | `/api/v1/clients/{id}` | Detalhe cliente |
| POST | `/api/v1/clients` | Criar cliente |
| PUT | `/api/v1/clients/{id}` | Atualizar cliente |
| DELETE | `/api/v1/clients/{id}` | Excluir cliente |
| GET | `/api/v1/projects` | Listar projetos |
| GET | `/api/v1/posts` | Listar posts |
| POST | `/api/v1/newsletter/subscribe` | Inscrever newsletter |
