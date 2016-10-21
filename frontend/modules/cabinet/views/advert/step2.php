<?php
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\Url;
use \kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */
/* @var $image string */
/* @var $images_add string */

?>

<?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?
        echo $form->field($model, 'general_image')->widget(FileInput::classname(),[
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                /*'uploadUrl' => Url::to(['file-upload-general']),
                'uploadExtraData' => [
                    'advert_id' => $model->id,
                ],*/
                'uploadUrl' => Url::to(['file-upload-image']),
                'uploadExtraData' => [
                    'advert_id' => $model->id,
                    'advert_image_type' => 'general',
                ],

                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $image,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false
            ]
        ]);
        ?>

    </div>

    <div class="row">
        <?
        echo Html::label('Images');

        echo FileInput::widget([
            'name' => 'images',
            'options' => [
                'accept' => 'image/*',
                'multiple'=>true
            ],
            'pluginOptions' => [
                /*'uploadUrl' => Url::to(['file-upload-images']),
                'uploadExtraData' => [
                    'advert_id' => $model->id,
                ],*/
                'uploadUrl' => Url::to(['file-upload-image']),
                'uploadExtraData' => [
                    'advert_id' => $model->id,
                    'advert_image_type' => 'extend',
                ],

                'overwriteInitial' => false,
                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $images_add,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false
            ]
        ]);
        ?>

    </div>
    <br/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>