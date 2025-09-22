<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Challenges;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Add New Post';
?>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<!-- Main Container with Logo Header -->
<div class="container mt-5" style="max-width: 800px; background: #f9f9f9;">
    <!-- Header with Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="logo-area">
            <?= Html::img('@web/images/logoo.webp', [
                'alt' => 'Your Logo',
                'class' => 'img-fluid',
                'style' => 'max-height: 60px; max-width: 200px;',
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

            <!-- Tags -->
            <?= $form->field($model, 'tags')->textInput([
                'class' => 'form-control',
                'id' => 'post-tags',
                'placeholder' => 'Enter tags, e.g., #discussion, #latest, #challenges',
            ])->label('Tags <span class="text-muted">(Enter comma-separated tags)</span>', ['encode' => false]) ?>

            <!-- Challenge Selection -->
            <?= $form->field($model, 'challenge_id')->dropDownList(
                ArrayHelper::map(Challenges::find()->where(['status' => 'active'])->all(), 'id', 'title'),
                [
                    'class' => 'form-select',
                    'prompt' => 'Select a Challenge (optional)',
                ]
            ) ?>

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
    :root {
        --primary-color: #3b49df;
        --secondary-color: #2a38c7;
        --background-color: #f9f9f9;
        --success-color: #22c55e;
        --warning-color: #facc15;
    }

    body {
        background: var(--background-color);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .logo-area {
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .card {
        border-radius: 12px;
        background: #ffffff;
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
        border-color: var(--primary-color);
        box-shadow: 0 0 5px rgba(59, 73, 223, 0.3);
        outline: none;
    }

    .form-control:invalid,
    .form-select:invalid {
        border-color: #dc3545;
    }

    .form-control:valid,
    .form-select:valid {
        border-color: var(--success-color);
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
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #cover-image-input::file-selector-button:hover {
        background-color: var(--secondary-color);
    }

    /* Select2 Styling */
    .select2-container .select2-selection--multiple {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 6px;
        font-size: 1rem;
    }

    .select2-container--focus .select2-selection--multiple {
        border-color: var(--primary-color);
        box-shadow: 0 0 5px rgba(59, 73, 223, 0.3);
    }

    .select2-selection__choice {
        background-color: var(--primary-color) !important;
        color: white !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
    }

    .select2-selection__choice__remove {
        color: white !important;
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            font-size: 0.9rem;
            padding: 10px;
        }

        .btn-lg {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>

<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Include Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- JavaScript for Character Count and Select2 -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character count for description
        const description = document.getElementById('post-description');
        const maxLength = 1000;
        if (description) {
            description.addEventListener('input', function() {
                const currentLength = this.value.length;
                if (currentLength > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                }
            });
        }

        // Initialize Select2 for tags
        $('#post-tags').select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: 'Enter tags, e.g., #discussion, #latest, #challenges',
            allowClear: true,
            data: [
                { id: '#discussion', text: '#discussion' },
                { id: '#latest', text: '#latest' },
                { id: '#challenges', text: '#challenges' }
            ]
        });
    });
</script>