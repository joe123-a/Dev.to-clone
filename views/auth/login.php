<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/login.css');

?>


<div class="full-page">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="mb-4">Sign in to your account</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'w-100'],
        'fieldConfig' => [
            'template' => '{input}{error}',
            'labelOptions' => ['class' => 'form-label d-none'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput([
        'autofocus' => true,
        'placeholder' => 'Enter your email',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'placeholder' => 'Enter your password',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'class' => 'form-check-input',
        'labelOptions' => ['class' => 'form-check-label']
    ]) ?>

    <div class="d-grid">
        <?= Html::submitButton('Login', [
            'class' => 'btn btn-primary btn-lg',
            'name' => 'login-button'
        ]) ?>
    </div>

    <p class="mt-3 text-center">
        Don't have an account? <?= Html::a('Register here', ['auth/register'], ['class' => 'fw-bold text-decoration-underline']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>
