<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tabela: projekty';
?>

<div class="admin-index-container">
    <div class="admin-header-row">
        <h2 class="admin-page-title"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('<i class="bi bi-plus-lg"></i> Dodaj Projekt', ['create'], ['class' => 'btn-emerald']) ?>
    </div>

    <div class="admin-card">
       <?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'admin-table'], // Twoja klasa z CSS
    'summary' => false,
    'columns' => [
        [
            'attribute' => 'id',
            'contentOptions' => ['class' => 'cell-id'],
            'headerOptions' => ['style' => 'width: 60px;'],
        ],
        [
            'attribute' => 'image_url',
            'format' => 'html',
            'label' => 'Miniatura',
            'value' => function ($model) {
                return $model->image_url 
                    ? yii\helpers\Html::img($model->image_url, ['class' => 'admin-list-thumb']) 
                    : '<span class="text-muted small">Brak</span>';
            },
            'headerOptions' => ['style' => 'width: 100px;'],
        ],
        [
            'attribute' => 'title',
            'contentOptions' => ['class' => 'cell-title'],
        ],
        [
            'label' => 'KATEGORIA',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->category ? '<span style="color: var(--porcelain);">' . yii\helpers\Html::encode($model->category->name) . '</span>' : '<span class="text-muted">Brak</span>';
            },
        ],
        
        // === ZAKTUALIZOWANA KOLUMNA TECHNOLOGII ===
        [
            'label' => 'TECHNOLOGIE',
            'format' => 'raw',
            'contentOptions' => ['class' => 'cell-tech'],
            'value' => function ($model) {
                $techs = [];
                // Pobieramy technologie z nowej relacji bazodanowej
                foreach ($model->technologies as $tech) {
                    $techs[] = '<i class="' . yii\helpers\Html::encode($tech->icon_class) . ' fs-4 me-2" title="' . yii\helpers\Html::encode($tech->name) . '" style="color: var(--wisteria);"></i>';
                }
                return empty($techs) ? '<span class="text-muted small">Brak</span>' : implode('', $techs);
            },
        ],
        // ===========================================

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'DZIAŁANIA',
            'headerOptions' => ['style' => 'width: 150px; text-align: right;'],
            'contentOptions' => ['style' => 'text-align: right;'],
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return yii\helpers\Html::a('<i class="bi bi-pencil"></i> Edytuj', $url, ['class' => 'btn-action-edit']);
                },
                'delete' => function ($url, $model, $key) {
                    return yii\helpers\Html::a('<i class="bi bi-trash"></i> Usuń', $url, [
                        'class' => 'btn-action-delete',
                        'data' => ['confirm' => 'Na pewno usunąć ten projekt?', 'method' => 'post'],
                    ]);
                },
            ],
        ],
    ],
]); ?>
    </div>
</div>