<?php

namespace app\controllers;

use app\models\Trening;
use yii\web\Controller;

class TreningController extends Controller
{
    public function actionShowTrenings()
    {
        //tu pobieramy dane
        // tu przekazujemy na widok
        $trenings = Trening::find()->all();
        return $this->render('trenings', ['kupa' => $trenings]);
    }
}