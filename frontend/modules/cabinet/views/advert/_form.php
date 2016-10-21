<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bedroom')->textInput() ?>

    <?= $form->field($model, 'livingroom')->textInput() ?>

    <?= $form->field($model, 'parking')->textInput() ?>

    <?= $form->field($model, 'kitchen')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hot')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <?= $form->field($model, 'sold')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <?= $form->field($model, 'type')->dropDownList(['Apartment', 'Building', 'Office Space']) ?>

    <?= $form->field($model, 'recommend')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton('Next', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
