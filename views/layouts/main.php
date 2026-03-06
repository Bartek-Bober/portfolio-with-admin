<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Fullstack Developer Portfolio']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        
        'brandLabel' =>  '<span class="ls-1">DEV_PORTFOLIO</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top shadow-sm']
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'encodeLabels' => false,
        'items' => [           
            ['label' => 'O mnie', 'url' => ['/site/index', '#' => 'about']],
            ['label' => 'Projekty', 'url' => ['/site/index', '#' => 'projects']],
            ['label' => 'Umiejętności', 'url' => ['/site/index', '#' => 'skills']],
            ['label' => 'Doświadczenie', 'url' => ['/site/index', '#' => 'experience']],
            ['label' => 'Kontakt', 'url' => ['/site/index', '#' => 'contact']],
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
  <?= Breadcrumbs::widget([
    // To jest kluczowa zmiana:
    'homeLink' => [
        'label' => 'Strona główna', 
        'url' => Yii::$app->homeUrl,
    ],
    'links' => $this->params['breadcrumbs'] ?? [],
    'options' => ['class' => 'breadcrumb-custom mb-4']
]) ?>
        
        <?= Alert::widget() ?>
        
        <div class="page-content-wrapper">
            <?= $content ?>
        </div>
    </div>
</main>

<footer id="footer" class="mt-auto py-4 border-top border-secondary border-opacity-10">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span class="fw-bold" style="color: var(--wisteria);">
                    &copy; Portfolio <?= date('Y') ?>
                </span>
            </div>
            
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>