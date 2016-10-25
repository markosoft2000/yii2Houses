<?
namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject, $text, $emailFrom, $nameFrom = 'SomeName') {
        if(Yii::$app->mail->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => 'Support'])// the same email address as auth in the main config 'username'
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()
        ) {
            $this->trigger(self::EVENT_NOTIFY);
            return true;
        }

        return false;
    }

    public function notifyAdmin($event) {
        print "Notify Admin";
        var_dump($event);
    }

    public static function getTitleAdvert($data) {

        return $data['bedroom'] . ' Bed Rooms and ' . $data['kitchen'] . ' Kitchen Room Aparment on Sale';
    }

    public static function getImageAdvert($data, $general = true, $original = false) {
        $image = [];
        $base = '/';//Url::base();

        if ($general) {
            $image[] = $base . Yii::$app->params['advertUploadDirectory'] . DIRECTORY_SEPARATOR .$data['id'] . '/general/small_' . $data['general_image'];
        } else {
            $path = \Yii::getAlias("@frontend/web/" . Yii::$app->params['advertUploadDirectory'] . DIRECTORY_SEPARATOR . $data['id']);
            $files = BaseFileHelper::findFiles($path);

            foreach ($files as $file) {
                if (strstr($file, "small_") && !strstr($file, "general")) {
                    $image[] = $base . Yii::$app->params['advertUploadDirectory'] . DIRECTORY_SEPARATOR . $data['id'] . DIRECTORY_SEPARATOR . basename($file);
                }
            }
        }

        return $image;
    }

    public static function substr($text, $start = 0, $end = 50) {
        return mb_substr($text, $start, $end);
    }

    public static function getType($row) {
        return ($row['sold']) ? 'Sold' : 'New';
    }

}