<?

namespace frontend\widgets;

use common\models\Subscribe;
use yii\bootstrap\Widget;

class SubscribeWidget extends Widget {

    public function run() {
        $model = new Subscribe();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->addFlash('info', 'You are subscribed!');
            \Yii::$app->controller->goBack();
        }

        return $this->render("subscribe", ['model' => $model]);
    }



}