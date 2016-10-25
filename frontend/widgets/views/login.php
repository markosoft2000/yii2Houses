<?php
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

?>

<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-6 login">
                    <h4>Login</h4>

                    <?
                    $form = ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'validationUrl' => Url::to(['/validate/login']),
                    ]);
                    ?>

                    <?=$form->field($model, 'username')->textInput(['placeholder' => 'login'])->label(false) ?>
                    <?=$form->field($model, 'password')->passwordInput(['placeholder' => 'password'])->label(false) ?>
                    <?=$form->field($model, 'rememberMe')->checkbox(['style' => 'height: initial;']) ?>

                    <?=Html::submitButton('Login', ['class' => 'btn btn-success']) ?>

                    <? ActiveForm::end(); ?>
                </div>
                <div class="col-sm-6">
                    <h4>New User Sign Up</h4>
                    <p>Join today and get updated with all the properties deal happening around.</p>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='<?=Url::to('main/main/register/') ?>'">Join Now</button>
                </div>

            </div>
        </div>
    </div>
</div>