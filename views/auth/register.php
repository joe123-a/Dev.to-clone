<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/register.css');
?>

<div class="full-page">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Create your account</p>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'w-100'],
        'fieldConfig' => [
            'template' => '{input}{error}',
            'labelOptions' => ['class' => 'form-label d-none'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput([
        'placeholder' => 'Username',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'email')->input('email', [
        'placeholder' => 'Email Address',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'placeholder' => 'Password',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'confirm_password')->passwordInput([
        'placeholder' => 'Confirm Password',
        'class' => 'form-control'
    ]) ?>

    <div class="d-grid">
        <?= Html::submitButton('Register', [
            'class' => 'btn btn-primary btn-lg',
            'name' => 'register-button'
        ]) ?>
    </div>

    <p class="mt-3 text-center">
        Already have an account? <?= Html::a('Login here', ['auth/login'], ['class' => 'text-primary fw-bold text-decoration-underline']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>
