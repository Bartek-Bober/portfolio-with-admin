<?php

namespace app\controllers;

use app\models\Project;
use app\models\ProjectSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ProjectController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
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

    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $this->handleTechnologies($model); // Konwersja przed zapisem
                
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Projekt został pomyślnie dodany do bazy!');
                    return $this->redirect(['index']); // Powrót do listy jest wygodniejszy niż podgląd
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Rozbijamy string na tablicę, żeby checkboxy się "zaświeciły"
        if (!empty($model->technologies) && is_string($model->technologies)) {
            $model->technologies = explode(', ', $model->technologies);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $this->handleTechnologies($model); // Konwersja przed zapisem
            
            if ($model->save()) {
                Yii::$app->session->setFlash('info', 'Zmiany w projekcie zostały zapisane.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', 'Projekt został usunięty.');

        return $this->redirect(['index']);
    }

    private function handleTechnologies($model)
    {
        if (is_array($model->technologies)) {
            $model->technologies = implode(', ', $model->technologies);
        }
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Strona nie istnieje.');
    }
}