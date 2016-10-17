<?
namespace frontend\components;

use yii\base\Component;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject, $text, $emailFrom, $nameFrom = 'SomeName') {
        if(\Yii::$app->mail->compose()
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Support'])// the same email address as auth in the main config 'username'
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
}