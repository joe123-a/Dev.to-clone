<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\CommentHelper;

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

    .post-card .reply {
        margin-left: 2rem;
        border-left: 2px solid var(--border-color);
        padding-left: 1rem;
    }

    .see-all-comments {
        font-size: 0.85rem;
        color: var(--primary-color);
        text-decoration: none;
        margin-top: 0.5rem;
        display: inline-block;
    }

    .see-all-comments:hover {
        text-decoration: underline;
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

    /* Reaction Dropdown */
    .reaction-dropdown .dropdown-menu {
        min-width: 100px;
        padding: 0.5rem;
    }

    .reaction-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        font-size: 0.85rem;
    }

    .reaction-dropdown .dropdown-item i {
        margin-right: 0.5rem;
    }

    .reaction-counts {
        font-size: 0.85rem;
        color: #6c757d;
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

        .post-card .reply {
            margin-left: 1rem;
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
                            <?php
                            $reactionCounts = array_count_values(array_column($post->reactions, 'reaction_type'));
                            $totalReactions = count($post->reactions);
                            $userReaction = !Yii::$app->user->isGuest ? $post->getUserReaction(Yii::$app->user->id) : null;
                            ?>
                            <span class="text-muted me-3">
                                <i class="fas fa-heart me-1"></i> <?= $totalReactions ?> Reactions
                                <?php if ($totalReactions > 0): ?>
                                    <span class="reaction-counts">
                                        (<?php
                                        $counts = [];
                                        foreach (['like' => '👍', 'love' => '❤️', 'haha' => '😂', 'wow' => '😮', 'sad' => '😢', 'angry' => '😣'] as $type => $emoji) {
                                            if (isset($reactionCounts[$type])) {
                                                $counts[] = "$emoji {$reactionCounts[$type]}";
                                            }
                                        }
                                        echo implode(', ', $counts);
                                        ?>)
                                    </span>
                                <?php endif; ?>
                            </span>
                            <span class="text-muted"><i class="fas fa-comment me-1"></i> <?= count($post->comments) ?> Comments</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="post-actions">
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="dropdown reaction-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="reactionDropdown<?= $post->id ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-heart"></i> <?= $userReaction ? ucfirst($userReaction->reaction_type) : 'React' ?>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="reactionDropdown<?= $post->id ?>">
                                        <?php foreach (['like' => '👍 Like', 'love' => '❤️ Love', 'haha' => '😂 Haha', 'wow' => '😮 Wow', 'sad' => '😢 Sad', 'angry' => '😣 Angry'] as $type => $label): ?>
                                            <li>
                                                <?php
                                                echo Html::beginForm(['posts/react', 'id' => $post->id], 'post', ['class' => 'd-inline']);
                                                echo Html::hiddenInput('reaction_type', $type);
                                                echo Html::submitButton($label, [
                                                    'class' => 'dropdown-item' . ($userReaction && $userReaction->reaction_type == $type ? ' active' : ''),
                                                ]);
                                                echo Html::endForm();
                                                ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <?= Html::a('React <i class="fas fa-heart"></i>', ['site/login'], [
                                    'class' => 'btn btn-outline-secondary',
                                    'title' => 'Login to react',
                                ]) ?>
                            <?php endif; ?>
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
                                <?php
                                // Limit to 3 comments
                                $commentLimit = 3;
                                $displayedComments = array_slice($post->comments, 0, $commentLimit);
                                CommentHelper::renderComments($displayedComments);
                                ?>
                                <?php if (count($post->comments) > $commentLimit): ?>
                                    <a href="<?= Url::to(['posts/view', 'id' => $post->id]) ?>" class="see-all-comments">
                                        See all <?= count($post->comments) ?> comments
                                    </a>
                                <?php endif; ?>
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