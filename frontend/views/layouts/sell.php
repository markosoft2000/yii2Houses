<?php
/* @var $this yii\web\View */
/* @var $content string */

$this->title = 'Buy, Sale & Rent';
$this->params['breadcrumbs'][] = $this->title;

$this->beginContent('@app/views/layouts/inner.php'); ?>
    <div class="container">
        <?=$content ?>
    </div>
<?php $this->endContent(); ?>