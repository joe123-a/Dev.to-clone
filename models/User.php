<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['username', 'email', 'password_hash'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['is_active'], 'boolean'],
            [['username'], 'string', 'max' => 50],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_active' => 'Is Active',
        ];
    }

    // ================= IdentityInterface methods =================

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'is_active' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Optional if you don’t use API tokens
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null; // Optional if you don't need "remember me" via cookie auth key
    }

    public function validateAuthKey($authKey)
    {
        return true; // Optional if you don't use auth keys
    }
}
