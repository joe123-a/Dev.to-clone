<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Posts;
use app\models\Challenges;

// Fetch posts for Active Discussions (ordered by comment count, limited to 5)
$activeDiscussions = Posts::find()
    ->select(['id', 'title'])
    ->with(['comments'])
    ->orderBy(['(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id)' => SORT_DESC])
    ->limit(5)
    ->all();

// Fetch posts for Discussion Threads (most recent published posts with #discussion tag, limited to 5)
$discussionThreads = Posts::find()
    ->select(['id', 'title', 'created_at'])
    ->where(['status' => 'published'])
    ->andWhere(['ILIKE', 'tags', '%#discussion%'])
    ->orderBy(['created_at' => SORT_DESC])
    ->limit(5)
    ->all();
if (empty($discussionThreads)) {
    // Fallback: Fetch recent published posts
    $discussionThreads = Posts::find()
        ->select(['id', 'title', 'created_at'])
        ->where(['status' => 'published'])
        ->orderBy(['created_at' => SORT_DESC])
        ->limit(5)
        ->all();
}

// Fetch active challenges (limited to 2)
$challenges = Challenges::find()
    ->where(['status' => 'active'])
    ->limit(2)
    ->all();

// Fetch trending posts (with #latest tag, limited to 3)
$trending = Posts::find()
    ->select(['id', 'title'])
    ->where(['status' => 'published'])
    ->andWhere(['ILIKE', 'tags', '%#latest%'])
    ->orderBy(['created_at' => SORT_DESC])
    ->limit(3)
    ->all();
if (empty($trending)) {
    // Fallback: Fetch recent published posts with high engagement
    $trending = Posts::find()
        ->select(['id', 'title'])
        ->where(['status' => 'published'])
        ->orderBy(['(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id)' => SORT_DESC])
        ->limit(3)
        ->all();
}
?>

<style>
    :root {
        --primary-color: #3b49df;
        --secondary-color: #2a38c7;
        --background-color: #f9f9f9;
        --white: #ffffff;
        --text-color: #333333;
        --border-color: #e5e5e5;
        --hover-color: #f0f0f0;
        --success-color: #22c55e;
        --warning-color: #facc15;
    }

    .sidebar-right {
        background: var(--white);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        height: 100%;
        background: var(--background-color);
    }

    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1rem;
    }

    .card {
        border: none;
        border-radius: 8px;
        background: var(--white);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 1rem;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 1rem;
    }

    .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-text {
        font-size: 0.85rem;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .card-meta a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .card-meta a:hover {
        color: var(--secondary-color);
    }

    .card-link {
        text-decoration: none;
        color: var(--primary-color);
        display: block;
    }

    .card-link:hover {
        color: var(--secondary-color);
    }

    hr {
        border-top: 1px solid var(--border-color);
        margin: 1.5rem 0;
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .sidebar-right {
            padding: 1rem;
        }

        .sidebar-title {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }

        .card-title {
            font-size: 0.85rem;
        }

        .card-text {
            font-size: 0.8rem;
        }

        .card-meta {
            font-size: 0.75rem;
        }
    }
</style>

<!-- Add Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="sidebar-right">
    <!-- Active Discussions -->
    <h5 class="sidebar-title">Active Discussions</h5>
    <?php if (!empty($activeDiscussions)): ?>
        <?php foreach ($activeDiscussions as $discussion): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <a href="<?= Url::to(['posts/view', 'id' => $discussion->id]) ?>" class="card-link">
                        <h6 class="card-title"><?= Html::encode($discussion->title) ?></h6>
                    </a>
                    <?php $commentCount = count($discussion->comments); ?>
                    <?php if ($commentCount > 0): ?>
                        <small class="card-meta">
                            <a href="<?= Url::to(['posts/view', 'id' => $discussion->id, '#' => 'comments']) ?>">
                                <?= $commentCount ?> comment<?= $commentCount > 1 ? 's' : '' ?>
                            </a>
                        </small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">No active discussions available.</p>
            </div>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Challenges Section -->
    <h5 class="sidebar-title">Challenges 🤗 / Just Launched 🚀</h5>
    <?php if (!empty($challenges)): ?>
        <?php foreach ($challenges as $challenge): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <a href="<?= Url::to(['site/challenge', 'id' => $challenge->id]) ?>" class="card-link">
                        <h6 class="card-title"><?= Html::encode($challenge->title) ?></h6>
                        <p class="card-text"><?= Html::encode($challenge->description) ?></p>
                    </a>
                    <small class="card-meta"><?= Html::encode($challenge->getTimeLeft() ?? $challenge->status) ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">No active challenges available.</p>
            </div>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Discussion Threads -->
    <h5 class="sidebar-title">Discussion Threads</h5>
    <?php if (!empty($discussionThreads)): ?>
        <?php foreach ($discussionThreads as $thread): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <a href="<?= Url::to(['posts/view', 'id' => $thread->id]) ?>" class="card-link">
                        <h6 class="card-title"><?= Html::encode($thread->title) ?></h6>
                    </a>
                    <small class="card-meta">
                        <a href="<?= Url::to(['posts/view', 'id' => $thread->id, '#' => 'comments']) ?>">
                            <?= $thread->created_at ? Yii::$app->formatter->asRelativeTime($thread->created_at) : 'New' ?>
                        </a>
                    </small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">No discussion threads available.</p>
            </div>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Trending Section -->
    <h5 class="sidebar-title">Trending</h5>
    <?php if (!empty($trending)): ?>
        <?php foreach ($trending as $trend): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <a href="<?= Url::to(['posts/view', 'id' => $trend->id]) ?>" class="card-link">
                        <h6 class="card-title"><?= Html::encode($trend->title) ?></h6>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">No trending posts available.</p>
            </div>
        </div>
    <?php endif; ?>
</div>