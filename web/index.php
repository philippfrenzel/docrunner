<?php

/**
 * PurePO
 * @company Frenzel GmbH
 * @copy    Frenzel GmbH 2013-2014
 * @contact philipp@frenzel.net
 */

//Set the default time zone to europe/berlin
ini_set('date.timezone','Europe/Berlin');

if (function_exists('date_default_timezone_set')) {
  date_default_timezone_set('Europe/Berlin');
}

function includeIfExists($file)
{
  if(file_exists($file)) {
    return include $file;
  }
}

// comment out the following line to disable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

if(($baseConfig = includeIfExists(__DIR__.'/../config/web.php')) && ($localConfig = includeIfExists(__DIR__.'/../config/web-test.php'))) {
  $config = \yii\helpers\ArrayHelper::merge($baseConfig,$localConfig);
} else {
  $config = $baseConfig;
}

$application = new yii\web\Application($config);

$application->run();

