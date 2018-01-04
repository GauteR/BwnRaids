<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Events;
use app\models\Classes;
use app\models\Characters;
use app\models\Attendees;
use app\models\Roles;
use app\models\WarcraftLogs;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $eventsQuery = Events::find()->where(['>', 'event_date', new Expression('DATE_SUB(NOW(), INTERVAL 4 HOUR)')]);

        $eventsProvider = new ActiveDataProvider([
            'query' => $eventsQuery,
            'pagination' => [
                'pagesize' => 4
            ],
            'sort' => [
                'defaultOrder' => [
                    'event_date' => SORT_ASC,
                    'event_name' => SORT_ASC,
                ]
            ]
        ]);

        $events = $eventsProvider->getModels();

        // Counting roles
        $signups = [];
        foreach($events as $ev) {
            $query = Attendees::find()->where(['event_fk' => $ev->event_id]);
            $provider = new ActiveDataProvider(['query' => $query]);
            $attendees = $provider->getModels();

            if(!is_null($attendees) && count($attendees) > 0) {
                $charQuery = Characters::find()->where(['char_id' => $attendees[0]->char_fk]);
                $charProvider = new ActiveDataProvider(['query' => $charQuery]);
                $character = $charProvider->getModels();

                $signups[$ev->event_id][] = $character[0]->char_mainrole;
            }
        }

        if(!Yii::$app->user->isGuest) {
            $charactersQuery = Characters::find()->where(['user_fk' => (int)Yii::$app->user->identity->user_id, 'char_type' => 1]);

            $charactersProvider = new ActiveDataProvider([
                'query' => $charactersQuery
            ]);

            $characters = $charactersProvider->getModels();
            if(!is_null($characters) && count($characters) > 0) {
                $classQuery = Classes::find()->where(['class_id' => (int)$characters[0]->class_fk ]);
                
                $classProvider = new ActiveDataProvider([
                    'query' => $classQuery
                ]);

                $main_class = $classProvider->getModels();

                $logs = new WarcraftLogs();
                
                return $this->render('index', ['events' => $events, 'characters' => $characters, 'main_char' => $characters[0], 'main_class' => $main_class, 'signups' => $signups, 'reports' => $logs->fetchGuildReports() ]);
            } else {
                return $this->render('index', ['events' => $events, 'signups' => $signups ]);
            }
        } else {
            return $this->render('index', ['events' => $events, 'signups' => $signups ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionRegister()
    {
        $model = new \app\models\Users();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    

    public function actionProfile()
    {
        $model = new \app\models\Users();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('Profile', [
            'model' => $model,
        ]);
    }
}
