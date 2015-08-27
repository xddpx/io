<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create your Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="form-header"><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'panel']]); ?>

<?= $form->field($model, 'firstname') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'confirm_password')->passwordInput() ?>

<div class="form-actions">
    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-flat btn-block btn-lg', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>
