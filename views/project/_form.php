<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="admin-card border-0 shadow-lg">
    <div class="admin-header border-bottom border-secondary border-opacity-10">
        <h4 class="m-0 fw-bold text-uppercase ls-1">Dodaj nowy projekt</h4>
    </div>

    <div class="admin-body p-4">
        <?php $form = ActiveForm::begin([
            'id' => 'project-form',
            'fieldConfig' => [
                'labelOptions' => ['class' => 'admin-label'],
                'inputOptions' => ['class' => 'form-control admin-input'],
                'errorOptions' => ['class' => 'invalid-feedback fw-bold'],
            ],
        ]); ?>

        <div class="row g-4">
            <div class="col-md-7">
                <?= $form->field($model, 'title')->textInput(['placeholder' => 'WPISZ TYTUŁ PROJEKTU...']) ?>
            </div>
            <div class="col-md-5">
                <label class="admin-label">KATEGORIA </label>
                <?= Html::dropDownList('cat', null, [
                    '1' => 'Tylko Frontend',
                    '2' => 'Fullstack',
                    '3' => 'Backend'
                ], ['class' => 'form-select admin-input']) ?>
            </div>

            <div class="col-12">
                <label class="admin-label">TECHNOLOGIE </label>
                <div class="tech-selection-grid">
                    <?= $form->field($model, 'technologies')->checkboxList(\app\models\Project::getTechList(), [
                        'tag' => false, 
                        'item' => function ($index, $label, $name, $checked, $value) {
                            $icon = $label['icon'];
                            $active = $checked ? 'active' : '';
                            return "
                            <div class='tech-checkbox-item'>
                                <input type='checkbox' name='{$name}' value='{$value}' id='t-{$index}' " . ($checked ? "checked" : "") . " class='d-none'>
                                <label for='t-{$index}' class='tech-tile shadow-sm {$active}'>
                                    <i class='bi {$icon}'></i>
                                    <span>{$value}</span>
                                </label>
                            </div>";
                        }
                    ])->label(false) ?>
                </div>
            </div>

            <div class="col-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 4, 'placeholder' => 'WPISZ SZCZEGÓŁOWY OPIS PROJEKTU...']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'image_url')->textInput(['placeholder' => 'URL DO ZDJĘCIA (NP. HTTPS://...)']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'link')->textInput(['placeholder' => 'URL DO GITHUBA (NP. HTTPS://...)']) ?>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center mt-5 gap-4 border-top border-secondary border-opacity-10 pt-4">
            <?= Html::a('Anuluj', ['index'], ['class' => 'text-muted text-decoration-none small fw-bold hover-wisteria']) ?>
            <?= Html::submitButton('<i class="bi bi-plus-circle me-2"></i> Zapisz w bazie (INSERT)', ['class' => 'btn-emerald']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>