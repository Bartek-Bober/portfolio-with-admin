<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Project $model */

$this->title = 'Dodaj Nowy Projekt';
// Breadcrumbs (okruszki) pomagają w nawigacji, ale H1 usuwamy całkowicie
$this->params['breadcrumbs'][] = ['label' => 'Projekty', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="project-create admin-view-wrapper">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>