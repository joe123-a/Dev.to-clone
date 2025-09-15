<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
$this->title = 'Edit Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="posts-edit">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'], // Required for file upload
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'options' => ['class' => 'form-group'],
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Enter post title']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Write your post content...']) ?>

    <!-- < ?= $form->field($model, 'tags')->textInput(['maxlength' => true, 'placeholder' => 'Enter tags separated by commas (e.g., php, yii2, web)']) ?> -->

    <!-- Cover Image Update -->
    <?php if ($model->cover_image): ?>
        <div class="form-group">
            <label>Current Cover Image</label><br>
            <?= Html::img(Url::to('@web/' . $model->cover_image), ['class' => 'img-thumbnail', 'style' => 'max-width: 200px;']) ?><br><br>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'cover_image')->fileInput()->label('Update Cover Image (optional)') ?>

    <div class="form-group">
        <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['site/index', 'id' => $model->id], ['class' => 'btn btn-secondary ml-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('error') ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<style>
    .posts-edit {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .form-group label {
        font-weight: bold;
    }
    .img-thumbnail {
        border-radius: 8px;
    }
</style>