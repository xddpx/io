<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="form-header"><?= Html::encode($this->title) ?></h1>

<!--<h4 class="form-header">Please fill out your email. A link to reset password will be sent there.</h4>-->

<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'options' => ['class' => 'panel']]); ?>
<?= $form->field($model, 'email')->hint("Please fill out your email. A link to reset password will be sent there.", ['class' => 'text-center text-default']) ?>
<div class="form-actions">
    <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-flat btn-block btn-lg', 'name' => 'request-password-reset-button']) ?>
</div>

<?php ActiveForm::end(); ?>
