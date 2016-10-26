<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \frontend\components\Common;

/* @var $filter array */
/* @var $pages \yii\data\Pagination */
/* @var $itemTotalCount integer */
/* @var $itemRange string */
/* @var $adverts array */
?>

<div class="properties-listing spacer">

    <div class="row">
        <div class="col-lg-3 col-sm-4 ">

            <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                <?=Html::beginForm(Url::to('/main/main/find/'), 'get') ?>
                <?= Html::textInput('property', $filter['property'], ['class' => 'form-control', 'placeholder' => "Search of Properties"]) ?>
                <div class="row">
                    <div class="col-lg-5">
                        <?= Html::dropDownList(
                            'operation',
                            $filter['operation'],
                            [
                                'Buy' => 'Buy',
                                'Rent' => 'Rent',
                                'Sale' => 'Sale'
                            ],
                            ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-lg-7">
                        <?= Html::dropDownList(
                            'price',
                            $filter['price'],
                            [
                                '150000-200000' => '$150,000 - $200,000',
                                '200000-250000' => '$200,000 - $250,000',
                                '250000-300000' => '$250,000 - $300,000',
                                '300000' => '$300,000 - above'
                            ],
                            ['class' => 'form-control', 'prompt' => 'Price']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::dropDownList(
                            'type',
                            $filter['type'],
                            [
                                'Apartment' => 'Apartment',
                                'Building' => 'Building',
                                'Office Space' => 'Office Space'
                            ],
                            ['class' => 'form-control', 'prompt' => 'Property']) ?>
                    </div>
                </div>
                    <?= Html::submitButton('Find Now', ['class' => 'btn btn-primary'])?>
                <?= Html::endForm() ?>
            </div>


            <?=\frontend\widgets\HotWidget::widget() ?>


        </div>

        <div class="col-lg-9 col-sm-8">
            <div class="sortby clearfix">
                <div class="pull-left result">Showing: <?=$itemRange ?> of <?=$itemTotalCount ?> </div>
                <div class="pull-right">
                    <?= Html::dropDownList(
                        'sort',
                        '',
                        [
                            'ASC' => 'Price: Low to High',
                            'DESC' => 'Price: High to Low'
                        ],
                        ['class' => 'form-control', 'prompt' => 'Sort by']) ?>
            </div>

            </div>
            <div class="row">
                <?
                foreach($adverts as $row):
                    $url = Common::getUrlAdvert($row['id']);
                    ?>
                    <!-- properties -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="properties">
                            <div class="image-holder"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties">
                                <div class="status <?=($row['sold']) ? 'sold' : 'new' ?>"><?=Common::getType($row) ?></div>
                            </div>
                            <h4><a href="<?=$url ?>" ><?=Common::getTitleAdvert($row) ?></a></h4>
                            <p class="price">Price: $<?=$row['price'] ?></p>
                            <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$row['kitchen'] ?></span> </div>
                            <a class="btn btn-primary" href="<?=$url ?>" >View Details</a>
                        </div>
                    </div>
                <? endforeach; ?>



                <div class="clearfix"></div>
                <!-- properties -->
                <div class="center">
                    <? echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </div>

            </div>
        </div>
    </div>
</div>