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
    <body class="theme-asphalt main-menu-animated main-navbar-fixed main-menu-fixed">
        <?php $this->beginBody() ?>
        <script>var init = [];</script>
        <div id="main-wrapper">
            <!-- 2. $MAIN_NAVIGATION ===========================================================================
                    Main navigation
            -->
            <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
                <!-- Main menu toggle -->
                <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
                <div class="navbar-inner">
                    <!-- Main navbar header -->
                    <div class="navbar-header">
                        <!-- Logo -->
                        <a href="<?php echo \yii\helpers\Url::home(); ?>" class="navbar-brand">
                            <div><img alt="Pixel Admin" src="<?php echo \yii\helpers\Url::to(['/themes/pixel/assets/demo/logo-big.png']); ?>"></div>
                            <?php echo Yii::$app->name; ?>
                        </a>
                        <!-- Main navbar toggle -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
                    </div> <!-- / .navbar-header -->
                    <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
                        <div>
                            <?php
                            $menuItems = [
                                ['label' => 'Home', 'url' => ['/site/index']],
                                ['label' => 'About', 'url' => ['/site/about']],
                                ['label' => 'Contact', 'url' => ['/site/contact']],
                            ];
                            echo Nav::widget([
                                'options' => ['class' => 'nav navbar-nav'],
                                'items' => $menuItems,
                            ]);
                            ?>

                            <div class="right clearfix">
                                <ul class="nav navbar-nav pull-right right-navbar-nav">
                                    <li class="nav-icon-btn nav-icon-btn-danger dropdown">
                                        <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="label">5</span>
                                            <i class="nav-icon fa fa-bullhorn"></i>
                                            <span class="small-screen-text">Notifications</span>
                                        </a>
                                        <script>
                                            init.push(function () {
                                                $('#main-navbar-notifications').slimScroll({height: 250});
                                            });
                                        </script>

                                        <div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
                                            <div class="notifications-list" id="main-navbar-notifications">

                                                <div class="notification">
                                                    <div class="notification-title text-danger">SYSTEM</div>
                                                    <div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                                                    <div class="notification-ago">12h ago</div>
                                                    <div class="notification-icon fa fa-hdd-o bg-danger"></div>
                                                </div> <!-- / .notification -->

                                                <div class="notification">
                                                    <div class="notification-title text-info">STORE</div>
                                                    <div class="notification-description">You have <strong>9</strong> new orders.</div>
                                                    <div class="notification-ago">12h ago</div>
                                                    <div class="notification-icon fa fa-truck bg-info"></div>
                                                </div> <!-- / .notification -->

                                                <div class="notification">
                                                    <div class="notification-title text-default">CRON DAEMON</div>
                                                    <div class="notification-description">Job <strong>"Clean DB"</strong> has been completed.</div>
                                                    <div class="notification-ago">12h ago</div>
                                                    <div class="notification-icon fa fa-clock-o bg-default"></div>
                                                </div> <!-- / .notification -->

                                                <div class="notification">
                                                    <div class="notification-title text-success">SYSTEM</div>
                                                    <div class="notification-description">Server <strong>up</strong>.</div>
                                                    <div class="notification-ago">12h ago</div>
                                                    <div class="notification-icon fa fa-hdd-o bg-success"></div>
                                                </div> <!-- / .notification -->

                                                <div class="notification">
                                                    <div class="notification-title text-warning">SYSTEM</div>
                                                    <div class="notification-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
                                                    <div class="notification-ago">12h ago</div>
                                                    <div class="notification-icon fa fa-hdd-o bg-warning"></div>
                                                </div> <!-- / .notification -->

                                            </div> <!-- / .notifications-list -->
                                            <a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
                                        </div> <!-- / .dropdown-menu -->
                                    </li>
                                    <li class="nav-icon-btn nav-icon-btn-success dropdown">
                                        <a href="mail.ru" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="label">10</span>
                                            <i class="nav-icon fa fa-envelope"></i>
                                            <span class="small-screen-text">Income messages</span>
                                        </a>

                                        <!-- MESSAGES -->

                                        <!-- Javascript -->
                                        <script>
                                            init.push(function () {
                                                $('#main-navbar-messages').slimScroll({height: 250});
                                            });
                                        </script>
                                        <!-- / Javascript -->

                                        <div class="dropdown-menu widget-messages-alt no-padding" style="width: 300px;">
                                            <div class="messages-list" id="main-navbar-messages">

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/2.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Robert Jang</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/3.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Michelle Bortz</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/4.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Timothy Owens</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/5.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Denise Steiner</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/2.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Robert Jang</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/2.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Robert Jang</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/3.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Michelle Bortz</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/4.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Timothy Owens</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/5.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Denise Steiner</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                                <div class="message">
                                                    <img src="themes/pixel/assets/demo/avatars/2.jpg" alt="" class="message-avatar">
                                                    <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                                    <div class="message-description">
                                                        from <a href="#">Robert Jang</a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                        2h ago
                                                    </div>
                                                </div> <!-- / .message -->

                                            </div> <!-- / .messages-list -->
                                            <a href="#" class="messages-link">MORE MESSAGES</a>
                                        </div> <!-- / .dropdown-menu -->
                                    </li>
                                    <!-- /3. $END_NAVBAR_ICON_BUTTONS -->

                                    <li>
                                        <form class="navbar-form pull-left">
                                            <input type="text" class="form-control" placeholder="Search">
                                        </form>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                            <img src="<?php
                                            if (!Yii::$app->user->isGuest) {
                                                echo Yii::$app->user->getIdentity()->getAvatarUrl();
                                            }
                                            ?>" alt="">
                                            <span>
                                                <?php
                                                if (!Yii::$app->user->isGuest) {
                                                    echo Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname;
                                                }
                                                ?>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><span class="label label-warning pull-right">New</span>Profile</a></li>
                                            <li><a href="#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php
                                                echo Html::a('<i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out', \yii\helpers\Url::toRoute(['user/auth/logout']), ['data-method' => 'post']);
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> <!-- / .navbar-nav -->
                            </div> <!-- / .right -->
                        </div>
                    </div> <!-- / #main-navbar-collapse -->
                </div> <!-- / .navbar-inner -->
            </div> <!-- / #main-navbar -->
            <div id="main-menu" role="navigation">
                <div id="main-menu-inner">
                    <div class="menu-content top" id="menu-content-demo">
                        <!-- Menu custom content demo
                                 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
                                 Javascript: html/themes/pixel/assets/demo/demo

                        -->
                        <div>
                            <div class="text-bg">
                                <span class="text-slim">
                                    <?php
                                    if (!Yii::$app->user->isGuest) {
                                        echo Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname;
                                    }
                                    ?>
                                </span> 
                            </div>

                            <img src="<?php
                            if (!Yii::$app->user->isGuest) {
                                echo Yii::$app->user->getIdentity()->getAvatarUrl();
                            }
                            ?>" alt="" class="">
                            <div class="btn-group">
                                <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                                <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
                                <?php
                                echo Html::a('<i class="fa fa-power-off"></i>', \yii\helpers\Url::toRoute(['user/auth/logout']), ['data-method' => 'post', 'class' => 'btn btn-xs btn-danger btn-outline dark']);
                                ?>
                            </div>
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                    <ul class="navigation">
                        <li>
                            <a href="index.html"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
                        </li>
                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Layouts</span><span class="label label-warning">Updated</span></a>
                            <ul>
                                <li>
                                    <a tabindex="-1" href="layouts-grid.html"><span class="mm-text">Grid</span></a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="layouts-main-menu.html"><i class="menu-icon fa fa-th-list"></i><span class="mm-text">Main menu</span><span class="label label-warning">Updated</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul> <!-- / .navigation -->
                    <div class="menu-content">
                        <a href="pages-invoice.html" class="btn btn-primary btn-block btn-outline dark">Create Invoice</a>
                    </div>
                </div> <!-- / #main-menu-inner -->
            </div> <!-- / #main-menu -->
            <!-- /4. $MAIN_MENU -->


            <div id="content-wrapper">
                <div class="page-header">
                    <h1> <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        ?>
                    </h1>
                </div>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div> <!-- / #content-wrapper -->
            <div id="main-menu-bg"></div>
        </div> <!-- / #main-wrapper -->
        <!--===================================================================================================-->
        <?php $this->endBody() ?>
        <script type="text/javascript">
            init.push(function () {
            });
            window.PixelAdmin.start(init);
        </script>
    </body>
</html>
<?php $this->endPage() ?>
