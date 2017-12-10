<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Characters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_fk')->textInput() ?>

    <?= $form->field($model, 'class_fk')->textInput() ?>

    <?= $form->field($model, 'char_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'char_realm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'char_mainrole')->textInput() ?>

    <?= $form->field($model, 'char_offrole1')->textInput() ?>

    <?= $form->field($model, 'char_offrole2')->textInput() ?>

    <?= $form->field($model, 'char_offrole3')->textInput() ?>

    <?= $form->field($model, 'char_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
