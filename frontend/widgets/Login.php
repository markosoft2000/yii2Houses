<?

namespace frontend\widgets;

use common\models\LoginForm;
use yii\bootstrap\Widget;

class Login extends Widget {

    public function run() {
        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            $controller = \Yii::$app->controller;
            //$controller->redirect($controller->goBack());
            $controller->goBack();
        }

        return $this->render("login", ['model' => $model]);
    }



}