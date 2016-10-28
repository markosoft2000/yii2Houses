<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use \frontend\components\Common;

/* @var $resultGeneral array */
/* @var $countGeneral integer */
/* @var $resultFeatured array */
/* @var $resultRecommended array */
/* @var $countRecommended integer */
?>

<div class="">

    <div id="slider" class="sl-slider-wrapper">

        <div class="sl-slider">
            <?php
            foreach ($resultGeneral as $row): ?>
            <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="bg-img" style="background-image: url('<?=Common::getImageAdvert($row)[0] ?>')"></div>
                    <h2><a href="<?=Url::to(['/main/main/property-detail', 'id' => $row['id']]) ?>"><?=Common::getTitleAdvert($row) ?></a></h2>
                    <blockquote>
                        <p class="location"><span class="glyphicon glyphicon-map-marker"></span> <?=$row['address'] ?></p>
                        <p><?=Common::substr($row['description']) ?></p>
                        <cite>$ <?=$row['price'] ?></cite>
                    </blockquote>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- /sl-slider -->


        <nav id="nav-dots" class="nav-dots">
            <?php
            for ($i = 0; $i < $countGeneral; $i++): ?>
                <span class="<?=$i == 0 ? 'nav-dot-current' : ''; ?>"></span>
            <?php endfor; ?>
        </nav>

    </div><!-- /slider-wrapper -->
</div>



<div class="banner-search">
    <div class="container">
        <!-- banner -->
        <h3>Buy, Sale & Rent</h3>

        <div class="searchbar">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <?=Html::beginForm(Url::to('/main/main/find/'), 'get') ?>
                    <?= Html::textInput('property', '', ['class' => 'form-control', 'placeholder' => "Search of Properties"]) ?>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 ">
                            <?= Html::dropDownList(
                                'operation',
                                '',
                                [
                                    'Buy' => 'Buy',
                                    'Rent' => 'Rent',
                                    'Sale' => 'Sale'
                                ],
                                ['class' => 'form-control']) ?>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <?= Html::dropDownList(
                                'price',
                                '',
                                [
                                    '150000-200000' => '$150,000 - $200,000',
                                    '200000-250000' => '$200,000 - $250,000',
                                    '250000-300000' => '$250,000 - $300,000',
                                    '300000' => '$300,000 - above'
                                ],
                                ['class' => 'form-control', 'prompt' => 'Price']) ?>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <?= Html::dropDownList(
                                'type',
                                '',
                                [
                                    'Apartment' => 'Apartment',
                                    'Building' => 'Building',
                                    'Office Space' => 'Office Space'
                                ],
                                ['class' => 'form-control', 'prompt' => 'Property']) ?>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <?= Html::submitButton('Find Now', ['class' => 'btn btn-success'])?>
                        </div>
                    </div>
                    <?= Html::endForm() ?>
                </div>

                <?php
                if (Yii::$app->user->isGuest): ?>
                    <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
                        <p>Join now and get updated with all the properties deals.</p>
                        <button class="btn btn-info"   data-toggle="modal" data-target="#loginpop">Login</button>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="properties-listing spacer"> <a href="<?=Url::to() ?>"  class="pull-right viewall">View All Listing</a>
        <h2>Featured Properties</h2>
        <div id="owl-example" class="owl-carousel">
            <?php
            foreach ($resultFeatured as $row): ?>
                <div class="properties">
                    <div class="image-holder"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties"/>
                        <div class="status <?=($row['sold']) ? 'sold' : 'new' ?>"><?=Common::getType($row) ?></div>
                    </div>
                    <h4><a href="<?=Common::getUrlAdvert($row['id']) ?>" ><?=Common::getTitleAdvert($row) ?></a></h4>
                    <p class="price">Price: $<?=$row['price'] ?></p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$row['kitchen'] ?></span> </div>
                    <a class="btn btn-primary" href="<?=Common::getUrlAdvert($row['id']) ?>" >View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="spacer">
        <div class="row">
            <div class="col-lg-6 col-sm-9 recent-view">
                <h3>About Us</h3>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br><a href="about.html" >Learn More</a></p>

            </div>
            <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
                <h3>Recommended Properties</h3>
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < $countRecommended; $i++): ?>
                        <li data-target="#myCarousel" data-slide-to="<?=$i ?>" class="<?=$i == 0 ? 'active' : ''; ?>"></li>
                    <?php endfor; ?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?php
                        $first = true;

                        foreach ($resultRecommended as $row): ?>
                            <div class="item <?= $first ? 'active' : ''; ?>">
                                <div class="row">
                                    <div class="col-lg-4"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="<?=Common::getUrlAdvert($row['id']) ?>" ><?=Common::getTitleAdvert($row) ?></a></h5>
                                        <p class="price">$<?=$row['price'] ?></p>
                                        <a href="<?=Common::getUrlAdvert($row['id']) ?>"  class="more">More Detail</a> </div>
                                </div>
                            </div>
                            <?php $first = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
