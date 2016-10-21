<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use \yii\helpers\Url;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row contact">
    <div class="col-lg-6 col-sm-6 ">

        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Full Name', 'autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Message']) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                'captchaAction' => Url::to(['main/captcha'])
            ]) ?>

            <?= Html::submitButton('Send Message', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>


    </div>
    <div class="col-lg-6 col-sm-6 ">
        <div class="well">
            <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d73714.00779523105!2d20.5421473!3d54.7349057!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1476721151205">
            </iframe>
        </div>
    </div>
</div>