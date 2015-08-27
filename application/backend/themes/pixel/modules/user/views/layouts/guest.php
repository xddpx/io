<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use backend\themes\pixel\assets\PixelAsset;
use common\widgets\Alert;

AppAsset::register($this);
PixelAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="theme-asphalt page-signin-alt">
        <script>var init = [];</script>
        <?php $this->beginBody() ?>
        <div class="signin-header">
            <a href="<?php echo \yii\helpers\Url::home(); ?>" class="logo">
                <div class="demo-logo bg-primary"><img src="<?php echo \yii\helpers\Url::to(['/themes/pixel/assets/demo/logo-big.png']); ?>" alt="" style="margin-top: -4px;"></div>&nbsp;
                <?php echo Yii::$app->name; ?>
            </a> <!-- / .logo -->
            <a href="<?php echo \yii\helpers\Url::toRoute('auth/signin'); ?>" class="btn btn-primary">Sign In</a>
        </div> <!-- / .header -->
        <?php echo Alert::widget(); ?>
        <?= $content ?>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            init.push(function () {
            });
            window.PixelAdmin.start(init);
        </script>
    </body>
</html>
<?php $this->endPage() ?>
