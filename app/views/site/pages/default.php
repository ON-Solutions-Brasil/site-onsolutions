<?php $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<section class="page-hero">
    <div class="container"><h1><?= e($page["title_{$lang}"] ?? $page['title_pt']) ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content-body">
                    <?= $page_content ?>
                </div>
            </div>
        </div>
    </div>
</section>
