<?php
// comment out the following two lines when deployed to production


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/load_config.php';

//$config = require __DIR__ . '/../config/web.php';
//echo json_encode(LoadConfig::instance()->getConfig());die;
//(new yii\web\Application($config))->run();
(new yii\web\Application(LoadConfig::instance()->getConfig()))->run();
