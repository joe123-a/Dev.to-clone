<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PostBookmark extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_bookmark';
    }

    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
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