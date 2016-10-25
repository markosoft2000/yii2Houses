<?
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Subscribe;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ValidateController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['get', 'post'],
                    'subscribe' => ['get', 'post'],
                ],
            ],
        ];
    }

    public function actionLogin() {
        return $this->commonValidate(new LoginForm());
    }

    public function actionSubscribe() {
        return $this->commonValidate(new Subscribe());
    }

    /**
     * @param ActiveRecord $model
     * @return array
     */
    protected function commonValidate($model) {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}