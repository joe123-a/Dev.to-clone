<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */

$this->title = $model->title;
?>

<div class="container mt-5">
    <h1 class="mb-3"><?= Html::encode($model->title) ?></h1>

    <?php if ($model->cover_image): ?>
        <img src="<?= Yii::getAlias('@web') . '/' . $model->cover_image ?>" class="img-fluid mb-4" alt="Cover Image">
    <?php endif; ?>

    <p><?= nl2br(Html::encode($model->description)) ?></p>
    <p><strong>Status:</strong> <?= Html::encode($model->status) ?></p>
    <p><strong>Author:</strong> <?= Html::encode($model->user->username) ?></p>
    <p><strong>Created at:</strong> <?= Html::encode($model->created_at) ?></p>
</div>
