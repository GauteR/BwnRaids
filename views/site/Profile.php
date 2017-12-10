<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="Profile">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_email') ?>
        <?= $form->field($model, 'user_pass') ?>
        <hr/>
        <?= $form->field($model, 'user_screen_name') ?>
        <?= $form->field($model, 'user_discord') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Profile -->
