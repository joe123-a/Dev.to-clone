<?php
namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments'; // <-- match your database table
    }

    public function rules()
    {
        return [
            [['post_id', 'user_id', 'content'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            ['content', 'string'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPost()
    {
        return $this->hasOne(Posts::class, ['id' => 'post_id']);
    }
}
