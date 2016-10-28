<?php

namespace app\modules\main\controllers;

use common\models\Advert;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use frontend\components\Common;
use frontend\filters\FilterAdvert;
use Yii;
use frontend\models\ContactForm;
use frontend\models\SignupForm;
use common\models\LoginForm;
use yii\base\DynamicModel;
use yii\data\Pagination;
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
            ],
            'page' => [// custom action
                'class' => 'yii\web\ViewAction',
                'layout' => 'inner'
            ]
        ];
    }

    public function behaviors() {
        $behaviors =  parent::behaviors();
        $behaviors[] = [
            'class' => FilterAdvert::className(),
            'only' => ['property-detail'],
        ];

        return $behaviors;
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
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->addFlash('info', 'Registration is completed');

                if (Yii::$app->getUser()->login($user)) {

                    return $this->goHome();
                }
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //Yii::$app->user->identity->id;
            return $this->goBack();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
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

    public function actionPropertyDetail($id) {
        $model = Advert::findOne($id);

        $user = $model->user;
        $images = Common::getImageAdvert($model, false);

        $data = ['name', 'email', 'text'];
        $modelFeedback = new DynamicModel($data);
        $modelFeedback->addRule('name','required');
        $modelFeedback->addRule('email','required');
        $modelFeedback->addRule('text','required');
        $modelFeedback->addRule('email','email');


        if (Yii::$app->request->isPost) {
            if ($modelFeedback->load(Yii::$app->request->post()) && $modelFeedback->validate()){
                Yii::$app->common->sendMail('Subject Advert', $modelFeedback->text, $modelFeedback->email, $modelFeedback->name);
            }
        }

        $currentUser = ['email' => '', 'username' => ''];

        if (!Yii::$app->user->isGuest) {
            $currentUser['email'] = Yii::$app->user->identity->email;
            $currentUser['username'] = Yii::$app->user->identity->username;
        }


        $location = [0, 0];

        if ($model->location) {
            $location = str_replace(['(', ')'] , '', $model->location);
            $location = explode(',', $location);
        }

        $coord = new LatLng(['lat' => $location[0], 'lng' => $location[1]]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 18,
        ]);
        $marker = new Marker([
            'position' => $coord,
            'title' => Common::getTitleAdvert($model),
        ]);
        $map->addOverlay($marker);

        return $this->render('propertyDetail',[
            'id' => $id,
            'model' => $model,
            'modelFeedback' => $modelFeedback,
            'user' => $user,
            'images' => $images,
            'currentUser' => $currentUser,
            'map' => $map,
        ]);
    }

    public function actionFind($property='', $operation = '', $price='', $type = '') {
        $this->layout = 'sell';

        $query = Advert::find();
        $query->filterWhere(['like', 'address', $property])
            ->orFilterWhere(['like', 'description', $property])
            ->andFilterWhere(['type' => $type]);

        if ($price) {
            $prices = explode("-", $price);

            if (isset($prices[0]) && isset($prices[1])) {
                $query->andWhere(['between', 'price', $prices[0], $prices[1]]);
            }
            else{
                $query->andWhere(['>=', 'price', $prices[0]]);
            }
        }

        /*if (isset($sort)) {
            $query->orderBy(['price' => 'ASC']);
        }*/

        $countQuery = clone $query;
        $itemTotalCount = $countQuery->count();
        unset($countQuery);
        $pages = new Pagination(['totalCount' => $itemTotalCount]);
        $pages->setPageSize(Yii::$app->params['searchItemPageLimit']);
        $itemRange = ($pages->offset + 1) . '..' . (
                ($pages->offset + $pages->limit) > $itemTotalCount ?
                $itemTotalCount :
                ($pages->offset + $pages->limit)
            );

        $adverts = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render("find", [
            'adverts' => $adverts,
            'pages' => $pages,
            'itemTotalCount' => $itemTotalCount,
            'itemRange' => $itemRange,
            'filter' => [
                'property' => $property,
                'operation' => $operation,
                'price' => $price,
                'type' => $type
            ],
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }
}
