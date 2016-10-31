<?php
/* @var $this \yii\web\View */
/* @var $content string */

use \yii\helpers\Html;
use \frontend\assets\MainAsset;
use \common\widgets\Alert;

MainAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= Html::encode($this->title); ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?= Html::csrfMetaTags(); ?>
    <?php $this->head(); ?>
</head>

<body>
<?php $this->beginBody(); ?>

<?php
/*if (Yii::$app->session->hasFlash('reg_success')) { // target check for flash message
    echo Yii::$app->session->getFlash('reg_success');

    //or
    echo yii\bootstrap\Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('reg_success')
    ]);
}*/
?>

<?= Alert::widget() ?>

<?= $this->render("//common/header"); ?>

<?= $content ?>

<?= $this->render("//common/footer"); ?>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>