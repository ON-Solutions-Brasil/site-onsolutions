# Arquitetura do Sistema - On Solutions

## Visão Geral

Sistema PHP 8+ com arquitetura MVC personalizada, sem frameworks.

## Fluxo de Requisição

```
Requisição HTTP
    │
    ├── .htaccess (raiz) → rewrite para public/index.php
    │
    ├── public/index.php (Front Controller)
    │   ├── config/bootstrap.php
    │   │   ├── Autoload (Composer PSR-4)
    │   │   ├── Database Singleton
    │   │   ├── Settings (do banco)
    │   │   └── Session
    │   │
    │   ├── Router → carregar rotas (web.php, admin.php, api.php)
    │   │
    │   └── Dispatch
    │       ├── Detectar idioma (URL prefix)
    │       ├── Executar Middlewares
    │       └── Controller@action
    │           └── View (com Layout)
```

## Estrutura de Diretórios

| Diretório | Propósito |
|-----------|-----------|
| `app/Core/` | Classes fundamentais: Database, Router, Controller, Model, Settings |
| `app/Controllers/` | Controllers organizados por módulo (Site, Admin, Auth, Api) |
| `app/Models/` | Models para acesso a dados |
| `app/Services/` | Serviços: Email, AI |
| `app/Middlewares/` | Auth, Permission, RateLimit, ApiAuth |
| `app/helpers/` | Funções globais |
| `app/views/` | Templates PHP organizados por módulo |
| `config/` | Configurações estáticas (database, app) |
| `routes/` | Definição de rotas |
| `public/` | Pasta pública (assets, uploads) |
| `storage/` | Armazenamento privado (logs, cache, backups) |
| `database/sql/` | Scripts SQL versionados |
| `lang/` | Traduções (pt, en, es) |

## Padrões de Design

### Singleton
- `Database`: Conexão única PDO
- `Settings`: Cache de configurações do banco

### MVC
- **Model**: Herda de `App\Core\Model`, CRUD genérico + queries específicas
- **View**: Templates PHP com layouts e partials
- **Controller**: Herda de `App\Core\Controller`, renderiza views ou JSON

### Repository Pattern
- Controllers acessam banco via Models ou diretamente via Database

## Segurança

| Proteção | Implementação |
|----------|---------------|
| SQL Injection | Prepared Statements (PDO) |
| XSS | `htmlspecialchars()` via helper `e()` |
| CSRF | Token em sessão, validado em POST |
| Brute Force | Rate Limiting + Lock de conta |
| Session Hijacking | Regeneração periódica de ID |
| Password | bcrypt com cost 12 |

## Sistema Multilíngue

- Detecção via prefixo URL: `/en/`, `/es/`
- Arquivos de tradução em `lang/{idioma}/messages.php`
- Função global `__('chave.subchave')`
- Conteúdo do banco com campos `_pt`, `_en`, `_es`

## Banco de Dados

- Sem migrations automáticas
- Scripts SQL numerados sequencialmente
- Nunca editar scripts antigos
- Cada alteração = novo arquivo

## API

- Prefix: `/api/v1/`
- Autenticação: Bearer Token
- Formato: JSON
- Tabela `api_tokens` para gerenciamento
