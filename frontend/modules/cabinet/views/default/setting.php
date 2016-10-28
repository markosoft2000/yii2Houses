<?php

/* @var $this yii\web\View */

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \common\components\UserComponent;

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="advert-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?=Html::img(UserComponent::getUserImage(Yii::$app->user->id), ['width' => 200]) ?>

    <?=$form->field($model, 'username') ?>
    <?=$form->field($model, 'email') ?>
    <?=Html::label('Avatar') ?>
    <?=Html::fileInput('avatar') ?>
    <br>
    <br>

    <?=Html::submitButton('Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>
</div>