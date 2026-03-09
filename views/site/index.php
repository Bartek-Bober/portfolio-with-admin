<?php

/** @var yii\web\View $this */
/** @var app\models\Project[] $projects */

// TA LINIA ROZWIĄZUJE TWÓJ BŁĄD:
use yii\helpers\Html;

$this->title = 'Portfolio | Moje Projekty';
?>
<section id="hero" class="hero-section">
    <div class="video-wrapper">
        <video autoplay loop muted playsinline class="hero-video">
            <source src="<?= Yii::getAlias('@web/video/background3.mp4') ?>" type="video/mp4">
           
        </video>
    </div>
    
    <div class="hero-overlay"></div>

    <div class="container hero-content text-center">
       
        <h1 class="display-3 fw-bold mb-5">
           Tworzę strony, które  <span class="text-wisteria">działają.</span>
        </h1>
        <p class="lead mb-5 px-md-5 mx-md-5 text-porcelain opacity-80">
            Zajmuję się projektowaniem i wdrażaniem nowoczesnych aplikacji internetowych. Od estetycznego frontendu po wydajny backend.
        </p>
        <div class="d-flex justify-content-center gap-5 flex-wrap">
            <a href="#projects" class="btn btn-emerald btn-lg px-5 shadow-lg fw-bold" >
                Zobacz moje projekty
            </a>
            <a href="#contact" class="btn btn-outline-light btn-lg px-5 fw-bold" >
                Skontaktuj się <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
    
    <a href="#about" class="scroll-down-icon">
        <i class="bi bi-chevron-down"></i>
    </a>
</section>

<div class="container mt-5 pt-5">
    </div>
<div class="site-index">
    <div class="portfolio-header text-center mb-5" id="projects">
        <h1 class="display-4 fw-bold mb-3">Moje <span class="text-wisteria">Realizacje</span></h1>
        <p class="lead ">Przegląd projektów stworzonych podczas praktyk i nauki.</p>
        <div class="header-line"></div>
    </div>

    <div class="row g-4">
        <?php foreach ($projects as $project): ?>
            <div class="col-lg-4 col-md-6">
                <article class="portfolio-card shadow-lg">
                    <div class="portfolio-img-wrapper">
                        <?= Html::img($project->image_url, [
                            'class' => 'img-fluid portfolio-img',
                            'alt' => Html::encode($project->title),
                            'loading' => 'lazy'
                        ]) ?>
                        <div class="portfolio-overlay">
                            <a href="<?= Html::encode($project->link) ?>" class="btn-visit" target="_blank">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Live Demo
                            </a>
                        </div>
                    </div>

                    <div class="portfolio-content">
                        <div class="tech-stack-row mb-3">
                            <?= $project->getTechIconsHtml() ?>
                        </div>
                        
                        <h3 class="portfolio-title"><?= Html::encode($project->title) ?></h3>
                        
                        <p class="portfolio-description opacity-75">
                            <?= Html::encode($project->description) ?>
                        </p>
                    </div>

                    <div class="portfolio-footer">
                        <a href="<?= Html::encode($project->link) ?>" class="btn-emerald portfolio-btn" target="_blank">
                            <span>Zobacz szczegóły</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>