<div class="page-header">
    <h1 class="page-title">Configurações</h1>
    <p class="page-subtitle">Gerencie todas as configurações do sistema</p>
</div>

<div class="row">
    <!-- Tabs laterais -->
    <div class="col-md-3">
        <div class="nav flex-column nav-pills settings-tabs" role="tablist">
            <button class="nav-link <?= ($tab ?? 'general') === 'general' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-general">
                <i class="bi bi-gear"></i> Geral
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'social' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-social">
                <i class="bi bi-share"></i> Redes Sociais
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'smtp' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-smtp">
                <i class="bi bi-envelope"></i> SMTP / Email
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'google' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-google">
                <i class="bi bi-graph-up"></i> Analytics / Tracking
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'ai' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-ai">
                <i class="bi bi-robot"></i> Inteligência Artificial
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'blog_ai' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-blog-ai">
                <i class="bi bi-journal-richtext"></i> Blog IA
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'language' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-language">
                <i class="bi bi-translate"></i> Idiomas
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'chatbot' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-chatbot">
                <i class="bi bi-chat-dots"></i> Chatbot
            </button>
            <button class="nav-link <?= ($tab ?? '') === 'whatsapp' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-whatsapp">
                <i class="bi bi-whatsapp"></i> WhatsApp
            </button>
        </div>
    </div>

    <!-- Conteúdo das tabs -->
    <div class="col-md-9">
        <div class="tab-content">
            <!-- Tab Geral -->
            <div class="tab-pane fade <?= ($tab ?? 'general') === 'general' ? 'show active' : '' ?>" id="tab-general">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Configurações Gerais</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>" enctype="multipart/form-data">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="general">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome do Site</label>
                                    <input type="text" class="form-control" name="settings[site_name]" value="<?= e(setting('site_name', '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">URL Base</label>
                                    <input type="url" class="form-control" name="settings[base_url]" value="<?= e(setting('base_url', '')) ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descrição do Site</label>
                                    <textarea class="form-control" name="settings[site_description]" rows="2"><?= e(setting('site_description', '')) ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Palavras-chave (SEO)</label>
                                    <input type="text" class="form-control" name="settings[site_keywords]" value="<?= e(setting('site_keywords', '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Logo</label>
                                    <input type="file" class="form-control" name="logo" accept="image/*">
                                    <?php if ($logo = setting('logo')): ?>
                                    <img src="<?= e($logo) ?>" alt="Logo" class="mt-2" style="max-height:40px;">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Favicon</label>
                                    <input type="file" class="form-control" name="favicon" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="settings[email]" value="<?= e(setting('email', '')) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" class="form-control" name="settings[phone]" value="<?= e(setting('phone', '')) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" name="settings[whatsapp]" value="<?= e(setting('whatsapp', '')) ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Endereço</label>
                                    <input type="text" class="form-control" name="settings[address]" value="<?= e(setting('address', '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" name="settings[city]" value="<?= e(setting('city', '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Estado</label>
                                    <input type="text" class="form-control" name="settings[state]" value="<?= e(setting('state', '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="settings[zip_code]" value="<?= e(setting('zip_code', '')) ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab SMTP -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'smtp' ? 'show active' : '' ?>" id="tab-smtp">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Configurações de Email (SMTP)</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="smtp">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Host SMTP</label>
                                    <input type="text" class="form-control" name="settings[smtp_host]" value="<?= e(setting('smtp_host', '')) ?>" placeholder="smtp.gmail.com">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Porta</label>
                                    <input type="number" class="form-control" name="settings[smtp_port]" value="<?= e(setting('smtp_port', '587')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Usuário</label>
                                    <input type="text" class="form-control" name="settings[smtp_username]" value="<?= e(setting('smtp_username', '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="settings[smtp_password]" value="<?= e(setting('smtp_password', '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Criptografia</label>
                                    <select class="form-select" name="settings[smtp_encryption]">
                                        <option value="tls" <?= setting('smtp_encryption') === 'tls' ? 'selected' : '' ?>>TLS</option>
                                        <option value="ssl" <?= setting('smtp_encryption') === 'ssl' ? 'selected' : '' ?>>SSL</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email Remetente</label>
                                    <input type="email" class="form-control" name="settings[smtp_from_email]" value="<?= e(setting('smtp_from_email', '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nome Remetente</label>
                                    <input type="text" class="form-control" name="settings[smtp_from_name]" value="<?= e(setting('smtp_from_name', '')) ?>">
                                </div>
                            </div>
                            <div class="mt-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar</button>
                                <button type="button" class="btn btn-outline-secondary" id="testSmtp"><i class="bi bi-send"></i> Testar Conexão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Redes Sociais -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'social' ? 'show active' : '' ?>" id="tab-social">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Redes Sociais</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="social">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Facebook</label><input type="url" class="form-control" name="settings[social_facebook]" value="<?= e(setting('social_facebook', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">Instagram</label><input type="url" class="form-control" name="settings[social_instagram]" value="<?= e(setting('social_instagram', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">LinkedIn</label><input type="url" class="form-control" name="settings[social_linkedin]" value="<?= e(setting('social_linkedin', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">YouTube</label><input type="url" class="form-control" name="settings[social_youtube]" value="<?= e(setting('social_youtube', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">GitHub</label><input type="url" class="form-control" name="settings[social_github]" value="<?= e(setting('social_github', '')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Analytics -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'google' ? 'show active' : '' ?>" id="tab-google">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Analytics & Tracking</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="google">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Google Analytics ID</label><input type="text" class="form-control" name="settings[google_analytics_id]" value="<?= e(setting('google_analytics_id', '')) ?>" placeholder="G-XXXXXXXXXX"></div>
                                <div class="col-md-6"><label class="form-label">Google Tag Manager ID</label><input type="text" class="form-control" name="settings[google_tag_manager_id]" value="<?= e(setting('google_tag_manager_id', '')) ?>" placeholder="GTM-XXXXXXX"></div>
                                <div class="col-md-6"><label class="form-label">Meta Pixel ID</label><input type="text" class="form-control" name="settings[meta_pixel_id]" value="<?= e(setting('meta_pixel_id', '')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab IA -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'ai' ? 'show active' : '' ?>" id="tab-ai">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">APIs de Inteligência Artificial</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="ai">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Provedor Padrão</label>
                                    <select class="form-select" name="settings[ai_default_provider]">
                                        <option value="openai" <?= setting('ai_default_provider') === 'openai' ? 'selected' : '' ?>>OpenAI (GPT)</option>
                                        <option value="gemini" <?= setting('ai_default_provider') === 'gemini' ? 'selected' : '' ?>>Google Gemini</option>
                                        <option value="claude" <?= setting('ai_default_provider') === 'claude' ? 'selected' : '' ?>>Anthropic Claude</option>
                                        <option value="deepseek" <?= setting('ai_default_provider') === 'deepseek' ? 'selected' : '' ?>>DeepSeek</option>
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Modelo OpenAI</label><input type="text" class="form-control" name="settings[openai_model]" value="<?= e(setting('openai_model', 'gpt-4')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">OpenAI API Key</label><input type="password" class="form-control" name="settings[openai_api_key]" value="<?= e(setting('openai_api_key', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">Gemini API Key</label><input type="password" class="form-control" name="settings[gemini_api_key]" value="<?= e(setting('gemini_api_key', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">Claude API Key</label><input type="password" class="form-control" name="settings[claude_api_key]" value="<?= e(setting('claude_api_key', '')) ?>"></div>
                                <div class="col-md-6"><label class="form-label">DeepSeek API Key</label><input type="password" class="form-control" name="settings[deepseek_api_key]" value="<?= e(setting('deepseek_api_key', '')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Blog IA -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'blog_ai' ? 'show active' : '' ?>" id="tab-blog-ai">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Blog - Geração Automática por IA</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="blog_ai">
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label">Ativar Blog IA</label>
                                    <select class="form-select" name="settings[blog_ai_enabled]">
                                        <option value="0" <?= setting('blog_ai_enabled') === '0' ? 'selected' : '' ?>>Desativado</option>
                                        <option value="1" <?= setting('blog_ai_enabled') === '1' ? 'selected' : '' ?>>Ativado</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label class="form-label">Artigos por Semana</label><input type="number" class="form-control" name="settings[blog_ai_articles_per_week]" value="<?= e(setting('blog_ai_articles_per_week', '3')) ?>" min="1" max="14"></div>
                                <div class="col-md-4"><label class="form-label">Modelo IA</label>
                                    <select class="form-select" name="settings[blog_ai_model]">
                                        <option value="openai" <?= setting('blog_ai_model') === 'openai' ? 'selected' : '' ?>>OpenAI</option>
                                        <option value="gemini" <?= setting('blog_ai_model') === 'gemini' ? 'selected' : '' ?>>Gemini</option>
                                        <option value="claude" <?= setting('blog_ai_model') === 'claude' ? 'selected' : '' ?>>Claude</option>
                                        <option value="deepseek" <?= setting('blog_ai_model') === 'deepseek' ? 'selected' : '' ?>>DeepSeek</option>
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Estilo de Escrita</label>
                                    <select class="form-select" name="settings[blog_ai_writing_style]">
                                        <option value="professional" <?= setting('blog_ai_writing_style') === 'professional' ? 'selected' : '' ?>>Profissional</option>
                                        <option value="casual" <?= setting('blog_ai_writing_style') === 'casual' ? 'selected' : '' ?>>Casual</option>
                                        <option value="technical" <?= setting('blog_ai_writing_style') === 'technical' ? 'selected' : '' ?>>Técnico</option>
                                        <option value="educational" <?= setting('blog_ai_writing_style') === 'educational' ? 'selected' : '' ?>>Educacional</option>
                                    </select>
                                </div>
                                <div class="col-md-3"><label class="form-label">Gerar Imagem</label>
                                    <select class="form-select" name="settings[blog_ai_auto_image]">
                                        <option value="1" <?= setting('blog_ai_auto_image') === '1' ? 'selected' : '' ?>>Sim</option>
                                        <option value="0" <?= setting('blog_ai_auto_image') === '0' ? 'selected' : '' ?>>Não</option>
                                    </select>
                                </div>
                                <div class="col-md-3"><label class="form-label">Auto Categorias</label>
                                    <select class="form-select" name="settings[blog_ai_auto_categories]">
                                        <option value="1" <?= setting('blog_ai_auto_categories') === '1' ? 'selected' : '' ?>>Sim</option>
                                        <option value="0" <?= setting('blog_ai_auto_categories') === '0' ? 'selected' : '' ?>>Não</option>
                                    </select>
                                </div>
                                <div class="col-12"><label class="form-label">Dias de Publicação</label><input type="text" class="form-control" name="settings[blog_ai_publish_days]" value="<?= e(setting('blog_ai_publish_days', '')) ?>" placeholder='["monday","wednesday","friday"]'></div>
                                <div class="col-12"><label class="form-label">Prompt Personalizado</label><textarea class="form-control" name="settings[blog_ai_custom_prompt]" rows="4" placeholder="Instruções adicionais para a IA ao gerar artigos..."><?= e(setting('blog_ai_custom_prompt', '')) ?></textarea></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Idiomas -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'language' ? 'show active' : '' ?>" id="tab-language">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Idiomas</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="language">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Idioma Padrão</label>
                                    <select class="form-select" name="settings[default_language]">
                                        <option value="pt" <?= setting('default_language') === 'pt' ? 'selected' : '' ?>>Português</option>
                                        <option value="en" <?= setting('default_language') === 'en' ? 'selected' : '' ?>>English</option>
                                        <option value="es" <?= setting('default_language') === 'es' ? 'selected' : '' ?>>Español</option>
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Idiomas Ativos</label><input type="text" class="form-control" name="settings[active_languages]" value="<?= e(setting('active_languages', '["pt","en","es"]')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Chatbot -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'chatbot' ? 'show active' : '' ?>" id="tab-chatbot">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Chatbot do Site</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="chatbot">
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label">Ativar Chatbot</label>
                                    <select class="form-select" name="settings[chatbot_enabled]">
                                        <option value="1" <?= setting('chatbot_enabled') === '1' ? 'selected' : '' ?>>Ativado</option>
                                        <option value="0" <?= setting('chatbot_enabled') === '0' ? 'selected' : '' ?>>Desativado</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label class="form-label">Provedor IA</label>
                                    <select class="form-select" name="settings[chatbot_ai_provider]">
                                        <option value="openai" <?= setting('chatbot_ai_provider') === 'openai' ? 'selected' : '' ?>>OpenAI</option>
                                        <option value="gemini" <?= setting('chatbot_ai_provider') === 'gemini' ? 'selected' : '' ?>>Gemini</option>
                                        <option value="claude" <?= setting('chatbot_ai_provider') === 'claude' ? 'selected' : '' ?>>Claude</option>
                                    </select>
                                </div>
                                <div class="col-12"><label class="form-label">Mensagem de Boas-vindas</label><input type="text" class="form-control" name="settings[chatbot_greeting]" value="<?= e(setting('chatbot_greeting', '')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab WhatsApp -->
            <div class="tab-pane fade <?= ($tab ?? '') === 'whatsapp' ? 'show active' : '' ?>" id="tab-whatsapp">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">WhatsApp</h5>
                        <form method="POST" action="<?= url('admin/settings') ?>">
                            <?= csrfField() ?>
                            <input type="hidden" name="settings_group" value="whatsapp">
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label">Ativar Botão</label>
                                    <select class="form-select" name="settings[whatsapp_enabled]">
                                        <option value="1" <?= setting('whatsapp_enabled') === '1' ? 'selected' : '' ?>>Ativado</option>
                                        <option value="0" <?= setting('whatsapp_enabled') === '0' ? 'selected' : '' ?>>Desativado</option>
                                    </select>
                                </div>
                                <div class="col-md-8"><label class="form-label">Número (com DDI)</label><input type="text" class="form-control" name="settings[whatsapp_number]" value="<?= e(setting('whatsapp_number', '')) ?>" placeholder="5511999999999"></div>
                                <div class="col-12"><label class="form-label">Mensagem Padrão</label><input type="text" class="form-control" name="settings[whatsapp_message]" value="<?= e(setting('whatsapp_message', '')) ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- /.tab-content -->
    </div>
</div>

<script>
document.getElementById('testSmtp')?.addEventListener('click', function() {
    this.disabled = true;
    this.innerHTML = '<i class="bi bi-hourglass"></i> Testando...';
    fetch('<?= url("admin/settings/smtp-test") ?>')
        .then(r => r.json())
        .then(data => {
            alert(data.message);
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-send"></i> Testar Conexão';
        });
});
</script>
