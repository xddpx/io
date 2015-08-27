<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="error-code"><?php echo $exception->exception->statusCode; ?></div>

<div class="error-text">
    <span class="oops"><?php echo ($exception->exception->statusCode == 404) ? 'OOPS!' : 'OUCH!'; ?></span><br>
    <span class="hr"></span>
    <br>
    <?php echo nl2br($exception->exception->getMessage()); ?>
    <div class="row">
        <a class="REFERER_LINK text-lg" href="<?php echo Yii::$app->user->returnUrl; ?>" title="Go back" style="color: white;"> <i class="fa fa-arrow-left"></i> GO BACK</a>
    </div>
</div> <!-- / .error-text -->
