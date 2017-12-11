<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CharactersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Characters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characters-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Characters'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'char_name',
            'char_realm',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
