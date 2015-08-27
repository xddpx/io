<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign in to your Account';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="form-header"><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'panel']]);
?>
<?php
// Email input
$email = $form->field($model, 'email', ['options' => ['class' => 'form-group']]);
$email->template = "{input}\n{hint}\n{error}";
echo $email->textInput(['maxlength' => 255, 'placeholder' => 'Your email', 'class' => 'form-control input-lg']);
?>
<?php
// Password input
$forgot_url = \yii\helpers\Url::toRoute(['auth/request-password-reset']);
$password = $form->field($model, 'password', ['options' => ['class' => 'form-group signin-password']]);
$password->template = "{input}<a href='$forgot_url' class='forgot'>Forgot?</a>\n{hint}\n{error}";
echo $password->passwordInput(['maxlength' => 255, 'placeholder' => 'Password', 'class' => 'form-control input-lg']);
?>
<?php
// Remember me checkbox
$rememberMe = $form->field($model, 'rememberMe', ['options' => ['class' => 'row']]);
//$rememberMe->template = "{input}";
//$rememberMe->template = "<label>{input}\n<span class='lbl'>Remember me</span></label>";
echo $rememberMe->checkbox(['class' => 'px']);
?>
<div class="form-actions">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-flat btn-block btn-lg', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
