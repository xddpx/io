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
        $process = exec('ps aux | grep "stream/run"', $output);
        $pattern = "/application\/yii stream\/run/i";
        $count = 0;
        if (!empty($output)) {
            foreach ($output as $pid) {
                if (preg_match($pattern, $pid)) {
                    $count++;
                }
            }
        }
        if ($count <= 1) {
            Yii::$app->socket->listen();
        }
    }

}
