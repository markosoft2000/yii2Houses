<?php

/* @var $id integer */
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Advert */
/* @var $modelFeedback \yii\base\DynamicModel */
/* @var $currentUser array */
/* @var $user \common\models\User */
/* @var $images array */

use yii\bootstrap\ActiveForm;
use \frontend\components\Common;

$this->title = 'Property Detail';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="properties-listing spacer">

    <div class="row">
        <div class="col-lg-3 col-sm-4 hidden-xs">

            <?=\frontend\widgets\HotWidget::widget(['advertId' => $id]) ?>

            <div class="advertisement">
                <h4>Advertisements</h4>
                <img src="/images/advertisements.jpg"  class="img-responsive" alt="advertisement">

            </div>

        </div>

        <div class="col-lg-9 col-sm-8 ">

            <h2><?=Common::getTitleAdvert($model) ?></h2>
            <div class="row">
                <div class="col-lg-8">
                    <div class="property-images">
                        <!-- Slider Starts -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators hidden-xs">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <?
                                for ($i = 1; $i < count($images) + 1; $i++): ?>
                                    <li data-target="#myCarousel" data-slide-to="<?=$i ?>" class=""></li>
                                <? endfor; ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="<?=Common::getImageAdvert($model)[0] ?>"  class="properties" alt="properties" />
                                </div>
                                <?
                                foreach($images as $image): ?>
                                    <div class="item">
                                        <img src="<?=$image ?>"  class="properties" alt="properties" />
                                    </div>
                                <? endforeach ?>
                            </div>
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <!-- #Slider Ends -->

                    </div>




                    <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Properties Detail</h4>
                        <p><?=$model->description ?></p>

                    </div>
                    <div><h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
                        <div class="well"><iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="../../../maps.google.com/fi000001.002642&t=m&z=14&output=embed" ></iframe></div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="col-lg-12  col-sm-6">
                        <div class="property-info">
                            <p class="price">$ <?=$model->price ?></p>
                            <p class="area"><span class="glyphicon glyphicon-map-marker"></span> <?=$model->address ?></p>

                            <div class="profile">
                                <span class="glyphicon glyphicon-user"></span> Agent Details
                                <p><?=$user->username ?><br><?=$user->email ?></p>
                            </div>
                        </div>

                        <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
                        <div class="listing-detail">
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$model->bedroom ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$model->livingroom ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$model->parking ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$model->kitchen ?></span> </div>

                    </div>

                    <div class="col-lg-12 col-sm-6 ">
                        <div class="enquiry">
                            <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry</h6>
                            <? $form = ActiveForm::begin(); ?>

                            <?=$form->field($modelFeedback, 'email')->textInput(['value' => $currentUser['email'], 'placeholder' => 'you@yourdomain.com'])->label(false) ?>
                            <?=$form->field($modelFeedback, 'name')->textInput(['value' => $currentUser['username'], 'placeholder' => 'Username'])->label(false) ?>
                            <?=$form->field($modelFeedback, 'text')->textarea(['rows' => 6, 'placeholder' => 'Whats on your mind?'])->label(false) ?>
                            <button type="submit" class="btn btn-primary" name="Submit">Send Message</button>

                            <? ActiveForm::end();
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
