<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Technology;
use app\models\Category;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */

$allTechnologies = Technology::find()->all();
$categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');

$selectedTechIds = [];
if (!$model->isNewRecord && !empty($model->technologies)) {
    $selectedTechIds = ArrayHelper::getColumn($model->technologies, 'id');
}
?>

<div class="project-form admin-card p-4">

    <?php 
    $form = ActiveForm::begin([
        'id' => 'project-form',
        'fieldConfig' => [
            'options' => ['class' => 'mb-4'], 
            'labelOptions' => ['class' => 'admin-label'], 
            'errorOptions' => ['class' => 'admin-form-error'], 
        ],
    ]); 
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control admin-input']) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 4, 'class' => 'form-control admin-input']) ?>
    <?= $form->field($model, 'image_url')->textInput([
    'maxlength' => true, 
    'class' => 'form-control admin-input',
    'placeholder' => 'Wklej link do zdjęcia '
])->label('Adres URL Miniatury') ?>

    <div class="row mb-4">
        <div class="col-md-6">
            <?= $form->field($model, 'github_url', ['options' => ['class' => 'mb-0']])->textInput(['maxlength' => true, 'class' => 'form-control admin-input', 'placeholder' => 'https://github.com/...']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'live_url', ['options' => ['class' => 'mb-0']])->textInput(['maxlength' => true, 'class' => 'form-control admin-input', 'placeholder' => 'https://moja-strona.pl']) ?>
        </div>
    </div>

    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="admin-label mb-0 text-wisteria">Kategoria Projektu</label>
            <div>
                <button type="button" id="toggle-cat-form" class="btn btn-sm btn-outline-light me-2 btn-border-alpha">
                    <i class="bi bi-plus-lg"></i> Dodaj
                </button>
                <button type="button" id="delete-cat-btn" class="btn btn-sm btn-outline-danger" title="Usuń wybraną kategorię z listy">
                    <i class="bi bi-trash"></i> Usuń zaznaczoną
                </button>
            </div>
        </div>

        <div id="inline-cat-form" class="inline-add-panel">
            <div class="row g-2 align-items-end">
                <div class="col-md-9">
                    <label class="admin-label">Nazwa Kategorii</label>
                    <input type="text" id="new-cat-name" class="form-control admin-input form-control-sm">
                </div>
                <div class="col-md-3">
                    <button type="button" id="save-cat-btn" class="btn-emerald btn-sm w-100 py-2">Zapisz</button>
                </div>
            </div>
        </div>

        <?= $form->field($model, 'category_id', ['options' => ['class' => 'mb-0']])->dropDownList(
            $categories, 
            ['prompt' => '-- Wybierz kategorię --', 'class' => 'form-select admin-input', 'id' => 'project-category']
        )->label(false) ?>
    </div>

    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="admin-label mb-0 text-emerald">Użyte Technologie</label>
            <button type="button" id="toggle-tech-form" class="btn btn-sm btn-outline-light btn-border-alpha">
                <i class="bi bi-plus-lg"></i> Dodaj technologię
            </button>
        </div>

        <div id="inline-tech-form" class="inline-add-panel">
            <div class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="admin-label">Nazwa</label>
                    <input type="text" id="new-tech-name" class="form-control admin-input form-control-sm">
                </div>
                <div class="col-md-5">
                    <label class="admin-label">Ikona (np. bi bi-filetype-jsx)</label>
                    <input type="text" id="new-tech-icon" class="form-control admin-input form-control-sm">
                </div>
                <div class="col-md-2">
                    <button type="button" id="save-tech-btn" class="btn-emerald btn-sm w-100 py-2">Zapisz</button>
                </div>
            </div>
            <div class="mt-2 tech-hint-text">Znajdź ikony na: <a href="https://icons.getbootstrap.com/" target="_blank" class="text-wisteria">icons.getbootstrap.com</a></div>
        </div>

        <div class="tech-selection-grid" id="tech-container">
            <div>
                <?php foreach ($allTechnologies as $tech): ?>
                    <?php $isChecked = in_array($tech->id, $selectedTechIds) ? 'checked' : ''; ?>
                    <label class="tech-checkbox-item">
                        <span class="btn-delete-tech" data-id="<?= $tech->id ?>" title="Usuń technologię z bazy"><i class="bi bi-x"></i></span>
                        
                        <input type="checkbox" name="Project[technology_ids][]" value="<?= $tech->id ?>" <?= $isChecked ?>>
                        <div class="tech-tile shadow-sm">
                            <i class="<?= Html::encode($tech->icon_class) ?>"></i>
                            <span><?= Html::encode($tech->name) ?></span>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="form-group mt-5">
        <?= Html::submitButton('<i class="bi bi-save me-2"></i> Zapisz Projekt', ['class' => 'btn-emerald w-100 py-3 fs-5 fw-bold shadow-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS

const filterButtons = document.querySelectorAll('.btn-filter');
const projectItems = document.querySelectorAll('.project-item');


filterButtons.forEach(button => {
    button.addEventListener('click', function() {
        

        filterButtons.forEach(btn => btn.classList.remove('active'));
        
       
        this.classList.add('active');
        
       
        const filterValue = this.getAttribute('data-filter');
        
        projectItems.forEach(item => {
            if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.5s ease-in-out';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
JS;
$this->registerJs($js);
?>