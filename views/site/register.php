<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="register">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'is_active') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password_hash') ?>
        <?= $form->field($model, 'created_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
