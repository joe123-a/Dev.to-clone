<?php
namespace app\controllers;

use Yii;
use app\models\Posts;
use app\models\PostReaction;
use app\models\PostBookmark;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class PostsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'react', 'bookmark', 'addposts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $post = Posts::findOne(Yii::$app->request->get('id'));
                            return $post && $post->user_id == Yii::$app->user->id;
                        },
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $posts = Posts::find()
            ->with(['user', 'reactions', 'comments', 'bookmarks'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'posts' => $posts,
        ]);
    }

    public function actionCreate()
    {
        return $this->redirect(['addposts']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->isGuest && $model->user_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('You can only delete your own posts.');
        }

        $model->delete();
        return $this->redirect(['site/index']);
    }

    public function actionAddposts()
    {
        $this->layout = "min";
        $model = new \app\models\Posts();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Handle file upload
            $image = UploadedFile::getInstance($model, 'cover_image');
            if ($image) {
                $fileName = uniqid() . '.' . $image->extension;
                $uploadPath = Yii::getAlias('@webroot/uploads/');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $image->saveAs($uploadPath . $fileName);
                $model->cover_image = 'uploads/' . $fileName;
            }

            // Assign logged-in user
            if (!Yii::$app->user->isGuest) {
                $model->user_id = Yii::$app->user->id;
            }

            // Handle tags and challenge_id
            if ($model->challenge_id && !strpos($model->tags, '#challenges')) {
                $model->tags = $model->tags ? $model->tags . ',#challenges' : '#challenges';
            }

            // Set timestamps
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->status === 'published') {
                $model->published_at = date('Y-m-d H:i:s');
            }

            if ($model->validate() && $model->save()) {
                return $this->redirect(['/site/index']);
            }
        }

        return $this->render('addposts', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = \app\models\Posts::find()
            ->with(['user', 'reactions', 'comments', 'bookmarks'])
            ->where(['id' => $id])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionReact($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'You must be logged in to react.');
            return $this->redirect(['site/login']);
        }

        $post = Posts::findOne($id);
        if (!$post) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $userId = Yii::$app->user->id;
        $reactionType = Yii::$app->request->post('reaction_type');

        if (!$reactionType || !in_array($reactionType, ['like', 'love', 'haha', 'wow', 'sad', 'angry'])) {
            Yii::$app->session->setFlash('error', 'Invalid reaction type.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
        }

        $reaction = PostReaction::findOne(['post_id' => $id, 'user_id' => $userId]);

        if ($reaction) {
            // Update existing reaction
            $reaction->reaction_type = $reactionType;
        } else {
            // Create new reaction
            $reaction = new PostReaction();
            $reaction->post_id = $id;
            $reaction->user_id = $userId;
            $reaction->reaction_type = $reactionType;
        }

        if ($reaction->save()) {
            Yii::$app->session->setFlash('success', 'Reaction saved.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to save reaction.');
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }

    public function actionBookmark($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'You must be logged in to bookmark posts.');
            return $this->redirect(['site/login']);
        }

        $post = Posts::findOne($id);
        if (!$post) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $userId = Yii::$app->user->id;
        $bookmark = PostBookmark::findOne(['post_id' => $id, 'user_id' => $userId]);

        if ($bookmark) {
            // Remove bookmark
            $bookmark->delete();
            Yii::$app->session->setFlash('success', 'Post removed from bookmarks.');
        } else {
            // Add bookmark
            $bookmark = new PostBookmark();
            $bookmark->post_id = $id;
            $bookmark->user_id = $userId;
            if ($bookmark->save()) {
                Yii::$app->session->setFlash('success', 'Post bookmarked.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to bookmark post.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }

    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested post does not exist.');
    }
}