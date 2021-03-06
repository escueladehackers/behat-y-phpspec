<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
require __DIR__ . '/../../vendor/autoload.php';

use Ewallet\Slim\Application;

$app = new Application(require __DIR__ . '/../../config.php');
$app->run();