<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string|null $cover_image
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $published_at
 *
 * @property User $user
 */
class Posts extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'published_at'], 'safe'],
            [['title', 'cover_image'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 20],
            [['status'], 'default', 'value' => 'draft'],
            [['cover_image', 'updated_at', 'published_at'], 'default', 'value' => null],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'cover_image' => 'Cover Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    private $_tags = '';

public function getTags()
{
    return $this->_tags;
}

public function setTags($value)
{
    $this->_tags = $value;
}
public function getComments() {
    return $this->hasMany(Comment::class, ['post_id' => 'id']);
}
 public function getTagsArray()
    {
        return array_filter(array_map('trim', explode(',', $this->tags ?? '')));
    }

}
