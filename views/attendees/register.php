<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Attendees */
/* @var $form ActiveForm */
?>
<div class="attendees-register">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'event_fk') ?>
        <?= $form->field($model, 'char_fk') ?>
        <?= $form->field($model, 'status_fk') ?>
        <?= $form->field($model, 'signup_note') ?>
        <?= $form->field($model, 'signup_created') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- attendees-register -->
