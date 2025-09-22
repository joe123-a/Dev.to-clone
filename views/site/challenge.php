<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Challenges $model */

$this->title = $model->title;
?>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Scope all styles to this view using .challenge-page */
    .challenge-page {
        font-family: 'Inter', sans-serif;
        padding: 20px 0;
    }

    .challenge-page .challenge-container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }

    .challenge-page .challenge-detail-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .challenge-page .challenge-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1f2937;
    }

    .challenge-page .challenge-description {
        font-size: 1rem;
        line-height: 1.6;
        color: #4b5563;
        margin-bottom: 25px;
    }

    .challenge-page .challenge-meta p {
        margin: 8px 0;
        font-size: 0.95rem;
        color: #374151;
    }

    .challenge-page .badge {
        display: inline-block;
        background-color: #e0f2fe;
        color: #0369a1;
        font-size: 0.8rem;
        padding: 3px 10px;
        border-radius: 9999px;
        margin-right: 5px;
        margin-top: 5px;
    }

    .challenge-page .status-badge {
        padding: 5px 12px;
        border-radius: 12px;
        font-weight: 600;
        color: #fff;
    }

    .challenge-page .status-active { background-color: #10b981; } /* green */
    .challenge-page .status-past { background-color: #f59e0b; }   /* amber/orange */

    .challenge-page .participate-section {
        margin-top: 35px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .challenge-page .participate-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .challenge-page .participate-button {
        display: inline-block;
        margin-top: 10px;
        padding: 12px 25px;
        background-color: #3b82f6;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .challenge-page .participate-button:hover {
        background-color: #2563eb;
    }

    .challenge-page .back-button {
        display: inline-block;
        margin-top: 25px;
        text-decoration: none;
        color: #6b7280;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .challenge-page .back-button:hover {
        color: #111827;
    }

    @media (max-width: 600px) {
        .challenge-page .challenge-detail-card {
            padding: 20px;
        }

        .challenge-page .challenge-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="challenge-page">
    <div class="challenge-container">
        <div class="challenge-detail-card">
            <h1 class="challenge-title"><?= Html::encode($model->title) ?></h1>

            <p class="challenge-description"><?= nl2br(Html::encode($model->details ?? $model->description)) ?></p>

            <div class="challenge-meta">
                <p>
                    <strong>Status:</strong> 
                    <span class="status-badge status-<?= Html::encode($model->status) ?>">
                        <?= Html::encode(ucfirst($model->status)) ?>
                    </span>
                </p>
                <p><strong>Prize:</strong> <?= Html::encode($model->prize ?? 'Not specified') ?></p>
                <p><strong>Start Date:</strong> <?= $model->start_date ? Yii::$app->formatter->asDate($model->start_date, 'MMM d, yyyy') : 'Not specified' ?></p>
                <p><strong>End Date:</strong> <?= $model->end_date ? Yii::$app->formatter->asDate($model->end_date, 'MMM d, yyyy') : 'Not specified' ?></p>
                <p><strong>Time Left:</strong> <?= $model->getTimeLeft() ?? 'Not specified' ?></p>
                <p><strong>Tags:</strong>
                    <?php foreach ($model->getTagsArray() as $tag): ?>
                        <span class="badge"><?= Html::encode(trim($tag)) ?></span>
                    <?php endforeach; ?>
                </p>
            </div>

            <div class="participate-section">
                <h2 class="participate-title">Participate in this Challenge</h2>
                <p>To participate, submit your entry by creating a post or project related to this challenge and share it with the community.</p>
                <a href="<?= Url::to(['posts/addposts']) ?>" class="participate-button">Submit Your Entry</a>
            </div>

            <a href="<?= Url::to(['site/challenges']) ?>" class="back-button">&larr; Back to Challenges</a>
        </div>
    </div>
</div>
