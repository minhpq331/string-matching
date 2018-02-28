<?php

namespace app\controllers;

use app\models\forms\TextMatchingForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new TextMatchingForm();
        $matchingResult = array();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $matchingResult = $model->process();
        }
        return $this->render('index', [
            'model' => $model,
            'matchingResult' => $matchingResult,
        ]);
    }

}
