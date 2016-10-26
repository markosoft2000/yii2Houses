<?php
/* @var $this \yii\web\View */
/* @var $content string */

use \yii\helpers\Html;
use \yii\helpers\Url;
use \frontend\assets\MainAsset;

MainAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?= Html::csrfMetaTags(); ?>
    <?php $this->head(); ?>
</head>

<body>
<?php $this->beginBody(); ?>


<?= $this->render("//common/header") ?>


<div class="inside-banner">
    <div class="container">
        <span class="pull-right">
            <?=\yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]); ?>
        </span>
        <h2><?= $this->title ?></h2>
    </div>
</div>


<div class="container">
    <div class="spacer">
        <?= $content ?>
    </div>
</div>


<?= $this->render("//common/footer") ?>


<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>