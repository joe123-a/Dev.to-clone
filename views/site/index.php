<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Check if user is logged in
$username = Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username;
?>

<style>
    :root {
        --primary-color: #3b49df;
        --secondary-color: #2a38c7;
        --background-color: #f8f9fa;
        --white: #ffffff;
        --text-color: #333333;
        --border-color: #e5e5e5;
        --hover-color: #e9ecef;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        color: var(--text-color);
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: var(--white);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 1.75rem;
    }

    /* Post Creation Card */
    .post-creation-card .form-control {
        background: var(--background-color);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        padding: 0.75rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-color);
        transition: background 0.2s ease;
    }

    .post-creation-card .form-control:hover {
        background: var(--hover-color);
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-bottom: 1.5rem;
    }

    .welcome-card .navbar-brand {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .welcome-card .navbar-brand img {
        height: 40px;
        margin-right: 0.75rem;
    }

    .welcome-card h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .welcome-card p {
        font-size: 0.9rem;
        margin-bottom: 1.25rem;
    }

    .welcome-card .btn {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.15);
        color: var(--white);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .welcome-card .btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .welcome-card .btn i {
        margin-right: 0.5rem;
    }

    /* Latest Discussions */
    .discussion-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .post-card .post-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .post-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .post-card .post-meta {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.75rem;
    }

    .post-card .post-description {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .post-card .post-tags {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .post-card .post-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .post-card .btn {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .post-card .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post-card .btn-primary {
        background: var(--primary-color);
        border: none;
    }

    .post-card .btn-primary:hover {
        background: var(--secondary-color);
    }

    .post-card .btn-outline-secondary {
        border-color: var(--border-color);
    }

    .post-card .comment {
        border-top: 1px solid var(--border-color);
        padding-top: 1rem;
        margin-top: 1rem;
        font-size: 0.85rem;
    }

    .post-card .comment p {
        margin-bottom: 0.25rem;
    }

    .load-more-btn {
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-size: 0.9rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .load-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.25rem;
        }

        .welcome-card {
            padding: 1.5rem;
        }

        .welcome-card h4 {
            font-size: 1.25rem;
        }

        .post-card .post-image {
            height: 150px;
        }
    }
</style>

<!-- Post Creation Card -->
<div class="card post-creation-card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=<?= Html::encode($username) ?>" alt="User" class="rounded-circle me-3" width="40" height="40">
            <div class="flex-grow-1">
                <?= Html::a('What\'s on your mind?', ['posts/addposts'], [
                    'class' => 'form-control text-muted',
                    'title' => 'Click to write a detailed post',
                ]) ?>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Card -->
<div class="welcome-card">
    <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
        <?= Html::img('@web/images/logoo.webp', [
            'alt' => 'Community Logo',
            'class' => 'me-2',
            'style' => 'height:40px;',
        ]) ?>
        Community
    </a>
    <h4>You're now a part of the community!</h4>
    <p>Suggested things you can do:</p>
    <div class="d-grid gap-2">
        <a href="#" class="btn"><i class="fas fa-smile"></i> Join the Welcome Thread</a>
        <a href="#" class="btn"><i class="fas fa-pen"></i> Write your first community post</a>
        <a href="#" class="btn"><i class="fas fa-paint-brush"></i> Customize your profile</a>
        <a href="#" class="btn"><i class="fas fa-rocket"></i> Join DEV++</a>
        <a href="#" class="btn"><i class="fas fa-star"></i> Get Started with Google AI</a>
    </div>
</div>

<!-- Latest Discussions -->
<h5 class="discussion-title">Latest Discussions</h5>

<?php if (empty($posts)): ?>
    <div class="alert alert-info rounded-3">
        No discussions yet. Be the first to post!
    </div>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <div class="card post-card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <img src="https://ui-avatars.com/api/?name=<?= Html::encode($post->user->username) ?>" 
                         alt="User" class="rounded-circle me-3" width="40" height="40">
                    <div class="flex-grow-1">
                        <!-- Cover Image -->
                        <?php if ($post->cover_image): ?>
                            <img src="<?= Yii::getAlias('@web') . '/' . $post->cover_image ?>" 
                                 class="post-image" alt="Cover Image">
                        <?php else: ?>
                            <img src="<?= Yii::getAlias('@web') . '/images/logoo.webp' ?>" 
                                 class="post-image" alt="Default Cover Image">
                        <?php endif; ?>

                        <!-- Post Title -->
                        <h6 class="card-title"><?= Html::encode($post->title) ?></h6>

                        <!-- Author & Timestamp -->
                        <p class="post-meta">
                            By <strong><?= Html::encode($post->user->username) ?></strong> |
                            <?= Yii::$app->formatter->asDate($post->created_at, 'MMM d, yyyy') ?>
                        </p>

                        <!-- Description with Read More -->
                        <?php
                            $description = nl2br(Html::encode($post->description));
                            $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                        ?>
                        <p class="post-description">
                            <?= $shortDescription ?>
                            <?php if (strlen($description) > 150): ?>
                                <a href="<?= Url::to(['posts/view', 'id' => $post->id]) ?>" class="text-primary">Read more</a>
                            <?php endif; ?>
                        </p>

                        <!-- Tags -->
                        <?php if (!empty($post->tags)): ?>
                            <p class="post-tags">
                                #<?= implode(' #', explode(',', $post->tags)) ?>
                            </p>
                        <?php endif; ?>

                        <!-- Reactions and Comments -->
                        <div class="d-flex align-items-center post-actions mb-3">
                            <span class="text-muted me-3"><i class="fas fa-heart me-1"></i> <?= $post->reactions_count ?? 0 ?> Reactions</span>
                            <span class="text-muted"><i class="fas fa-comment me-1"></i> <?= count($post->comments) ?? 0 ?> Comments</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="post-actions">
                            <?= Html::a('React <i class="fas fa-heart"></i>', ['posts/react', 'id' => $post->id], [
                                'class' => 'btn btn-outline-secondary',
                                'data-method' => 'post',
                            ]) ?>
                            <?= Html::a('Comment', ['comment/create', 'post_id' => $post->id], [
                                'class' => 'btn btn-primary',
                            ]) ?>
                            <?php
                            $canManagePost = !Yii::$app->user->isGuest && isset($post->user_id) && $post->user_id == Yii::$app->user->id;
                            if ($canManagePost): ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i> Edit', ['posts/update', 'id' => $post->id], [
                                    'class' => 'btn btn-outline-warning',
                                    'title' => 'Edit post',
                                ]) ?>
                                <?= Html::a('<i class="fas fa-trash"></i> Delete', ['posts/delete', 'id' => $post->id], [
                                    'class' => 'btn btn-outline-danger',
                                    'title' => 'Delete post',
                                    'data-confirm' => 'Are you sure you want to delete this post?',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]) ?>
                            <?php endif; ?>
                        </div>

                        <!-- Comments -->
                        <?php if (!empty($post->comments)): ?>
                            <div class="comment">
                                <?php foreach ($post->comments as $comment): ?>
                                    <div class="mb-2">
                                        <p><strong><?= Html::encode($comment->user->username) ?></strong>: <?= nl2br(Html::encode($comment->content)) ?></p>
                                        <p class="text-muted small"><?= Yii::$app->formatter->asDate($comment->created_at, 'MMM d, yyyy') ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Load More Button -->
<div class="text-center mt-4">
    <button class="btn btn-outline-primary load-more-btn">Load more discussions</button>
</div>