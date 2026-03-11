<?php
/** @var yii\web\View $this */
/** @var app\models\Project[] $projects */

use yii\helpers\Html;

$this->title = 'Portfolio | Moje Projekty';

// Pobieramy unikalne kategorie dla przycisków filtrowania
$categories = [];
foreach ($projects as $project) {
    if ($project->category) {
        $categories[$project->category->id] = $project->category->name;
    }
}
?>

<section id="hero" class="hero-section">
    <div class="video-wrapper">
        <video autoplay loop muted playsinline class="hero-video">
            <source src="<?= Yii::getAlias('@web/video/background3.mp4') ?>" type="video/mp4">
        </video>
    </div>
    <div class="hero-overlay"></div>
    <div class="container hero-content text-center">
        <h1 class="display-3 fw-bold mb-5">Tworzę strony, które <span class="text-wisteria">działają.</span></h1>
        <p class="lead mb-5 px-md-5 mx-md-5 text-porcelain opacity-80">
            Zajmuję się projektowaniem i wdrażaniem nowoczesnych aplikacji internetowych. Od estetycznego frontendu po wydajny backend.
        </p>
        <div class="d-flex justify-content-center gap-5 flex-wrap">
            <a href="#projects" class="btn btn-emerald btn-lg px-5 shadow-lg fw-bold">Zobacz moje projekty</a>
            <a href="#contact" class="btn btn-outline-light btn-lg px-5 fw-bold">Skontaktuj się <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>
    <a href="#about" class="scroll-down-icon"><i class="bi bi-chevron-down"></i></a>
</section>

<div class="site-index pt-5">
    <div class="container" id="projects">
        
        <div class="portfolio-header text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">Moje <span class="text-wisteria">Realizacje</span></h1>
            
            <div class="d-flex justify-content-center flex-wrap gap-2 mt-4" id="filters">
                <button class="btn-filter active" data-filter="all">Wszystkie</button>
                <?php 
                // Automatyczne generowanie przycisków na podstawie kategorii w bazie
                $categories = [];
                foreach ($projects as $p) {
                    if ($p->category) $categories[$p->category->id] = $p->category->name;
                }
                foreach ($categories as $id => $name): ?>
                    <button class="btn-filter" data-filter="cat-<?= $id ?>"><?= Html::encode($name) ?></button>
                <?php endforeach; ?>
            </div>
            <div class="header-line mt-4"></div>
        </div>

        <div class="row g-4" id="portfolio-grid">
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
                                <span class="badge" style="background: rgba(131,144,250,0.1); color: var(--wisteria);">
                                    <?= $project->category ? Html::encode($project->category->name) : 'Projekt' ?>
                                </span>
                            </div>

                            <div class="tech-stack-row mb-3">
                                <?php foreach ($project->technologies as $tech): ?>
                                    <i class="<?= Html::encode($tech->icon_class) ?> fs-4 me-2" style="color: var(--emerald);"></i>
                                <?php endforeach; ?>
                            </div>
                            
                            <h3 class="portfolio-title h4 fw-bold mb-3"><?= Html::encode($project->title) ?></h3>
                            <p class="portfolio-description opacity-75 small"><?= Html::encode($project->description) ?></p>
                        </div>

                        <div class="portfolio-footer p-4 pt-0">
                            <div class="d-flex gap-2">
                                <a href="<?= Html::encode($project->live_url ?: '#') ?>" class="btn-emerald portfolio-btn flex-grow-1 d-flex justify-content-between align-items-center" target="_blank">
                                    <span>Zobacz projekt</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <?php if ($project->github_url): ?>
                                    <a href="<?= Html::encode($project->github_url) ?>" class="btn-github-outline" target="_blank" title="Zobacz kod na GitHub">
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

<style>
/* Style dla filtrów */
.btn-filter {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--porcelain);
    padding: 6px 18px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.btn-filter.active, .btn-filter:hover {
    background: var(--emerald);
    color: var(--ink-black);
    border-color: var(--emerald);
    font-weight: 600;
}

/* Styl dla przycisku GitHub */
.btn-github-outline {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    border-radius: 10px;
    transition: all 0.3s;
}
.btn-github-outline:hover {
    background: #24292e;
    border-color: var(--wisteria);
    color: var(--wisteria);
}

/* Animacja filtrowania */
.project-item { transition: all 0.4s ease; }
</style>

<?php
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