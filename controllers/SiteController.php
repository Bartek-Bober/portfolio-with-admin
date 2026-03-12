<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Project;
use app\models\Message;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    /**
     * {@inheritdoc}
     */
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
        // 1. Pobieramy projekty
        $projects = \app\models\Project::find()->orderBy(['id' => SORT_DESC])->all();
        
        // 2. Pobieramy umiejętności (sortujemy najpierw po kategorii, potem po kolejności)
        $skills = \app\models\Skill::find()->orderBy(['category' => SORT_ASC, 'order_num' => SORT_ASC])->all();
        
        // 3. Formularz kontaktowy
        $model = \app\models\Message::className() ? new \app\models\Message() : null;

        if ($model && $model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh('#contact'); 
        }

        return $this->render('index', [
            'projects' => $projects,
            'skills' => $skills, // <-- PRZEKAZUJEMY SKILLE DO WIDOKU
            'model' => $model, 
        ]);
    }

    public function actionProjects()
    {
        
        $projects = Project::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('projects', [
            'projects' => $projects,
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

    
    public function actionAbout()
    {
        return $this->render('about');
    }

   
   
}