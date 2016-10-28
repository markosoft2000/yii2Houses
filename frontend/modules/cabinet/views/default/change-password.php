<?php

/* @var $this yii\web\View */

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model,'password')->passwordInput() ?>
    <?=$form->field($model,'repassword')->passwordInput() ?>


    <?= Html::submitButton('Change password', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>

</div>