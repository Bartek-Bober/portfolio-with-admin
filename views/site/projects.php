<?php
/** @var yii\web\View $this */
/** @var app\models\Project[] $projects */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Wszystkie Projekty | Portfolio';

// Przygotowanie kategorii dla filtrów
$categories = [];
foreach ($projects as $p) {
    if ($p->category) {
        $categories[$p->category->id] = $p->category->name;
    }
}
?>

<div class="site-projects-page pt-5 mt-5">
    <div class="container">
        
        <div class="mb-5 animate__animated animate__fadeIn">
            <a href="<?= Url::to(['site/index']) ?>" class="btn-outline-light btn-sm rounded-pill px-4 text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i> Wróć do strony głównej
            </a>
        </div>

        <div class="portfolio-header text-center mb-5">
            <h1 class="display-3 fw-bold mb-3">Pełna Lista <span class="text-wisteria">Projektów</span></h1>
            <p class="lead opacity-75">Przeglądaj wszystkie moje realizacje i eksperymenty kodowe.</p>
            
            <div class="d-flex justify-content-center flex-wrap gap-2 mt-4" id="filters">
                <button class="btn-filter active" data-filter="all">Wszystkie</button>
                <?php foreach ($categories as $id => $name): ?>
                    <button class="btn-filter" data-filter="cat-<?= $id ?>"><?= Html::encode($name) ?></button>
                <?php endforeach; ?>
            </div>
            <div class="header-line mt-4 mx-auto"></div>
        </div>

        <div class="row g-4 mb-5" id="portfolio-grid">
            <?php foreach ($projects as $project): ?>
                <div class="col-lg-4 col-md-6 project-item" data-category="cat-<?= $project->category_id ?>">
                    <article class="portfolio-card shadow-lg h-100 d-flex flex-column">
                        
                        <div class="portfolio-img-wrapper">
                            <?= Html::img($project->image_url, [
                                'class' => 'img-fluid portfolio-img',
                                'alt' => Html::encode($project->title),
                                'loading' => 'lazy'
                            ]) ?>
                            <div class="portfolio-overlay">
                                <i class="bi bi-plus-lg fs-1 text-white"></i>
                            </div>
                        </div>

                        <div class="portfolio-content p-4 flex-grow-1">
                            <div class="mb-2">
                                <span class="badge category-badge">
                                    <?= $project->category ? Html::encode($project->category->name) : 'Projekt' ?>
                                </span>
                            </div>

                            <div class="tech-stack-row mb-3">
                                <?php foreach ($project->technologies as $tech): ?>
                                    <i class="<?= Html::encode($tech->icon_class) ?> fs-4 me-2 tech-icon-color"></i>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3 class="portfolio-title h4 fw-bold mb-3"><?= Html::encode($project->title) ?></h3>
                            <p class="portfolio-description opacity-75 small project-desc-trim">
                                <?= Html::encode($project->description) ?>
                            </p>
                        </div>

                        <div class="portfolio-footer p-4 pt-0">
                            <div class="d-flex gap-2">
                                <a href="<?= Html::encode($project->live_url ?: '#') ?>" class="btn-emerald portfolio-btn flex-grow-1 d-flex justify-content-between align-items-center" target="_blank">
                                    <span>Zobacz projekt</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <?php if ($project->github_url): ?>
                                    <a href="<?= Html::encode($project->github_url) ?>" class="btn-github-outline github-btn-fixed" target="_blank">
                                        <i class="bi bi-github fs-5"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
// Rejestrujemy ten sam skrypt filtrowania, który masz na głównej
$js = <<<JS
$('.btn-filter').on('click', function() {
    $('.btn-filter').removeClass('active');
    $(this).addClass('active');
    
    let filter = $(this).attr('data-filter');
    
    if(filter === 'all') {
        $('.project-item').fadeIn(400);
    } else {
        $('.project-item').hide();
        $('.project-item[data-category="'+filter+'"]').fadeIn(400);
    }
});
JS;
$this->registerJs($js);
?>