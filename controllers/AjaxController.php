<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Attendees;

class AjaxController extends \yii\web\Controller
{
    public function actionSubmit()
    {
        $req = $_REQUEST; $dt = ['success' => false, 'data' => [], 'error' => []];

        if($req['source'] === "quick-signup-form") {
            $dt = $this->signup($req);
        }

        $resp = array(
            'success' => $dt['success'], 
            'data' => isset($dt['data']) ? $dt['data'] : [], 
            'error' => isset($dt['error']) ? $dt['error'] : []
        );
        return json_encode($resp);
    }

    public function actionGetsignupdata()
    {
        $req = $_REQUEST; $resp = array('success' => false);

        try {
            $query = Attendees::find()->where(['event_fk' => (int)$req['event_fk'], 'char_fk' => (int)$req['char_fk']]);
            $provider = new ActiveDataProvider(['query' => $query]);
            $signups = $provider->getModels();

            if(!is_null($signups)) {
                $signup = $signups[0];

                $resp = array(
                    'success' => true,
                    'data' => [
                        'attendee_id' => (int)$signup->attendee_id,
                        'event_fk' => (int)$signup->event_fk,
                        'char_fk' => (int)$signup->char_fk,
                        'status_fk' => (int)$signup->status_fk,
                        'signup_note' => (string)$signup->signup_note,
                        'signup_created' => (string)$signup->signup_created
                    ]
                );

            } else {
                $resp = array('success' => false, 'error' => 'Not found');
            }
        } catch(Exception $ex) {
            $resp = array('success' => false, 'error' => $ex->getMessage());
        }
        return json_encode($resp);
    }

    private function signup($req) 
    {
        try {
            $query = Attendees::find()->where(['event_fk' => (int)$req['event_fk'], 'char_fk' => (int)$req['char_fk']]);
            $provider = new ActiveDataProvider(['query' => $query]);
            $attendees = $provider->getModels();

            if(!is_null($attendees)) {
                $event = $attendees[0];
            } else {
                $event = new Attendees();
            }

            $event->event_fk = (int)$req['event_fk'];
            $event->char_fk = (int)$req['char_fk'];
            $event->status_fk = (int)$req['status_fk'];
            $event->signup_note = (string)$req['signup_note'];

            if($event->save()) {
                return array('success' => true, 'data' => $event);
            } else {
                return array('success' => false, 'error' => $event->getErrors());
            }
        } catch(Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }
}
