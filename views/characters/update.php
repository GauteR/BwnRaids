<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Characters */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Characters',
]) . $model->char_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->char_id, 'url' => ['view', 'id' => $model->char_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="characters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
