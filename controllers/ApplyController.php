<?php

namespace app\controllers;

class ApplyController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionManage()
    {
        return $this->render('manage');
    }

}
