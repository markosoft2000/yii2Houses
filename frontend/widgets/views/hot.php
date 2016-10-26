<?php

use \yii\helpers\Url;
use \frontend\components\Common;

/* @var $resultHot array */

?>
<div class="hot-properties hidden-xs">
    <h4>Hot Properties</h4>
    <?php
    foreach ($resultHot as $row): ?>
        <div class="row">
            <div class="col-lg-4 col-sm-5"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive img-circle" alt="properties"/></div>
            <div class="col-lg-8 col-sm-7">
                <h5><a href="<?=Common::getUrlAdvert($row['id']) ?>" ><?=Common::getTitleAdvert($row) ?></a></h5>
                <p class="price">$<?=$row['price'] ?></p> </div>
        </div>
    <?php endforeach; ?>
</div>