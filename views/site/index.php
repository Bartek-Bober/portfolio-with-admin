<?php

/** @var yii\web\View $this */
/** @var app\models\Project[] $projects */

// TA LINIA ROZWIĄZUJE TWÓJ BŁĄD:
use yii\helpers\Html;

$this->title = 'Portfolio | Moje Projekty';
?>

<div class="site-index">
    <div class="portfolio-header text-center mb-5">
        <h1 class="display-4 fw-bold mb-3">Moje <span class="text-wisteria">Realizacje</span></h1>
        <p class="lead text-muted">Przegląd projektów stworzonych podczas praktyk i nauki.</p>
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
                        
                        <p class="portfolio-description text-muted">
                            <?= Html::encode($project->description) ?>
                        </p>
                    </div>

                    <div class="portfolio-footer">
                        <a href="<?= Html::encode($project->link) ?>" class="btn-portfolio-link" target="_blank">
                            <span>Zobacz szczegóły</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>