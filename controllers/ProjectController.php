<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use app\models\Category;
use app\models\Technology;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\helpers\ArrayHelper;

/**
 * ProjectController obsługuje zarządzanie projektami, kategoriami i technologiami.
 */
class ProjectController extends Controller
{
    /**
     * Ustawiamy layout 'admin' dla wszystkich akcji w tym kontrolerze.
     */
    public $layout = 'admin';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Tylko zalogowani użytkownicy
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'], // Usuwanie musi odbywać się przez POST (zabezpieczenie CSRF)
                ],
            ],
        ];
    }

    /**
     * Wyświetla listę wszystkich projektów.
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Tworzy nowy projekt.
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Projekt został pomyślnie dodany!');
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Edytuje istniejący projekt.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Pobieramy ID przypisanych technologii, aby zaznaczyć kafelki w formularzu
        $model->technology_ids = ArrayHelper::getColumn($model->technologies, 'id');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info', 'Zmiany w projekcie zostały zapisane.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Usuwa projekt.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', 'Projekt został pomyślnie usunięty.');

        return $this->redirect(['index']);
    }

    /**
     * Pozwala adminowi na zmianę własnego hasła.
     */
    public function actionPassword()
    {
        if (Yii::$app->request->isPost) {
            $newPassword = Yii::$app->request->post('new_password');
            if (!empty($newPassword) && strlen($newPassword) >= 6) {
                /** @var \app\models\User $user */
                $user = Yii::$app->user->identity;

                $user->setPassword($newPassword);
                $user->generateAuthKey(); // Odświeża klucze sesji
                if ($user->save(false)) { // false pomija walidację pozostałych pól
                    Yii::$app->session->setFlash('success', 'Twoje hasło zostało zmienione!');
                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Hasło musi mieć co najmniej 6 znaków.');
            }
        }
        return $this->render('password');
    }

    // =========================================================================
    // AKCJE AJAX (Wywoływane dynamicznie z formularza)
    // =========================================================================

    /**
     * Dodawanie nowej kategorii przez AJAX.
     */
    public function actionCreateCategoryAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Category();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['success' => true, 'id' => $model->id, 'name' => $model->name];
        }
        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Dodawanie nowej technologii przez AJAX.
     */
    public function actionCreateTechnologyAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Technology();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['success' => true, 'id' => $model->id, 'name' => $model->name, 'icon' => $model->icon_class];
        }
        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Usuwanie kategorii przez AJAX.
     */
    public function actionDeleteCategoryAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        
        if ($id) {
            // Odpinamy kategorię od projektów przed usunięciem
            Project::updateAll(['category_id' => null], ['category_id' => $id]);
            if (Category::findOne($id)->delete()) {
                return ['success' => true];
            }
        }
        return ['success' => false];
    }

    /**
     * Usuwanie technologii przez AJAX.
     */
    public function actionDeleteTechnologyAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        
        if ($id) {
            Yii::$app->db->createCommand()
                ->delete('project_technology', ['technology_id' => $id])
                ->execute();
            
            if (Technology::findOne($id)->delete()) {
                return ['success' => true];
            }
        }
        return ['success' => false];
    }

 
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Żądana strona nie istnieje.');
    }
}