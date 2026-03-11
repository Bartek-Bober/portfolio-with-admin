<?php

namespace app\controllers;

use Yii;
use app\models\Message;
use app\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class MessageController extends Controller
{
    public $layout = 'admin'; 

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Tylko dla zalogowanych adminów
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'], 
                ],
            ],
        ];
    }

    /**
     * Lista wszystkich wiadomości
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Podgląd  wiadomości
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Jeśli wiadomość jest nowa, oznaczamy ją jako przeczytaną
        if ($model->is_read == 0) {
            $model->is_read = 1;
            $model->save(false); 
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Usuwanie wiadomości
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', 'Wiadomość została usunięta.');

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Message::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Żądana wiadomość nie istnieje.');
    }
}