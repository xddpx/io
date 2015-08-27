<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model frontend\modules\io\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>
<?=
$this->render('io-js', [
    'model' => $model,
])
?>

<?php $form = ActiveForm::begin(['id' => 'document-form']); ?>
<?= (!$model->isNewRecord) ? "" : $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= ($model->isNewRecord) ? "" : $form->field($model, 'content', ['template' => '{input}'])->textarea() ?>
<?php echo $form->errorSummary($model); ?>
<?php if ($model->isNewRecord) { ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-flat btn-lg btn-primary']) ?>
    </div>
<?php } ?>
<?php ActiveForm::end(); ?>

