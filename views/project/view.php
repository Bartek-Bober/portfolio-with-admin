<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projekty', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="project-view admin-card shadow-lg border-0 overflow-hidden">
    
    <div class="p-4 border-bottom border-secondary border-opacity-25 d-flex justify-content-between align-items-center" style="background: rgba(131, 144, 250, 0.05);">
        <div>
            <h1 class="m-0 fw-bold" style="color: var(--wisteria);">
                <i class="bi bi-search me-2"></i><?= Html::encode($this->title) ?>
            </h1>
            <p class="text-muted small m-0 mt-1">Podgląd szczegółowy wpisu w bazie danych</p>
        </div>
        <div class="btn-group shadow-sm">
            <?= Html::a('<i class="bi bi-arrow-left"></i> Powrót', ['index'], ['class' => 'btn btn-outline-secondary btn-sm px-3']) ?>
            <?= Html::a('<i class="bi bi-pencil"></i> Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm px-3', 'style' => 'background-color: var(--dark-cyan); border: none;']) ?>
            <?= Html::a('<i class="bi bi-trash"></i> Usuń', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm px-3',
                'data' => [
                    'confirm' => 'Czy na pewno chcesz usunąć ten projekt?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="position-relative group shadow-lg rounded-3 overflow-hidden border border-secondary border-opacity-25 bg-dark">
                    <?= Html::img($model->image_url, [
                        'class' => 'img-fluid w-100',
                        'style' => 'min-height: 250px; object-fit: cover;',
                        'alt' => 'Project Preview'
                    ]) ?>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-75 backdrop-blur">
                        <span class="text-white small fw-bold text-uppercase ls-1">Zrzut ekranu realizacji</span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table custom-view-table'],
                    'attributes' => [
                        [
                            'attribute' => 'id',
                            'captionOptions' => ['style' => 'width: 30%; color: rgba(253, 255, 252, 0.4); text-transform: uppercase; font-size: 0.75rem;'],
                            'contentOptions' => ['style' => 'color: var(--emerald); font-weight: bold;'],
                        ],
                        [
                            'attribute' => 'title',
                            'captionOptions' => ['style' => 'color: rgba(253, 255, 252, 0.4); text-transform: uppercase; font-size: 0.75rem;'],
                            'contentOptions' => ['class' => 'fw-bold', 'style' => 'font-size: 1.2rem;'],
                        ],
                        [
                            'attribute' => 'technologies',
                            'format' => 'raw',
                            'captionOptions' => ['style' => 'color: rgba(253, 255, 252, 0.4); text-transform: uppercase; font-size: 0.75rem;'],
                            'value' => function($model) {
                                return $model->getTechIconsHtml(); // Używamy Twoich nowych ikon z modelu!
                            },
                        ],
                        [
                            'attribute' => 'description',
                            'format' => 'ntext',
                            'captionOptions' => ['style' => 'color: rgba(253, 255, 252, 0.4); text-transform: uppercase; font-size: 0.75rem;'],
                            'contentOptions' => ['class' => 'text-muted'],
                        ],
                        [
                            'attribute' => 'link',
                            'format' => 'raw',
                            'captionOptions' => ['style' => 'color: rgba(253, 255, 252, 0.4); text-transform: uppercase; font-size: 0.75rem;'],
                            'value' => function($model) {
                                return Html::a('<i class="bi bi-box-arrow-up-right me-2"></i>Otwórz link do projektu', $model->link, [
                                    'target' => '_blank',
                                    'class' => 'btn btn-link p-0 fw-bold',
                                    'style' => 'color: var(--wisteria); text-decoration: none;'
                                ]);
                            },
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>