<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->subject;
?>

<div class="message-view">
    <div class="mb-4">
        <?= Html::a('<i class="bi bi-arrow-left me-2"></i> Powrót do listy', ['index'], ['class' => 'btn btn-outline-light btn-sm']) ?>
    </div>

    <div class="admin-card p-5 shadow-lg animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between border-bottom pb-4 mb-4 border-alpha">
            <div>
                <h6 class="text-emerald text-uppercase fw-bold mb-1">Od: <?= Html::encode($model->name) ?></h6>
                <p class="msg-meta-text mb-0"><i class="bi bi-envelope me-2"></i><?= Html::encode($model->email) ?></p>
            </div>
            <div class="text-end">
                <p class="msg-meta-text small mb-0"><?= date('d F Y, H:i', $model->created_at) ?></p>
                <span class="badge bg-dark mt-2">ID: #<?= $model->id ?></span>
            </div>
        </div>

        <h2 class="fw-bold mb-4 text-wisteria"><?= Html::encode($model->subject) ?></h2>
        
        <div class="message-body p-4 bg-dark-soft rounded-3 border border-alpha">
            <?= Html::encode($model->body) ?>
        </div>

        <div class="mt-5 text-end">
            <?= Html::a('<i class="bi bi-trash me-2"></i> Usuń tę wiadomość', ['delete', 'id' => $model->id], [
                'class' => 'msg-delete-link small text-decoration-none',
                'data' => ['confirm' => 'Na pewno?', 'method' => 'post'],
            ]) ?>
        </div>
    </div>
</div>

