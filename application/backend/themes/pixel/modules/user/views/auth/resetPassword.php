<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1 class="form-header"><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['class' => 'panel']]); ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'confirm_password')->hint('Please choose your new password', ['class'=>'text-center text-default'])->passwordInput() ?>
    
    <div class="form-actions">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-flat btn-block btn-lg', 'name' => 'reset-password-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
