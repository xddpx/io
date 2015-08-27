<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;
use Yii;
use yii\helpers\VarDumper;

/**
 * Plagiarism checker
 *
 * @author Dmitry Pilipenko
 * @version 1.0
 */
class StreamController extends Controller {

    public function actionRun() {
        Yii::$app->socket->listen();
    }

}
