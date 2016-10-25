<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\db\Query;
use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $this->layout = "bootstrap";
        $query = new Query();
        $result = $query->from('advert')->limit(5)->orderBy('id desc');
        $resultGeneral = $result->all();
        $countGeneral = count($resultGeneral);

        $query = new Query();
        $result = $query->from('advert')->orderBy('id desc')->limit(15);
        $resultFeatured = $result->all();

        $query = new Query();
        $result = $query->from('advert')->where('recommend = 1')->orderBy('id desc')->limit(4);
        $resultRecommended = $result->all();
        $countRecommended = count($resultRecommended);

        unset($query);
        unset($result);

        return $this->render('index',[
            'resultGeneral' => $resultGeneral,
            'countGeneral' => $countGeneral,
            'resultFeatured' => $resultFeatured,
            'resultRecommended' => $resultRecommended,
            'countRecommended' => $countRecommended,
        ]);
    }

    public function actionService() {
        $cache = \Yii::$app->cache;

        $cache->set('test', 123321);

        var_dump($cache->get('test'));

        \Yii::$app->cacheBase64->setValue('test64', 'test_base_64_cache!', 0);
        var_dump(\Yii::$app->cacheBase64->getValue('test64'));
    }

    public function actionEvent() {
        //first way
        $component = new Common();
        //second way
//        $component = \Yii::$app->common;

        //...
        $component->on(Common::EVENT_NOTIFY, [$component, 'notifyAdmin'], "some data");
        $component->sendMail("test@domain.com", "Test", "Test body");
        $component->off(Common::EVENT_NOTIFY, [$component, 'notifyAdmin']);
//        $component->off(Common::EVENT_NOTIFY); // off all event handlers
    }

    public function actionPath(){
        // @yii
        // @app
        //@runtime
        //@webroot
        //@web
        //@vendor
        //@bower
        //@npm
        // @frontend
        // @backend

        print \Yii::getAlias('@test');
    }
}
