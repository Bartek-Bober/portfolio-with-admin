<?php
use yii\helpers\Html;
$this->title = 'Edytuj: ' . $model->name;
?>
<div class="admin-view-wrapper">
    <h2 class="admin-page-title mb-4"><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>