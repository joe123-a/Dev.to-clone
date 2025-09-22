<?php
namespace app\helpers;
use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

class CommentHelper
{
    /**
     * Renders comments and their replies recursively.
     * @param array $comments Array of Comment models
     * @param int $level Nesting level for replies
     */
    public static function renderComments($comments, $level = 0)
    {
        foreach ($comments as $comment) {
            echo '<div class="mb-2 ' . ($level > 0 ? 'reply' : '') . '">';
            echo '<p><strong>' . Html::encode($comment->user->username) . '</strong>: ' . nl2br(Html::encode($comment->content)) . '</p>';
            echo '<p class="text-muted small">';
            echo Yii::$app->formatter->asDate($comment->created_at, 'MMM d, yyyy');
            if (!Yii::$app->user->isGuest && $comment->user_id == Yii::$app->user->id) {
                echo ' | ' . Html::a('Edit', ['comment/update', 'id' => $comment->id], [
                    'class' => 'text-primary',
                    'title' => 'Edit comment',
                ]);
                echo ' | ' . Html::a('Delete', ['comment/delete', 'id' => $comment->id], [
                    'class' => 'text-danger',
                    'title' => 'Delete comment',
                    'data-confirm' => 'Are you sure you want to delete this comment?',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
            }
            echo ' | ' . Html::a('Reply', ['comment/reply', 'parent_id' => $comment->id], [
                'class' => 'text-primary',
                'title' => 'Reply to comment',
            ]);
            echo '</p>';
            if (!empty($comment->replies)) {
                self::renderComments($comment->replies, $level + 1);
            }
            echo '</div>';
        }
    }
}