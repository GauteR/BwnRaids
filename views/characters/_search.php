<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CharactersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'char_id') ?>

    <?= $form->field($model, 'user_fk') ?>

    <?= $form->field($model, 'class_fk') ?>

    <?= $form->field($model, 'char_name') ?>

    <?= $form->field($model, 'char_realm') ?>

    <?php // echo $form->field($model, 'char_mainrole') ?>

    <?php // echo $form->field($model, 'char_offrole1') ?>

    <?php // echo $form->field($model, 'char_offrole2') ?>

    <?php // echo $form->field($model, 'char_offrole3') ?>

    <?php // echo $form->field($model, 'char_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
