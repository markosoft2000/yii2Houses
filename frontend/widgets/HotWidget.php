<?

namespace frontend\widgets;

use yii\bootstrap\Widget;
use yii\db\Query;

class HotWidget extends Widget {
    public $advertId;

    public function run() {
        $query = new Query();
        $result = $query
            ->from('advert')
            ->andFilterWhere(['and',
                ['=', 'hot',  '1'],
                ['!=', 'id',  $this->advertId]
            ])
            ->limit(4)
            ->orderBy('id desc');
        $resultHot = $result->all();
        unset($result);
        unset($query);

        return $this->render("hot", ['resultHot' => $resultHot]);
    }



}