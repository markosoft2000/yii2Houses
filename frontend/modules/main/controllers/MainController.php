<?php

namespace app\modules\main\controllers;

use Yii;
use frontend\models\ContactForm;
use frontend\models\SignupForm;
use yii\web\Response;
use yii\widgets\ActiveForm;
use \yii\web\Controller;


class MainController extends Controller
{
    public $layout = 'inner';

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'test2' => [// custom action
                'class' => 'frontend\actions\TestAction',
                'viewName' => 'index'
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister() {
        $model = new SignupForm();
        //$model->scenario = 'short_register'; //1st way to use a scenario

        //$model = new SignupForm(['scenario' => 'short_register']);// 2nd way to use a scenario

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            /*if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }*/
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionContact() {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $body = '<div>Body: <br><b>' . $model->body . ' </b></div>';
            $body .= '<div>Email: <br><b>' . $model->email . ' </b></div>';

            if (Yii::$app->common->sendMail(
                $model->subject,
                $body,
                $model->email,
                $model->name)
            ) {
                print 'Send success';
            } else {
                print 'Send failed';
            }

        }

        return $this->render('contact', ['model' => $model]);
    }

}
