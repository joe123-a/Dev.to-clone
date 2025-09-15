<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirm_password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 50],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
            ['username', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->is_active = true;

        return $user->save() ? $user : null;
    }
}
