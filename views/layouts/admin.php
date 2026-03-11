<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <?php $this->head() ?>
    <?php $this->registerCsrfMetaTags() ?>
</head>
<body class="admin-body-layout">
<?php $this->beginBody() ?>

<div class="admin-wrapper d-flex">
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <i class="bi bi-terminal-fill text-emerald"></i> <span style="color: var(--porcelain);">ADMIN</span>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="<?= Url::to(['/site/index']) ?>" target="_blank" style="border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 10px;">
                    <i class="bi bi-globe text-wisteria"></i> Zobacz stronę
                </a>
            </li>

            <li>
                <a href="<?= Url::to(['/project/index']) ?>" class="<?= Yii::$app->controller->id == 'project' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2"></i> Projekty
                </a>
            </li>

           

            <li>
                <a href="<?= Url::to(['/project/password']) ?>" class="<?= Yii::$app->controller->action->id == 'password' ? 'active' : '' ?>">
                    <i class="bi bi-key"></i> Zmień hasło
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <?= Html::beginForm(['/site/logout'], 'post') ?>
            <?= Html::submitButton('<i class="bi bi-box-arrow-left"></i> Wyloguj się', ['class' => 'btn-logout']) ?>
            <?= Html::endForm() ?>
        </div>
    </aside>

    <main class="admin-content-area flex-grow-1 p-5">
        <?= $content ?>
    </main>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>