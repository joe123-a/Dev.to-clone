<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PostReaction extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_reaction';
    }

    public function rules()
    {
        return [
            [['post_id', 'user_id', 'reaction_type'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['reaction_type'], 'in', 'range' => ['like', 'love', 'haha', 'wow', 'sad', 'angry']],
            [['created_at'], 'safe'],
            [['post_id'], 'exist', 'targetClass' => Posts::class, 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Posts::class, ['id' => 'post_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}