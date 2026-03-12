<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="skill-form admin-card p-4">
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => ['class' => 'mb-4'], 
            'labelOptions' => ['class' => 'admin-label'], 
            'errorOptions' => ['class' => 'admin-form-error'], 
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control admin-input', 'placeholder' => 'np. JavaScript']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'icon_class')->textInput(['maxlength' => true, 'class' => 'form-control admin-input', 'placeholder' => 'np. bi bi-filetype-js']) ?>
            <div class="tech-hint-text mt-1 text-wisteria">Znajdź ikony na <a href="https://icons.getbootstrap.com/" target="_blank" class="text-emerald">Bootstrap Icons</a></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category')->textInput(['maxlength' => true, 'class' => 'form-control admin-input', 'placeholder' => 'np. Frontend, Backend, Narzędzia']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'order_num')->textInput(['type' => 'number', 'class' => 'form-control admin-input']) ?>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('<i class="bi bi-save me-2"></i> Zapisz Umiejętność', ['class' => 'btn-emerald w-100 py-3 fs-5 fw-bold shadow-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>