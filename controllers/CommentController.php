<?php
namespace app\controllers;

use app\models\Comment;
use app\models\Posts; // <- Correct model import
use Yii;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionCreate($post_id)
    {
        $this->layout ="min";
        $model = new Comment();
        $post = Posts::findOne($post_id); // <- Use Posts instead of Post

        if ($model->load(Yii::$app->request->post())) {
            $model->post_id = $post_id;
            $model->user_id = Yii::$app->user->id; // logged-in user
            $model->created_at = date('Y-m-d H:i:s'); // timestamp for PostgreSQL
            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Comment added successfully.');
                return $this->redirect(['site/index']); // make sure this route exists
            } else {
                Yii::$app->session->setFlash('error', 'Failed to add comment.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
