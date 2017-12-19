<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use app\models\Events;
use app\models\Attendees;
use app\models\Characters;
use app\models\Statuses;

class EventsController extends Controller
{
    public function actionIndex()
    {

        if(isset($_REQUEST['event_id']) && !is_null($_REQUEST['event_id']) && $_REQUEST['event_id'] !== 0) {
            $eventsQuery = Events::find()->where(['=', 'event_id', $_REQUEST['event_id']]);

            $eventsProvider = new ActiveDataProvider([
                'query' => $eventsQuery
            ]);

            $events = $eventsProvider->getModels();
            
            $signups = [];
            $query = Attendees::find()->where(['event_fk' => $events[0]->event_id]);
            $provider = new ActiveDataProvider(['query' => $query]);
            $attendees = $provider->getModels();

            if(!is_null($attendees) && count($attendees) > 0) {
                foreach($attendees as $att) {
                    $charQuery = Characters::find()->where(['char_id' => $att->char_fk]);
                    $charProvider = new ActiveDataProvider(['query' => $charQuery]);
                    $character = $charProvider->getModels();

                    $signups[] = array('char' => $character[0], 'status' => $att->status_fk);
                }
            }
            
            return $this->render('single', array('event' => $events[0], 'signups' => $signups));
        } else {
            $eventsQuery = Events::find()->where(['>', 'event_date', new Expression('DATE_SUB(NOW(), INTERVAL 4 HOUR)')]);

            $eventsProvider = new ActiveDataProvider([
                'query' => $eventsQuery,
                'sort' => [
                    'defaultOrder' => [
                        'event_date' => SORT_ASC,
                        'event_name' => SORT_ASC,
                    ]
                ]
            ]);

            $events = $eventsProvider->getModels();
            
            $signups = [];
            foreach($events as $ev) {
                $query = Attendees::find()->where(['event_fk' => $ev->event_id]);
                $provider = new ActiveDataProvider(['query' => $query]);
                $attendees = $provider->getModels();
    
                if(!is_null($attendees) && count($attendees) > 0) {
                    $charQuery = Characters::find();
                    $charProvider = new ActiveDataProvider(['query' => $charQuery]);
                    $character = $charProvider->getModels();
    
                    $signups[$ev->event_id][] = array('role' => $character[0]->char_mainrole, 'char_id' => $character[0]->char_id);
                }
            }
            return $this->render('index', array('events' => $events, 'signups' => $signups));
        }

    }

    public function actionManage()
    {
        if(isset($_GET['event_id'])) {


            return $this->render('manage_single', array('event' => $event));
        } else {


            return $this->render('manage', array('events' => $events));
        }

    }

}
