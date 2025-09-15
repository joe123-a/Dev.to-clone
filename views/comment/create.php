<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Comment';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Main Container with Logo Header -->
<div class="comment-create container mt-5" style="max-width: 700px;">
    <!-- Header with Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="logo-area">
            <?= Html::img('@web/images/logoo.webp', [
                'alt' => 'Community Logo',
                'class' => 'img-fluid',
                'style' => 'max-height: 60px; max-width: 200px;', // Adjust size as needed
            ]) ?>
        </div>
        <h1 class="text-primary fw-bold"><?= Html::encode($this->title) ?></h1>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
            <small class="text-white-50">Posted on: <?= date('F d, Y h:i A') ?></small> <!-- Dynamic date -->
        </div>
        <div class="card-body p-4">
            <?php $form = ActiveForm::begin([
                'id' => 'comment-form',
                'fieldConfig' => [
                    'template' => "{label}\n<div class='mb-3'>{input}\n{error}</div>",
                    'labelOptions' => ['class' => 'form-label text-dark fw-semibold'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'content')->textarea([
                'rows' => 6,
                'class' => 'form-control',
                'placeholder' => 'Write your comment here...',
                'style' => 'resize: vertical; min-height: 150px; font-size: 1rem; padding: 12px;',
                'required' => true,
            ]) ?>

            <div class="card-footer bg-light d-flex justify-content-end gap-3 pt-3">
                <?= Html::submitButton('Submit Comment', [
                    'class' => 'btn btn-primary btn-lg px-4',
                    'name' => 'submit-button',
                ]) ?>
                <?= Html::a('Cancel', ['site/index'], [
                    'class' => 'btn btn-outline-secondary btn-lg px-4',
                    'name' => 'cancel-button',
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<style>
    .comment-create .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .comment-create .card-header {
        border-radius: 12px 12px 0 0;
        padding: 1rem 1.5rem;
    }
    .logo-area {
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    .form-control {
        border-radius: 8px;
        border-color: #ced4da;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
        outline: none;
    }
    .form-control:invalid {
        border-color: #dc3545;
    }
    .form-control:valid {
        border-color: #28a745;
    }
    .invalid-feedback {
        display: block;
    }
    .card-footer {
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 12px 12px;
    }
    .btn-lg {
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    .btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>