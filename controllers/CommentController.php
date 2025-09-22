<?php
namespace app\controllers;

use Yii;
use app\models\Comment;
use app\models\Post;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'reply'],
                        'allow' => true,
                        'roles' => ['@'], // Only logged-in users
                    ],
                ],
            ],
        ];
    }

    public function actionCreate($post_id)
    {
        $model = new Comment();
        $model->post_id = $post_id;
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Comment added successfully.');
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->isGuest && $model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Comment updated successfully.');
                return $this->redirect(['site/index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('You are not authorized to edit this comment.');
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->isGuest && $model->user_id == Yii::$app->user->id) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Comment deleted successfully.');
        } else {
            throw new NotFoundHttpException('You are not authorized to delete this comment.');
        }

        return $this->redirect(['site/index']);
    }

    public function actionReply($parent_id)
    {
        $model = new Comment();
        $parent = $this->findModel($parent_id);
        $model->post_id = $parent->post_id;
        $model->user_id = Yii::$app->user->id;
        $model->parent_id = $parent_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Reply added successfully.');
            return $this->redirect(['site/index']);
        }

        return $this->render('reply', [
            'model' => $model,
            'parent' => $parent,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested comment does not exist.');
    }
}