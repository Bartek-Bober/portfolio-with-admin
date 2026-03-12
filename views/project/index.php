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
       <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'admin-table'], 
    'summary' => false,
    'columns' => [
        [
            'attribute' => 'id',
            'contentOptions' => ['class' => 'cell-id'],
            'headerOptions' => ['class' => 'col-id-header'],
        ],
        [
            'attribute' => 'image_url',
            'format' => 'html',
            'label' => 'Miniatura',
            'value' => function ($model) {
                return $model->image_url 
                    ? Html::img($model->image_url, ['class' => 'admin-list-thumb']) 
                    : '<span class="text-empty-value small">Brak</span>';
            },
            'headerOptions' => ['class' => 'col-thumb-header'],
        ],
        [
            'attribute' => 'title',
            'contentOptions' => ['class' => 'cell-title'],
        ],
        [
            'label' => 'KATEGORIA',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->category 
                    ? '<span class="text-porcelain">' . Html::encode($model->category->name) . '</span>' 
                    : '<span class="text-empty-value">Brak</span>';
            },
        ],
        [
            'label' => 'TECHNOLOGIE',
            'format' => 'raw',
            'contentOptions' => ['class' => 'cell-tech'],
            'value' => function ($model) {
                $techs = [];
                
                foreach ($model->technologies as $tech) {
                    $techs[] = '<i class="' . Html::encode($tech->icon_class) . ' fs-4 me-2 tech-icon-list" title="' . Html::encode($tech->name) . '"></i>';
                }
                return empty($techs) ? '<span class="text-empty-value small">Brak</span>' : implode('', $techs);
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'DZIAŁANIA',
            'headerOptions' => ['class' => 'col-actions-header'],
            'contentOptions' => ['class' => 'col-actions-content'],
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="bi bi-pencil"></i> Edytuj', $url, ['class' => 'btn-action-edit']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="bi bi-trash"></i> Usuń', $url, [
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