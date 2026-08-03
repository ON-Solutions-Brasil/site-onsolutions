# Guia de Instalação - On Solutions

## Requisitos

- PHP 8.0 ou superior
- MySQL 8.0 ou superior
- Apache com mod_rewrite habilitado
- Composer
- Extensões PHP: pdo_mysql, mbstring, openssl, curl, gd, json, fileinfo

## Passo a Passo

### 1. Clone o repositório

```bash
git clone https://github.com/on-solutions/site-onsolutions.git
cd site-onsolutions
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o banco de dados

Edite o arquivo `config/database.php` com suas credenciais:

```php
return [
    'host'     => 'localhost',
    'port'     => 3306,
    'database' => 'onsolutions_db',
    'username' => 'seu_usuario',
    'password' => 'sua_senha',
    'charset'  => 'utf8mb4',
];
```

### 4. Execute os scripts SQL

Execute os arquivos na ordem numérica:

```bash
mysql -u usuario -p onsolutions_db < database/sql/001_create_tables.sql
mysql -u usuario -p onsolutions_db < database/sql/002_create_blog.sql
mysql -u usuario -p onsolutions_db < database/sql/003_create_portfolio.sql
mysql -u usuario -p onsolutions_db < database/sql/004_create_crm.sql
mysql -u usuario -p onsolutions_db < database/sql/005_create_finance.sql
mysql -u usuario -p onsolutions_db < database/sql/006_create_newsletter.sql
mysql -u usuario -p onsolutions_db < database/sql/007_create_pages_cms.sql
mysql -u usuario -p onsolutions_db < database/sql/008_create_backup_versions.sql
```

### 5. Configure o Apache

O DocumentRoot pode apontar para:
- **Raiz do projeto:** O `.htaccess` da raiz redireciona para `public/index.php`
- **Pasta public:** Para maior segurança em produção

Certifique-se que `mod_rewrite` está habilitado:
```bash
a2enmod rewrite
```

### 6. Permissões

```bash
chmod -R 775 storage/
chmod -R 775 public/uploads/
```

### 7. Primeiro acesso

- URL: `http://seu-dominio/admin/login`
- Email: `admin@onsolutions.com.br`
- Senha: `OnSolutions@2024!`

**IMPORTANTE:** Altere a senha no primeiro acesso!

### 8. Configurações iniciais

Após login, acesse **Configurações** e configure:

1. **Geral:** Nome do site, URL base, contato
2. **SMTP:** Para envio de emails
3. **APIs de IA:** OpenAI, Gemini, Claude ou DeepSeek
4. **WhatsApp:** Número para botão flutuante
5. **Blog IA:** Geração automática de conteúdo

## Deploy em Produção

1. Altere `config/app.php`:
   - `'environment' => 'production'`
   - `'debug' => false`

2. No painel admin, configure a URL base correta

3. Configure HTTPS (SSL)

4. Configure cron para:
   - Backup automático
   - Geração de posts por IA
   - Limpeza de rate_limits
