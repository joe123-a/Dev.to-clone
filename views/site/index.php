<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Check if user is logged in
$username = Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username;
?>

<!-- Post Creation Card -->
<div class="card mb-4">
    <div class="card-body p-3">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=<?= Html::encode($username) ?>" alt="User" class="rounded-circle me-3" width="40" height="40">
            <div class="flex-grow-1">
                <?= Html::a('What\'s on your mind?', ['posts/addposts'], [
                    'class' => 'form-control rounded-pill border-0 text-muted',
                    'style' => 'background: #f8f9fa; cursor: pointer; text-decoration: none; padding: 8px 12px;',
                    'title' => 'Click to write a detailed post',
                ]) ?>
            </div>
            <!-- Optional: Hide the Post button or make it a secondary action -->
            <!-- <button class="btn btn-primary btn-sm ms-2" disabled>Post</button> -->
        </div>
    </div>
</div>

<!-- Welcome Card -->
<div class="welcome-card mb-4 p-4 rounded-3" style="background: linear-gradient(135deg, #3b49df, #2a38c7); color: white;">
    <a class="navbar-brand fw-bold text-primary me-4" href="<?= Yii::$app->homeUrl ?>">
        <?= \yii\helpers\Html::img('@web/images/logoo.webp', [
            'alt' => 'Community Logo',
            'class' => 'me-2',
            'style' => 'height:45px;', // adjust logo size
        ]) ?>
    </a>      
    <h4 class="fw-bold"> You're now a part of the community!</h4>
    <p class="mb-3">Suggested things you can do:</p>
    <div class="d-grid gap-2">
        <a href="#" class="btn btn-light btn-sm text-start">😊 Join the Welcome Thread</a>
        <a href="#" class="btn btn-light btn-sm text-start">✍️ Write your first community post</a>
        <a href="#" class="btn btn-light btn-sm text-start">🎨 Customize your profile</a>
        <a href="#" class="btn btn-light btn-sm text-start">🚀 Join DEV++</a>
        <a href="#" class="btn btn-light btn-sm text-start">✨ Get Started with Google AI</a>
    </div>
</div>

<!-- Latest Discussions -->
<h5 class="mb-3 fw-bold">Latest Discussions</h5>

<?php if (empty($posts)): ?>
    <div class="alert alert-info">
        No discussions yet. Be the first to post!
    </div>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <img src="https://ui-avatars.com/api/?name=<?= Html::encode($post->user->username) ?>" 
                         alt="User" class="rounded-circle me-3" width="40" height="40">
                    <div class="flex-grow-1">
                        <!-- Cover Image -->
                        <?php if ($post->cover_image): ?>
                            <img src="<?= Yii::getAlias('@web') . '/' . $post->cover_image ?>" 
                                 class="img-fluid mt-2 rounded" alt="Cover Image">
                        <?php else: ?>
                            <img src="<?= Yii::getAlias('@web') . '/images/logoo.webp' ?>" 
                                 class="img-fluid mt-2 rounded" alt="Default Cover Image">
                        <?php endif; ?>

                        <!-- Post Title -->
                        <h6 class="card-title mb-1 fw-bold">
                            <?= Html::encode($post->title) ?>
                        </h6>

                        <!-- Author & Timestamp -->
                        <p class="text-muted mb-2 small">
                            By <strong><?=($post->user->username) ?></strong> |
                            <?= Yii::$app->formatter->asDate($post->created_at, 'MMM d, yyyy') ?>
                        </p>

                        <!-- Description with Read More -->
                        <?php
                            $description = nl2br(Html::encode($post->description));
                            $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                        ?>
                        <p>
                            <?= $shortDescription ?>
                            <?php if (strlen($description) > 150): ?>
                                <a href="<?= Url::to(['posts/view', 'id' => $post->id]) ?>" class="text-primary">Read more</a>
                            <?php endif; ?>
                        </p>

                        <!-- Tags -->
                        <?php if (!empty($post->tags)): ?>
                            <p class="text-muted small">
                                #<?= implode(' #', explode(',', $post->tags)) ?>
                            </p>
                        <?php endif; ?>

                        <!-- Reactions and Comments -->
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-muted small me-3">❤️,😊<?= $post->reactions_count ?? 0 ?> Reactions</span>
                            <span class="text-muted small">💬 <?= count($post->comments) ?? 0 ?> Comments</span>
                        </div>

                        <!-- Action Buttons Container -->
                        <div class="d-flex align-items-center mb-3">
                            <!-- Reaction Button -->
                            <?= Html::a('React ❤️ 😊 👍 😂 😢 😡', ['posts/react', 'id' => $post->id], [
                                'class' => 'btn btn-outline-secondary btn-sm me-2',
                                'data-method' => 'post',
                            ]) ?>

                            <!-- Comment Link -->
                            <?= Html::a('Comment', ['comment/create', 'post_id' => $post->id], [
                                'class' => 'btn btn-primary btn-sm me-2'
                            ]) ?>

                            <?php
                            // Simple ownership check (no RBAC needed)
                            $canManagePost = !Yii::$app->user->isGuest && isset($post->user_id) && $post->user_id == Yii::$app->user->id;
                            ?>

                            <?php if ($canManagePost): ?>
                                <!-- Edit Button (only for owner) -->
                                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['posts/update', 'id' => $post->id], [
                                    'class' => 'btn btn-outline-warning btn-sm me-2',
                                    'title' => 'Edit post',
                                ]) ?>

                                <!-- Delete Button (only for owner) -->
                                <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['posts/delete', 'id' => $post->id], [
                                    'class' => 'btn btn-outline-danger btn-sm',
                                    'title' => 'Delete post',
                                    'data-confirm' => 'Are you sure you want to delete this post?',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]) ?>
                            <?php endif; ?>
                        </div>

                        <!-- Display Comments (if any) -->
                        <?php if (!empty($post->comments)): ?>
                            <div class="mt-3">
                                <?php foreach ($post->comments as $comment): ?>
                                    <div class="border-top pt-2 mb-2">
                                        <p class="small mb-0">
                                            <strong><?= Html::encode($comment->user->username) ?></strong>: <?= nl2br(Html::encode($comment->content)) ?>
                                        </p>
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
    <button class="btn btn-outline-primary">Load more discussions</button>
</div>

<style>
    /* Enhance Card Design */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .card-body {
        padding: 1.5rem;
    }

    /* Post Creation Card Styling */
    .rounded-pill {
        transition: background-color 0.3s ease;
    }
    .rounded-pill:hover {
        background-color: #e9ecef;
    }

    /* Welcome Card Styling */
    .welcome-card {
        border-radius: 10px;
        overflow: hidden;
    }
    .welcome-card a {
        text-decoration: none;
    }
    .welcome-card .btn {
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .welcome-card .btn:hover {
        background-color: #ffffff;
        color: #3b49df;
        transform: translateY(-2px);
    }

    /* Button Styling */
    .btn-outline-secondary, .btn-primary {
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover, .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>