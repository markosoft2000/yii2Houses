<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'placeholder' => "Your name", 'autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'repassword')->passwordInput() ?>

            <?= Html::submitButton('Register', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>

</div>