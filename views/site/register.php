<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Register';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
?>

<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Bwn</b>Raids</a>
    </div>
    <!-- /.login-logo -->
    <div class="register-box-body">
        <p class="login-box-msg">Register on BwnRaids</p>

        <?php $form = ActiveForm::begin(['id' => 'register-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'user_screen_name', $fieldOptions3)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('user_screen_name')]) ?>

        <?= $form
            ->field($model, 'user_email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('user_email')]) ?>

        <?= $form
            ->field($model, 'user_pass', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('user_pass')]) ?>

        <?= $form
            ->field($model, 'user_access_token')
            ->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>', ])
            ->label('Repeat this word:') ?>

        <div class="row">
            <div class="col-xs-8">&nbsp;</div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'register-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>
        <br>
        <a href="/site/login" class="text-center">Already registered? Log in instead.</a>
    </div>
    <!-- /.register-box-body -->
</div><!-- /.register-box -->