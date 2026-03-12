<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tabela: Umiejętności';
?>
<div class="admin-index-container">
    <div class="admin-header-row">
        <h2 class="admin-page-title"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('<i class="bi bi-plus-lg"></i> Dodaj Umiejętność', ['create'], ['class' => 'btn-emerald']) ?>
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
                    'attribute' => 'icon_class',
                    'label' => 'Ikona',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<i class="' . Html::encode($model->icon_class) . ' fs-3 text-wisteria"></i>';
                    },
                    'headerOptions' => ['class' => 'col-thumb-header'],
                ],
                [
                    'attribute' => 'name',
                    'contentOptions' => ['class' => 'cell-title'],
                ],
                [
                    'attribute' => 'category',
                    'label' => 'Kategoria',
                    'format' => 'raw',
                    'value' => function($model) {
                        return '<span class="text-porcelain">' . Html::encode($model->category) . '</span>';
                    }
                ],
                [
                    'attribute' => 'order_num',
                    'label' => 'Kolejność',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'DZIAŁANIA',
                    'headerOptions' => ['class' => 'col-actions-header'],
                    'contentOptions' => ['class' => 'col-actions-content'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url) { return Html::a('<i class="bi bi-pencil"></i> Edytuj', $url, ['class' => 'btn-action-edit']); },
                        'delete' => function ($url) {
                            return Html::a('<i class="bi bi-trash"></i> Usuń', $url, [
                                'class' => 'btn-action-delete',
                                'data' => ['confirm' => 'Usunąć tę umiejętność?', 'method' => 'post'],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>