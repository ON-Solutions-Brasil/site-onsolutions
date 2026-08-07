<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Contato</span>
        <h1 class="hero-fade-in">Envie sua mensagem</h1>
        <p class="hero-fade-in">Estamos prontos para transformar sua ideia em realidade. Fale com a gente.</p>
    </div>
</section>

<!-- Formulário de Contato -->
<section class="section contact-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 scroll-reveal">
                <div class="contact-box">
                    <h3 class="mb-4">Envie sua mensagem</h3>
                    <form method="POST" action="<?= url('contato') ?>" id="contactForm">
                        <?= csrfField() ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><?= __('contact.form_name') ?> *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?= __('contact.form_email') ?> *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?= __('contact.form_phone') ?></label>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?= __('contact.form_company') ?></label>
                                <input type="text" class="form-control" name="company">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><?= __('contact.form_subject') ?></label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><?= __('contact.form_message') ?> *</label>
                                <textarea class="form-control" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg" id="contactSubmitBtn"><?= __('contact.form_submit') ?></button>
                            </div>
                        </div>
                    </form>
                    <!-- Alerta de sucesso -->
                    <div class="contact-success-alert" id="contactSuccessAlert" style="display: none;">
                        <div class="contact-success-alert__icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="contact-success-alert__content">
                            <strong>Mensagem enviada com sucesso!</strong>
                            <p>Recebemos sua mensagem e retornaremos em breve. Obrigado pelo contato.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 scroll-reveal">
                <div class="contact-info">
                    <h3 class="mb-4">Informações de Contato</h3>
                    <?php if ($email = setting('email')): ?>
                    <div class="contact-item"><i class="bi bi-envelope"></i><div><strong>Email</strong><p><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></p></div></div>
                    <?php endif; ?>
                    <?php if ($phone = setting('phone')): ?>
                    <div class="contact-item"><i class="bi bi-telephone"></i><div><strong>Telefone</strong><p><?= e($phone) ?></p></div></div>
                    <?php endif; ?>
                    <?php if ($whatsapp = setting('whatsapp_number')): ?>
                    <div class="contact-item"><i class="bi bi-whatsapp"></i><div><strong>WhatsApp</strong><p><a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>"><?= e($whatsapp) ?></a></p></div></div>
                    <?php endif; ?>
                    <?php if ($address = setting('address')): ?>
                    <div class="contact-item"><i class="bi bi-geo-alt"></i><div><strong>Endereço</strong><p><?= e($address) ?><br><?= e(setting('city', '')) ?> - <?= e(setting('state', '')) ?></p></div></div>
                    <?php endif; ?>
                </div>

                <!-- Horário de Atendimento -->
                <div class="contact-schedule">
                    <h4><i class="bi bi-clock"></i> Horário de Atendimento</h4>
                    <div class="contact-schedule__list">
                        <div class="contact-schedule__item">
                            <span>Segunda a Sexta</span>
                            <strong>09h — 18h</strong>
                        </div>
                        <div class="contact-schedule__item">
                            <span>Sábado</span>
                            <strong>09h — 13h</strong>
                        </div>
                        <div class="contact-schedule__item">
                            <span>Domingo</span>
                            <strong class="text-muted">Fechado</strong>
                        </div>
                    </div>
                </div>

                <!-- Resposta Rápida -->
                <div class="contact-response">
                    <h4><i class="bi bi-lightning-charge"></i> Resposta Rápida</h4>
                    <p>Respondemos todas as mensagens em até 2 horas durante o horário comercial.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2>Prefere uma conversa rápida?</h2>
        <p>Chame no WhatsApp. Respondemos em minutos.</p>
        <?php if ($whatsapp = setting('whatsapp_number')): ?>
        <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>" class="btn btn-primary btn-lg mt-3" target="_blank" rel="noopener">
            <i class="bi bi-whatsapp me-2"></i>Chamar no WhatsApp
        </a>
        <?php else: ?>
        <a href="mailto:<?= e(setting('email', '')) ?>" class="btn btn-primary btn-lg mt-3">Enviar Email</a>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal
    var els = document.querySelectorAll('.scroll-reveal');
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    els.forEach(function(el) {
        var rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            el.classList.add('is-visible');
        } else {
            io.observe(el);
        }
    });

    // Contact form AJAX
    var form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var btn = document.getElementById('contactSubmitBtn');
            var originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Enviando...';
            btn.disabled = true;

            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                form.style.display = 'none';
                document.getElementById('contactSuccessAlert').style.display = 'flex';
                window.scrollTo({ top: form.parentElement.offsetTop - 100, behavior: 'smooth' });
            })
            .catch(function() {
                form.style.display = 'none';
                document.getElementById('contactSuccessAlert').style.display = 'flex';
            });
        });
    }
});
</script>
