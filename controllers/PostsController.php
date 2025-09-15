<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class PostsController extends Controller
{
    // List all posts
    public function actionIndex()
    {
        $posts = Posts::find()
            ->with('user')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'posts' => $posts,
        ]);
    }

    // Create a new post (redirects to addposts for consistency)
    public function actionCreate()
    {
        return $this->redirect(['addposts']);
    }

    // Update a post
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Simple ownership check (no RBAC needed)
        if (!Yii::$app->user->isGuest && $model->user_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('You can only edit your own posts.');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'id' => $model->id]);
        }
        

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    // Delete a post
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Simple ownership check (no RBAC needed)
        if (!Yii::$app->user->isGuest && $model->user_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('You can only delete your own posts.');
        }

        $model->delete();
        return $this->redirect(['site/index']);
    }

    // Helper method to find a post or throw 404
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested post does not exist.');
    }

    public function actionAddposts()
    {
        $this->layout = "min";
        $model = new \app\models\Posts();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Handle file upload
            $image = \yii\web\UploadedFile::getInstance($model, 'cover_image');
            if ($image) {
                $fileName = uniqid() . '.' . $image->extension;
                $uploadPath = Yii::getAlias('@webroot/uploads/');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true); // create uploads folder if not exists
                }
                $image->saveAs($uploadPath . $fileName);
                $model->cover_image = 'uploads/' . $fileName;
            }

            // Assign logged-in user
            if (!Yii::$app->user->isGuest) {
                $model->user_id = Yii::$app->user->id;
            }

            // Set timestamps
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');

            // Save post
            if ($model->save()) {
                // Redirect to site/index after successful submission
                return $this->redirect(['/site/index']);
            }
        }

        return $this->render('addposts', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = \app\models\Posts::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('The requested post does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionReact($id)
    {
        $post = Posts::findOne($id);
        if ($post) {
            $post->reactions_count = ($post->reactions_count ?? 0) + 1;
            $post->save(false);
            Yii::$app->session->setFlash('success', 'Reaction added.');
        } else {
            Yii::$app->session->setFlash('error', 'Post not found.');
        }

        // Redirect back to the referrer (the page user came from)
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}