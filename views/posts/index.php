<?php
/** @var yii\web\View $this */
/** @var app\models\Posts[] $posts */

use yii\helpers\Html;

$this->title = 'Posts';
?>

<div class="posts-index container mt-4">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($posts)): ?>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($post->cover_image): ?>
                            <img src="<?= Yii::getAlias('@web/uploads/' . $post->cover_image) ?>" 
                                 class="card-img-top" 
                                 alt="<?= Html::encode($post->title) ?>" 
                                 style="height:200px; object-fit:cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= Html::encode($post->title) ?></h5>
                            <p class="card-text text-truncate" style="max-height:100px; overflow:hidden;">
                                <?= Html::encode($post->description) ?>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    By <?= Html::encode($post->user->username ?? 'Unknown') ?><br>
                                    <?= Yii::$app->formatter->asDatetime($post->created_at) ?>
                                </small>
                                <?= Html::a('View', ['posts/view', 'id' => $post->id], ['class' => 'btn btn-sm btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No posts available.
        </div>
    <?php endif; ?>
</div>

<style>
    /* Optional: hover effect for cards */
    .card:hover {
        transform: translateY(-3px);
        transition: 0.3s;
    }
</style>
