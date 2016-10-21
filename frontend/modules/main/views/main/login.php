<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
        <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>

        <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>

        <?php ActiveForm::end(); ?>
    </div>

</div>