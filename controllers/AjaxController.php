<?php

namespace app\controllers;

class AjaxController extends \yii\web\Controller
{
    public function actionSubmit()
    {
        $req = $_REQUEST; $dt = ['success' => false, 'data' => []];

        if($req['source'] === "quick-signup-form") {
            $dt = $this->signup($req);

        }

        $resp = array('success' => $dt['success'], 'request' => $req, 'data' => $dt['data']);
        return json_encode($resp);
    }

    private function signup($req) {
        $success = false; $data = [];

        

        return array('success' => $success, 'data' => $data);
    }
}
