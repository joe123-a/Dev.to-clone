<?php

namespace app\controllers;
use Yii;
use app\models\LoginForm;

class AuthController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }



public function actionLogin()
{
    $this->layout= "min";
    $model = new LoginForm();

    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->goHome();
    }

    return $this->render('login', ['model' => $model]);
}

    public function actionRegister()
    {
       $this->layout= "min";
        $model = new \app\models\RegisterForm();

    if ($model->load(Yii::$app->request->post()) && $user = $model->register()) {
        Yii::$app->session->setFlash('success', 'Registration successful. You can now log in.');
        return $this->redirect(['auth/login']);
    }

    return $this->render('register', [
        'model' => $model,
    ]);
    }

}
