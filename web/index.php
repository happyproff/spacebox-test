<?php

// domains like *.dev enables debugging
$dev = strpos($_SERVER['HTTP_HOST'], '.dev', strlen($_SERVER['HTTP_HOST']) - 4) !== false;
defined('YII_DEBUG') or define('YII_DEBUG', $dev);
defined('YII_ENV') or define('YII_ENV', $dev ? 'dev' : 'prod');

$pathRoot = dirname(dirname(__FILE__));
require_once $pathRoot . '/vendor/autoload.php';
require_once $pathRoot . '/vendor/yiisoft/yii2/Yii.php';
$config = require $pathRoot . '/config/web.php';

(new yii\web\Application($config))->run();
