<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\CommentHelper;

/** @var yii\web\View $this */
/** @var app\models\Posts[] $posts */

$this->title = 'Saved Posts';
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

    .post-card .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .post-card .btn-outline-info:hover {
        background: #17a2b8;
        color: #fff;
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

    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.25rem;
        }

        .post-card .post-image {
            height: 150px;
        }

        .post-card .reply {
            margin-left: 1rem;
        }
    }
</style>

<h5 class="discussion-title">Saved Posts</h5>

<?php if (empty($posts)): ?>
    <div class="alert alert-info rounded-3">
        You haven't bookmarked any posts yet.
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
                            <?= Html::a(
                                $post->isBookmarkedByUser(Yii::$app->user->id) ? '<i class="fas fa-bookmark"></i> Remove Bookmark' : '<i class="far fa-bookmark"></i> Bookmark',
                                ['posts/bookmark', 'id' => $post->id],
                                [
                                    'class' => 'btn btn-outline-info',
                                    'title' => $post->isBookmarkedByUser(Yii::$app->user->id) ? 'Remove from bookmarks' : 'Add to bookmarks',
                                ]
                            ) ?>
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