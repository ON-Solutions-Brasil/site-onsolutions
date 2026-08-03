<section class="page-hero">
    <div class="container"><h1><?= __('contact.title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Envie sua mensagem</h3>
                        <form method="POST" action="<?= url('contato') ?>">
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
                                    <button type="submit" class="btn btn-primary btn-lg"><?= __('contact.form_submit') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
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
            </div>
        </div>
    </div>
</section>
