<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */

$this->title = $model->title;
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* Wrapper to isolate styles */
.post-view-wrapper {
    font-family: 'Inter', sans-serif;
    background-color: #f9fafb;
    padding: 2rem 0;
}

.post-view-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    padding: 2rem;
    max-width: 800px;
    width: 100%;
    margin: 0 auto;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.post-view-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.12);
}

.post-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-align: center;
    background: linear-gradient(90deg, #3b49df, #2a38c7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.post-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.post-content {
    font-size: 1rem;
    line-height: 1.7;
    color: #374151;
    margin-bottom: 2rem;
}

.post-meta {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 2rem;
    background: #f1f5f9;
    padding: 1rem;
    border-radius: 12px;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem 1rem;
}

.post-meta span {
    background: #e0f2fe;
    color: #0369a1;
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 0.8rem;
}

.comments-section {
    margin-top: 2.5rem;
}

.comments-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #111827;
}

.comment {
    background: #f9fafb;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 4px solid #3b49df;
}

.comment-content {
    font-size: 0.95rem;
    color: #374151;
    margin-bottom: 0.5rem;
}

.comment-meta {
    font-size: 0.8rem;
    color: #9ca3af;
}

.no-comments {
    font-size: 0.9rem;
    color: #6b7280;
    font-style: italic;
}

.back-button {
    display: inline-block;
    margin-top: 2rem;
    padding: 0.75rem 1.5rem;
    background: #3b49df;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    border-radius: 8px;
    transition: background 0.3s ease;
}

.back-button:hover {
    background: #2a38c7;
}

@media (max-width: 767px) {
    .post-title { font-size: 1.6rem; }
    .post-view-card { padding: 1.5rem; }
}
</style>

<div class="post-view-wrapper">
    <div class="post-view-card">
        <h1 class="post-title"><?= Html::encode($model->title) ?></h1>

        <?php if ($model->cover_image): ?>
            <img src="<?= Yii::getAlias('@web') . '/' . $model->cover_image ?>" class="post-image" alt="Cover Image">
        <?php else: ?>
            <img src="<?= Yii::getAlias('@web') . '/images/logoo.webp' ?>" class="post-image" alt="Default Cover Image">
        <?php endif; ?>

        <div class="post-content">
            <?= nl2br(Html::encode($model->description)) ?>
        </div>

        <div class="post-meta">
            <span>Status: <?= Html::encode($model->status) ?></span>
            <span>Author: <?= Html::encode($model->user->username) ?></span>
            <span>Created: <?= Yii::$app->formatter->asDate($model->created_at, 'MMM d, yyyy') ?></span>
        </div>

        <div id="comments" class="comments-section">
            <h2 class="comments-title">Comments</h2>
            <?php if (!empty($model->comments)): ?>
                <?php foreach ($model->comments as $comment): ?>
                    <div class="comment">
                        <p class="comment-content">
                            <strong><?= Html::encode($comment->user->username) ?>:</strong>
                            <?= nl2br(Html::encode($comment->content)) ?>
                        </p>
                        <p class="comment-meta">
                            <?= Yii::$app->formatter->asDate($comment->created_at, 'MMM d, yyyy') ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-comments">💬 No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>

        <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>" class="back-button">⬅ Back to Discussions</a>
    </div>
</div>
