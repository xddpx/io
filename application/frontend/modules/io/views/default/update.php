<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\io\models\Document */

$this->title = 'Update Document: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="document-create">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::encode($this->title) ?></span>
        </div>
        <div class="panel-body no-padding">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
<input type="hidden" id="document_id" value="<?= $model->id; ?>">
<input type="hidden" id="auth_key" value="<?= Yii::$app->user->identity->getAuthKey(); ?>">
