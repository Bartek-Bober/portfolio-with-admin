<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Skrzynka odbiorcza';
?>

<div class="message-index">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-wisteria"><i class="bi bi-inbox-fill me-2"></i>Wiadomości</h1>
    </div>

    <div class="admin-card messages-wrapper p-0 overflow-hidden shadow-lg">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-dark table-hover admin-table mb-0'],
            'summary' => false,
            'rowOptions' => function($model) {
                return $model->is_read == 0 ? ['class' => 'unread-row'] : ['class' => 'read-row'];
            },
            'columns' => [
                [
                    'attribute' => 'is_read',
                    'label' => '',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->is_read 
                            ? '<i class="bi bi-envelope-open fs-5 icon-read"></i>' 
                            : '<i class="bi bi-envelope-fill fs-5 text-emerald"></i>';
                    },
                    'headerOptions' => ['class' => 'col-status-header'],
                    'contentOptions' => ['class' => 'col-status'],
                ],
                [
                    'attribute' => 'name',
                    'contentOptions' => ['class' => 'col-name'],
                ],
                [
                    'attribute' => 'email',
                    'format' => 'email',
                    'contentOptions' => ['class' => 'col-email'],
                ],
                [
                    'attribute' => 'subject',
                ],
                [
                    'attribute' => 'created_at',
                    'label' => 'Data',
                    'value' => function($model) {
                        return date('d.m.Y H:i', $model->created_at);
                    },
                    'headerOptions' => ['class' => 'col-date-header'],
                    'contentOptions' => ['class' => 'col-date'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="d-flex justify-content-end align-items-center gap-2">{view} {delete}</div>',
                    'headerOptions' => ['class' => 'col-actions-header'],
                    'contentOptions' => ['class' => 'col-actions'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="bi bi-eye"></i>', $url, [
                                'class' => 'action-btn btn-view',
                                'title' => 'Zobacz treść'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="bi bi-trash"></i>', $url, [
                                'class' => 'action-btn btn-delete',
                                'data' => ['confirm' => 'Na pewno usunąć tę wiadomość?', 'method' => 'post'],
                                'title' => 'Usuń'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>

