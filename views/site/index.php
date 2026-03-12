<?php
/** @var yii\web\View $this */
/** @var app\models\Project[] $projects */
/** @var app\models\Message $model */ 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
$this->title = 'Portfolio | Moje Projekty';

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

<section id="skills" class="py-5 mt-5">
    <div class="container">
        <div class="portfolio-header text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Moje <span class="text-wisteria">Umiejętności</span></h2>
            <div class="header-line mx-auto"></div>
            <p class="lead mt-3 opacity-75">Narzędzia i technologie, z których korzystam na co dzień.</p>
        </div>

        <?php 
        // Grupowanie skilli według kategorii
        $groupedSkills = [];
        foreach ($skills as $skill) {
            $groupedSkills[$skill->category][] = $skill;
        }
        ?>

        <?php if (empty($groupedSkills)): ?>
            <p class="text-center opacity-50">Brak dodanych umiejętności.</p>
        <?php else: ?>
            <?php foreach ($groupedSkills as $category => $items): ?>
                <div class="mb-5">
                    <h4 class="skill-category-title mb-4"><?= Html::encode($category) ?></h4>
                    <div class="skills-grid">
                        <?php foreach ($items as $skill): ?>
                            <div class="skill-tile shadow-sm">
                                <i class="<?= Html::encode($skill->icon_class) ?> skill-icon"></i>
                                <span class="skill-name"><?= Html::encode($skill->name) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>

<div class="site-index pt-5">
    <div class="container" id="projects">
        
        <div class="portfolio-header text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Moje <span class="text-wisteria">Realizacje</span></h2>
            
            <div class="d-flex justify-content-center flex-wrap gap-2 mt-4" id="filters">
                <button class="btn-filter active" data-filter="all">Wszystkie</button>
                <?php foreach ($categories as $id => $name): ?>
                    <button class="btn-filter" data-filter="cat-<?= $id ?>"><?= Html::encode($name) ?></button>
                <?php endforeach; ?>
            </div>
            <div class="header-line mt-4"></div>
        </div>

        <div class="row g-4" id="portfolio-grid">
            <?php 
            $homepageProjects = array_slice($projects, 0, 6);
            foreach ($homepageProjects as $project): 
            ?>
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
                            <p class="portfolio-description opacity-75 small"><?= Html::encode($project->description) ?></p>
                        </div>

                        <div class="portfolio-footer p-4 pt-0">
                            <div class="d-flex gap-2">
                                <a href="<?= Html::encode($project->live_url ?: '#') ?>" class="btn-emerald portfolio-btn flex-grow-1 d-flex justify-content-between align-items-center" target="_blank">
                                    <span>Zobacz projekt</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <?php if ($project->github_url): ?>
                                    <a href="<?= Html::encode($project->github_url) ?>" class="btn-github-outline github-btn-fixed" target="_blank" title="Zobacz kod na GitHub">
                                        <i class="bi bi-github fs-5"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($projects) > 6): ?>
            <div class="text-center mt-5 pt-3">
                <a href="<?= Url::to(['site/projects']) ?>" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold rounded-pill shadow-lg text-decoration-none d-inline-block">
                    Wszystkie projekty (<?= count($projects) ?>) <i class="bi bi-grid-3x3-gap ms-2"></i>
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<section id="contact" class="contact-section py-5 mt-5 mb-5">
    <div class="container">
        <div class="portfolio-header text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Napisz do <span class="text-wisteria">mnie</span></h2>
            <div class="header-line mx-auto"></div>
            <p class="lead mt-3 opacity-75">Masz propozycję współpracy lub pytanie? Wypełnij formularz poniżej.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                    <div class="alert shadow-lg border-0 text-center p-5 rounded-4 animate__animated animate__fadeIn alert-success-custom">
                        <i class="bi bi-check-circle-fill d-block mb-3 icon-success-large"></i> 
                        <h3 class="fw-bold text-white">Wiadomość wysłana!</h3>
                        <p class="mb-0 opacity-75 text-white">Dziękuję za kontakt. Twoja wiadomość trafiła prosto do mojej skrzynki. Odezwę się najszybciej, jak to możliwe!</p>
                    </div>
                <?php else: ?>
                    <div class="contact-card p-4 p-md-5 shadow-lg rounded-4">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'np. Jan Kowalski', 'class' => 'form-control admin-input px-4 py-3'])->label('Twoje Imię') ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'np. kontakt@firma.pl', 'class' => 'form-control admin-input px-4 py-3'])->label('Twój E-mail') ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'W czym mogę pomóc?', 'class' => 'form-control admin-input px-4 py-3'])->label('Temat wiadomości') ?>
                            </div>

                            <div class="mb-4">
                                <?= $form->field($model, 'body')->textarea(['rows' => 5, 'placeholder' => 'Napisz swoją wiadomość tutaj...', 'class' => 'form-control admin-input px-4 py-3'])->label('Treść wiadomości') ?>
                            </div>

                            <div class="text-center mt-5">
                                <?= Html::submitButton('Wyślij wiadomość <i class="bi bi-send ms-2"></i>', ['class' => 'btn-emerald btn-lg px-5 py-3 fw-bold w-100 rounded-pill shadow-lg', 'name' => 'contact-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$js = <<<JS
// Obsługa filtrowania
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