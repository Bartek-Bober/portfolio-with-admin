<?php
use yii\helpers\Html;
$this->title = 'Zmiana Hasła';
?>

<div class="admin-view-wrapper admin-view-narrow">
    <h2 class="admin-page-title mb-4"><i class="bi bi-shield-lock"></i> <?= Html::encode($this->title) ?></h2>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger border-0 shadow alert-danger-custom">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <div class="admin-card p-4">
        <?= Html::beginForm(['password'], 'post') ?>
        
        <label class="admin-label">Wpisz nowe hasło</label>
        <?= Html::passwordInput('new_password', '', [
            'class' => 'form-control admin-input mb-4', 
            'required' => true,
            'placeholder' => 'Minimum 6 znaków...'
        ]) ?>

        <?= Html::submitButton('Zapisz nowe hasło', ['class' => 'btn-emerald w-100']) ?>
        
        <?= Html::endForm() ?>
    </div>
</div>