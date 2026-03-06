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
            'summary' => false,
            'tableOptions' => ['class' => 'admin-table'],
            'columns' => [
                [
                    'attribute' => 'id',
                    'header' => 'ID',
                    'contentOptions' => ['class' => 'cell-id'],
                    'value' => function($model) { return '#' . $model->id; }
                ],
                [
                    'attribute' => 'image_url',
                    'header' => 'Podgląd',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'cell-img'],
                    'value' => function($model) {
                        return Html::img($model->image_url, ['class' => 'admin-list-thumb']);
                    },
                ],
                [
                    'attribute' => 'title',
                    'header' => 'TYTUŁ PROJEKTU',
                    'contentOptions' => ['class' => 'cell-title'],
                ],
                [
                    'attribute' => 'technologies',
                    'header' => 'TECHNOLOGIE',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'cell-tech'],
                    'value' => function($model) { 
                        return $model->getTechIconsHtml(); 
                    }
                ],
                [
                    'header' => 'DZIAŁANIA',
                    'contentOptions' => ['class' => 'cell-actions'],
                    'format' => 'raw',
                    'value' => function($model) {
                        $editBtn = Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn-action-edit']);
                        $deleteBtn = Html::a('Usuń (DELETE)', ['delete', 'id' => $model->id], [
                            'class' => 'btn-action-delete',
                            'data' => [
                                'confirm' => 'Czy na pewno chcesz usunąć projekt: ' . $model->title . '?',
                                'method' => 'post',
                            ],
                        ]);
                        return $editBtn . $deleteBtn;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>