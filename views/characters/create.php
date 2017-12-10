<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Characters */

$this->title = Yii::t('app', 'Create Characters');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
