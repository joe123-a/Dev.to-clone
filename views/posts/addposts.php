<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Add New Post';
?>

<!-- Main Container with Logo Header -->
<div class="container mt-5" style="max-width: 800px;">
    <!-- Header with Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="logo-area">
            <?= Html::img('@web/images/logoo.webp', [
                'alt' => 'Your Logo',
                'class' => 'img-fluid',
                'style' => 'max-height: 60px; max-width: 200px;', // Adjust size as needed
            ]) ?>
        </div>
        <h1 class="text-primary fw-bold"><?= Html::encode($this->title) ?></h1>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <?php $form = ActiveForm::begin([
                'id' => 'add-post-form',
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'needs-validation'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class='mb-3'>{input}\n{error}</div>",
                    'labelOptions' => ['class' => 'form-label text-dark fw-semibold'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
            ]); ?>

            <!-- Cover Image Upload -->
            <?= $form->field($model, 'cover_image')->fileInput([
                'accept' => 'image/*',
                'class' => 'form-control',
                'id' => 'cover-image-input',
            ])->label('Cover Image <span class="text-muted">(Upload JPG, PNG, etc., max 5MB)</span>', ['encode' => false]) ?>

            <!-- Title -->
            <?= $form->field($model, 'title')->textInput([
                'class' => 'form-control',
                'placeholder' => 'Enter post title',
                'maxlength' => 255,
                'required' => true,
            ]) ?>

            <!-- Description -->
            <?= $form->field($model, 'description')->textarea([
                'rows' => 6,
                'class' => 'form-control',
                'placeholder' => 'Write your post content here...',
                'required' => true,
                'id' => 'post-description',
            ]) ?>

            <!-- Status -->
            <?= $form->field($model, 'status')->dropDownList(
                [
                    'draft' => 'Draft',
                    'published' => 'Published'
                ],
                [
                    'class' => 'form-select',
                    'prompt' => 'Select status',
                    'required' => true,
                ]
            ) ?>

            <!-- Submit Buttons -->
            <div class="d-flex justify-content-end gap-3 mt-4">
                <?= Html::submitButton('Save Post', [
                    'class' => 'btn btn-success btn-lg px-4',
                    'id' => 'submit-post',
                ]) ?>
                <?= Html::a('Cancel', ['/site/index'], [
                    'class' => 'btn btn-outline-secondary btn-lg px-4',
                    'id' => 'cancel-post',
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .logo-area {
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    .card {
        border-radius: 12px;
    }
    .card-body {
        padding: 2rem;
    }
    .form-control,
    .form-select {
        border-radius: 8px;
        border-color: #ced4da;
        padding: 12px;
        font-size: 1rem;
        box-shadow: none;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }
    .form-control:invalid,
    .form-select:invalid {
        border-color: #dc3545;
    }
    .form-control:valid,
    .form-select:valid {
        border-color: #28a745;
    }
    .invalid-feedback {
        display: block;
    }
    .btn-lg {
        transition: all 0.3s ease;
    }
    .btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    #cover-image-input::file-selector-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    #cover-image-input::file-selector-button:hover {
        background-color: #0056b3;
    }
</style>

<!-- Optional: JavaScript for Character Count -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const description = document.getElementById('post-description');
        const maxLength = 1000; // Adjust as needed
        if (description) {
            description.addEventListener('input', function() {
                const currentLength = this.value.length;
                if (currentLength > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                }
                
            });
        }
    });
</script>