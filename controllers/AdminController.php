<?php

namespace app\controllers;

use Yii;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest && Yii::$app->user->identiy->user_fk_rank > 2) {
            return $this->goHome();
        }
        return $this->render('index');
    }

}
