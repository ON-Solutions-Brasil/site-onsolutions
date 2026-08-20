<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #115e59;
            --primary-light: #14b8a6;
            --dark: #1e293b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--gray-50);
            color: var(--gray-700);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .quote-page {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* Header */
        .quote-header {
            background: linear-gradient(135deg, var(--dark) 0%, #0f2027 50%, var(--primary-dark) 100%);
            border-radius: 16px;
            padding: 2.5rem;
            color: #fff;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .quote-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(13,148,136,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .quote-header__top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        .quote-header__logo img {
            height: 40px;
            border-radius: 8px;
        }
        .quote-header__logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .quote-header__badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-draft { background: rgba(255,255,255,0.15); color: #cbd5e1; }
        .badge-sent { background: rgba(59,130,246,0.2); color: #93c5fd; }
        .badge-viewed { background: rgba(139,92,246,0.2); color: #c4b5fd; }
        .badge-accepted { background: rgba(16,185,129,0.2); color: #6ee7b7; }
        .badge-rejected { background: rgba(239,68,68,0.2); color: #fca5a5; }
        .badge-expired { background: rgba(107,114,128,0.2); color: #9ca3af; }

        .quote-header__title {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 0 0.5rem;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }
        .quote-header__number {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            position: relative;
            z-index: 1;
        }

        /* Info Grid */
        .quote-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .quote-info-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.2rem;
        }
        .quote-info-card__label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            margin-bottom: 0.3rem;
        }
        .quote-info-card__value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        /* Sections */
        .quote-section {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        .quote-section__header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .quote-section__header i {
            color: var(--primary);
            font-size: 1.1rem;
        }
        .quote-section__header h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            color: var(--gray-800);
        }
        .quote-section__body {
            padding: 1.5rem;
        }

        /* Items Table */
        .quote-items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .quote-items-table thead th {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            padding: 0.8rem 1rem;
            border-bottom: 2px solid var(--gray-200);
            text-align: left;
        }
        .quote-items-table thead th:last-child,
        .quote-items-table thead th:nth-child(3),
        .quote-items-table thead th:nth-child(4) {
            text-align: right;
        }
        .quote-items-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.9rem;
        }
        .quote-items-table tbody td:last-child,
        .quote-items-table tbody td:nth-child(3),
        .quote-items-table tbody td:nth-child(4) {
            text-align: right;
        }
        .quote-items-table tbody tr:last-child td {
            border-bottom: none;
        }
        .item-number {
            width: 40px;
            height: 40px;
            background: var(--gray-100);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Totals */
        .quote-totals {
            background: var(--gray-50);
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }
        .quote-totals__row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }
        .quote-totals__row--total {
            border-top: 2px solid var(--gray-300);
            margin-top: 0.5rem;
            padding-top: 1rem;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* Description/Terms */
        .quote-text {
            font-size: 0.9rem;
            color: var(--gray-600);
            line-height: 1.8;
            white-space: pre-wrap;
        }

        /* Footer */
        .quote-footer {
            background: var(--dark);
            border-radius: 12px;
            padding: 2rem;
            color: rgba(255,255,255,0.7);
            text-align: center;
            margin-top: 2rem;
        }
        .quote-footer__company {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .quote-footer__info {
            font-size: 0.82rem;
            line-height: 1.8;
        }
        .quote-footer__info a {
            color: var(--primary-light);
            text-decoration: none;
        }

        /* Validity warning */
        .quote-validity-warning {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 8px;
            padding: 0.8rem 1.2rem;
            font-size: 0.85rem;
            color: #92400e;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }

        /* Print */
        @media print {
            body { background: #fff; }
            .quote-page { padding: 0; max-width: 100%; }
            .quote-header { border-radius: 0; }
            .quote-footer { border-radius: 0; }
            .no-print { display: none !important; }
        }

        /* Mobile */
        @media (max-width: 768px) {
            .quote-page { padding: 1rem; }
            .quote-header { padding: 1.5rem; border-radius: 12px; }
            .quote-header__title { font-size: 1.4rem; }
            .quote-header__top { flex-direction: column; gap: 1rem; }
            .quote-info { grid-template-columns: 1fr 1fr; }
            .quote-items-table { font-size: 0.8rem; }
            .quote-items-table thead th, .quote-items-table tbody td { padding: 0.6rem 0.5rem; }
        }
    </style>
</head>
<body>

<div class="quote-page">

    <!-- Header -->
    <div class="quote-header">
        <div class="quote-header__top">
            <div class="quote-header__logo">
                <?php if ($logo = setting('logo')): ?>
                    <img src="<?= e($logo) ?>" alt="<?= e(SITE_NAME) ?>">
                <?php else: ?>
                    <span class="quote-header__logo-text"><?= e(SITE_NAME) ?></span>
                <?php endif; ?>
            </div>
            <?php
            $statusLabels = [
                'draft' => 'Rascunho', 'sent' => 'Enviado', 'viewed' => 'Visualizado',
                'accepted' => 'Aceito', 'rejected' => 'Rejeitado', 'expired' => 'Expirado'
            ];
            $statusClass = 'badge-' . ($quote['status'] ?? 'draft');
            ?>
            <span class="quote-header__badge <?= $statusClass ?>"><?= $statusLabels[$quote['status']] ?? $quote['status'] ?></span>
        </div>
        <h1 class="quote-header__title"><?= e($quote['title']) ?></h1>
        <span class="quote-header__number"><?= e($quote['quote_number']) ?></span>
    </div>

    <!-- Validade expirada -->
    <?php if (!empty($quote['valid_until']) && strtotime($quote['valid_until']) < time() && $quote['status'] !== 'accepted'): ?>
    <div class="quote-validity-warning">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>Este orcamento expirou em <?= formatDate($quote['valid_until']) ?>. Entre em contato para renovacao.</span>
    </div>
    <?php endif; ?>

    <!-- Info Cards -->
    <div class="quote-info">
        <?php if (!empty($quote['company_name']) || !empty($quote['contact_name'])): ?>
        <div class="quote-info-card">
            <div class="quote-info-card__label">Cliente</div>
            <div class="quote-info-card__value">
                <?= e($quote['contact_name'] ?? '') ?>
                <?php if (!empty($quote['company_name'])): ?>
                <br><small style="font-weight:400; color:var(--gray-500);"><?= e($quote['company_name']) ?></small>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="quote-info-card">
            <div class="quote-info-card__label">Data de criacao</div>
            <div class="quote-info-card__value"><?= formatDate($quote['created_at'], 'd/m/Y') ?></div>
        </div>
        <?php if (!empty($quote['valid_until'])): ?>
        <div class="quote-info-card">
            <div class="quote-info-card__label">Validade</div>
            <div class="quote-info-card__value"><?= formatDate($quote['valid_until'], 'd/m/Y') ?></div>
        </div>
        <?php endif; ?>
        <div class="quote-info-card">
            <div class="quote-info-card__label">Valor total</div>
            <div class="quote-info-card__value" style="color: var(--primary-dark); font-size: 1.1rem;">R$ <?= number_format($quote['total'] ?? 0, 2, ',', '.') ?></div>
        </div>
    </div>

    <!-- Descricao da proposta -->
    <?php if (!empty($quote['description'])): ?>
    <div class="quote-section">
        <div class="quote-section__header">
            <i class="bi bi-file-text"></i>
            <h3>Descricao da Proposta</h3>
        </div>
        <div class="quote-section__body">
            <div class="quote-text"><?= e($quote['description']) ?></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Itens -->
    <?php if (!empty($items)): ?>
    <div class="quote-section">
        <div class="quote-section__header">
            <i class="bi bi-list-check"></i>
            <h3>Itens do Orcamento</h3>
        </div>
        <div style="overflow-x: auto;">
            <table class="quote-items-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Descricao</th>
                        <th>Qtd</th>
                        <th>Valor Unit.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $i => $item): ?>
                    <tr>
                        <td><span class="item-number"><?= $i + 1 ?></span></td>
                        <td><strong><?= e($item['description']) ?></strong></td>
                        <td style="text-align:right;"><?= number_format($item['quantity'], $item['quantity'] == (int)$item['quantity'] ? 0 : 2, ',', '.') ?></td>
                        <td style="text-align:right;">R$ <?= number_format($item['unit_price'], 2, ',', '.') ?></td>
                        <td style="text-align:right;"><strong>R$ <?= number_format($item['total_price'], 2, ',', '.') ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Totais -->
        <div class="quote-totals">
            <div class="quote-totals__row">
                <span>Subtotal</span>
                <span>R$ <?= number_format($quote['subtotal'] ?? 0, 2, ',', '.') ?></span>
            </div>
            <?php if (($quote['discount_value'] ?? 0) > 0): ?>
            <div class="quote-totals__row">
                <span>Desconto <?= ($quote['discount_percent'] ?? 0) > 0 ? '(' . number_format($quote['discount_percent'], 0) . '%)' : '' ?></span>
                <span style="color: #16a34a;">- R$ <?= number_format($quote['discount_value'], 2, ',', '.') ?></span>
            </div>
            <?php endif; ?>
            <?php if (($quote['tax_value'] ?? 0) > 0): ?>
            <div class="quote-totals__row">
                <span>Impostos <?= ($quote['tax_percent'] ?? 0) > 0 ? '(' . number_format($quote['tax_percent'], 0) . '%)' : '' ?></span>
                <span>R$ <?= number_format($quote['tax_value'], 2, ',', '.') ?></span>
            </div>
            <?php endif; ?>
            <div class="quote-totals__row quote-totals__row--total">
                <span>Total</span>
                <span>R$ <?= number_format($quote['total'] ?? 0, 2, ',', '.') ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Termos e Condicoes -->
    <?php if (!empty($quote['terms'])): ?>
    <div class="quote-section">
        <div class="quote-section__header">
            <i class="bi bi-shield-check"></i>
            <h3>Termos e Condicoes</h3>
        </div>
        <div class="quote-section__body">
            <div class="quote-text"><?= e($quote['terms']) ?></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer empresa -->
    <div class="quote-footer">
        <div class="quote-footer__company"><?= e(SITE_NAME) ?></div>
        <div class="quote-footer__info">
            <?php if ($email = setting('email')): ?>
                <a href="mailto:<?= e($email) ?>"><?= e($email) ?></a><br>
            <?php endif; ?>
            <?php if ($phone = setting('phone')): ?>
                <?= e($phone) ?><br>
            <?php endif; ?>
            <?php if ($address = setting('address')): ?>
                <?= e($address) ?><?= setting('city') ? ', ' . e(setting('city')) : '' ?><?= setting('state') ? ' - ' . e(setting('state')) : '' ?><br>
            <?php endif; ?>
            <?php if (defined('BASE_URL')): ?>
                <a href="<?= BASE_URL ?>"><?= str_replace(['https://', 'http://'], '', BASE_URL) ?></a>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
