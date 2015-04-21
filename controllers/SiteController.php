<?php

namespace app\controllers;

use app\models\Masters;
use app\models\Schedule;
use Yii;
use yii\filters\AccessControl;
use yii\validators\DateValidator;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public $layout = 'copy';

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

    public function actionIndex()
    {
        $masters = Masters::findAll([
            'display' => Masters::ACTIVE,
        ]);
        return $this->render('index',['masters'=>$masters]);
    }

    public function actionUpdateDay()
    {
        $data['success'] = false;
        $request['Schedule'] = \Yii::$app->request->post();
        if ($request['Schedule']['holiday']==1) {
            $request['Schedule']['start_time'] = $request['Schedule']['end_time'] = NULL;
        } else {
            if ($request['Schedule']['start_time']>=$request['Schedule']['end_time'])
                $data['data'] = 'Окончание времени работы должно быть больше начала работы';
            return json_encode($data);
        }
        $model = Schedule::findOne(['master_id' => $request['Schedule']['master_id'], 'date' => $request['Schedule']['date']]);
        if (!$model) $model = new Schedule();

        if (\Yii::$app->request->isAjax) {


            if ($model->load($request) && $model->save()) {
                $data['success'] = true;
            }
            return json_encode($data);
        }
    }

    public function actionFeed()
    {

        $request = \Yii::$app->request->post();

        if (\Yii::$app->request->isAjax) {
            $data['success'] = false;

            $schedule = Schedule::find()
                ->where('date >= :start AND date < :end AND master_id = :master_id',[':start'=>$request['start'],':end'=>$request['end'],':master_id'=>$request['master_id']])
                ->asArray()
                ->all();

            $data = Schedule::items($schedule);

            return json_encode($data);
        }
    }
    public function actionSubmit()
    {
        $data['success'] = false;
        $request = \Yii::$app->request->post();
        $validator = new DateValidator();
        $validator->format = 'php:Y-m-d';

        if (!$validator->validate($request['date']))
            $data['data'] = 'Неверный формат даты "Начиная с"';

        if ($request['start_time']>=$request['end_time'])
            $data['data'] = 'Окончание времени работы должно быть больше начала работы';

        if (isset($data['data'])) return json_encode($data);

        if (\Yii::$app->request->isAjax) {
            $days = $request['week_count']*7;
            $timestamp = strtotime($request['date']);
            $date_end = date("Y-m-d", mktime(0, 0, 0, date("m",$timestamp), date("d",$timestamp)+$days, date("Y",$timestamp)));
            Schedule::deleteAll('date >= :date AND date < :date_end AND master_id = :master_id',[':date'=>$request['date'],':date_end'=>$date_end,':master_id'=>$request['master_id']]);
            $cycle = $request['count'] + $request['after'];
            for ($i=0;$i<$days;$i++) {
                $date = date("Y-m-d", mktime(0, 0, 0, date("m",$timestamp), date("d",$timestamp)+$i, date("Y",$timestamp)));
                $model = new Schedule();
                $model->master_id = $request['master_id'];
                $model->date = $date;
                if (fmod($i,$cycle)<$request['count']) {
                    $model->holiday = 0;
                    $model->start_time = date("H:i:s", mktime($request['start_time'], 0, 0, 1, 1, date("Y")));
                    $model->end_time = date("H:i:s", mktime($request['end_time'], 0, 0, 1, 1, date("Y")));
                } else {
                    $model->holiday = 1;
                }
                $model->save();
            }

            $data['success'] = true;

            return json_encode($data);
        }
    }
}
