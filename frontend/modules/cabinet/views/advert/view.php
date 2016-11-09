<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: auto;']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'price',
            'address',
            [//'fk_agent_detail',
                'label' => 'Agent',
                'attribute' => 'fk_agent_detail',
                'value' => ArrayHelper::getValue($model, 'user.username'),
            ],
            'bedroom',
            'livingroom',
            'parking',
            'kitchen',
            'general_image',
            'description:ntext',
            'location',
            'hot:boolean',
            'sold:boolean',
            'type',
            'recommend:boolean',
            'created_at:date',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
