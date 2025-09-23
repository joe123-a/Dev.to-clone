<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use app\models\Challenges;
use app\models\PostBookmark;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'saved-posts', 'my-posts', 'search'],
                'rules' => [
                    [
                        'actions' => ['logout', 'saved-posts', 'my-posts', 'search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

    public function actionSavedPosts()
    {
        $bookmarkedPosts = Posts::find()
            ->joinWith('bookmarks')
            ->where(['post_bookmark.user_id' => Yii::$app->user->id])
            ->with(['user', 'reactions', 'comments', 'bookmarks'])
            ->orderBy(['post_bookmark.created_at' => SORT_DESC])
            ->all();

        return $this->render('saved-posts', [
            'posts' => $bookmarkedPosts,
        ]);
    }

    public function actionMyPosts()
    {
        $myPosts = Posts::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->with(['user', 'reactions', 'comments', 'bookmarks'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('my-posts', [
            'posts' => $myPosts,
        ]);
    }

    public function actionSearch()
    {
        $query = Yii::$app->request->get('q', '');
        $posts = [];

        if (!empty($query)) {
            $posts = Posts::find()
                ->where(['or',
                    ['like', 'title', $query],
                    ['like', 'description', $query],
                    ['like', 'tags', $query]
                ])
                ->with(['user', 'reactions', 'comments', 'bookmarks'])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        }

        return $this->render('search', [
            'posts' => $posts,
            'query' => $query,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionChallenges()
    {
        $activeChallenges = Challenges::find()->where(['status' => 'active'])->all();
        $pastChallenges = Challenges::find()->where(['status' => 'past'])->all();

        return $this->render('challenges', [
            'activeChallenges' => $activeChallenges,
            'pastChallenges' => $pastChallenges,
        ]);
    }

    public function actionChallenge($id)
    {
        $model = Challenges::findOne($id);
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('The requested challenge does not exist.');
        }

        return $this->render('challenge', ['model' => $model]);
    }
}