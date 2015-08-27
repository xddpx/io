<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\io\models\Document */

$this->title = 'Create Document';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::encode($this->title) ?></span>
        </div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
