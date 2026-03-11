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

<style>
/* Kontener kafelka musi być relatywny, by "X" był w rogu */
.tech-checkbox-item {
    position: relative;
    display: inline-block;
}

/* Przycisk X (domyślnie ukryty, pojawia się po najechaniu) */
.btn-delete-tech {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #ff5555;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    cursor: pointer;
    z-index: 10;
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
}

.tech-checkbox-item:hover .btn-delete-tech {
    opacity: 1;
}

.btn-delete-tech:hover {
    transform: scale(1.2);
}
</style>

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
            <label class="admin-label mb-0" style="color: var(--wisteria);">Kategoria Projektu</label>
            <div>
                <button type="button" id="toggle-cat-form" class="btn btn-sm btn-outline-light me-2" style="border-color: rgba(255,255,255,0.2);">
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
            <label class="admin-label mb-0" style="color: var(--emerald);">Użyte Technologie</label>
            <button type="button" id="toggle-tech-form" class="btn btn-sm btn-outline-light" style="border-color: rgba(255,255,255,0.2);">
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
            <div class="mt-2" style="font-size: 0.7rem;">Znajdź ikony na: <a href="https://icons.getbootstrap.com/" target="_blank" class="text-wisteria">icons.getbootstrap.com</a></div>
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
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;

$script = <<< JS
// ================= KATEGORIE =================

$('#toggle-cat-form').click(function() { $('#inline-cat-form').slideToggle(300); });

// Dodawanie Kategorii
$('#save-cat-btn').click(function() {
    let name = $('#new-cat-name').val();
    if(!name) { alert('Wpisz nazwę kategorii!'); return; }
    
    $.post('/project/create-category-ajax', {
        'Category[name]': name, '$csrfParam': '$csrfToken'
    }, function(response) {
        if(response.success) {
            $('#project-category').append(new Option(response.name, response.id, true, true));
            $('#new-cat-name').val('');
            $('#inline-cat-form').slideUp(300);
        } else {
            alert('Wystąpił błąd zapisu do bazy.');
        }
    });
});

// Usuwanie Kategorii
$('#delete-cat-btn').click(function() {
    let selectBox = $('#project-category');
    let catId = selectBox.val();
    let catName = selectBox.find('option:selected').text();
    
    if(!catId) {
        alert('Najpierw wybierz z listy kategorię, którą chcesz usunąć.');
        return;
    }
    
    if(confirm('Czy na pewno chcesz bezpowrotnie usunąć kategorię: ' + catName + '?')) {
        $.post('/project/delete-category-ajax', {
            'id': catId, '$csrfParam': '$csrfToken'
        }, function(response) {
            if(response.success) {
                selectBox.find('option[value="'+catId+'"]').remove();
            } else {
                alert('Wystąpił błąd podczas usuwania.');
            }
        });
    }
});


// ================= TECHNOLOGIE =================

$('#toggle-tech-form').click(function() { $('#inline-tech-form').slideToggle(300); });

// Dodawanie Technologii
$('#save-tech-btn').click(function() {
    let name = $('#new-tech-name').val();
    let icon = $('#new-tech-icon').val();
    if(!name || !icon) { alert('Wypełnij nazwę oraz klasę ikony!'); return; }
    
    $.post('/project/create-technology-ajax', {
        'Technology[name]': name, 'Technology[icon_class]': icon, '$csrfParam': '$csrfToken'
    }, function(response) {
        if(response.success) {
            let newHtml = `
            <label class="tech-checkbox-item">
                <span class="btn-delete-tech" data-id="\${response.id}" title="Usuń technologię z bazy"><i class="bi bi-x"></i></span>
                <input type="checkbox" name="Project[technology_ids][]" value="\${response.id}" checked>
                <div class="tech-tile shadow-sm" style="animation: fadeIn 0.5s;">
                    <i class="\${response.icon}"></i>
                    <span>\${response.name}</span>
                </div>
            </label>`;
            
            $('#tech-container > div').append(newHtml);
            $('#new-tech-name').val(''); $('#new-tech-icon').val('');
            $('#inline-tech-form').slideUp(300);
        } else {
            alert('Wystąpił błąd zapisu do bazy.');
        }
    });
});

// Usuwanie Technologii (używamy delegacji zdarzeń, by działało też dla nowo dodanych)
$(document).on('click', '.btn-delete-tech', function(e) {
    e.preventDefault(); 
    e.stopPropagation(); 
    
    let btn = $(this);
    let techId = btn.data('id');
    let tileWrapper = btn.closest('.tech-checkbox-item');
    let techName = tileWrapper.find('span:last').text();
    
    if(confirm('Czy na pewno chcesz usunąć technologię: ' + techName + '? Zniknie ona ze wszystkich projektów!')) {
        $.post('/project/delete-technology-ajax', {
            'id': techId, '$csrfParam': '$csrfToken'
        }, function(response) {
            if(response.success) {
               
                tileWrapper.fadeOut(300, function() { $(this).remove(); });
            } else {
                alert('Wystąpił błąd podczas usuwania.');
            }
        });
    }
});
JS;
$this->registerJs($script);
?>