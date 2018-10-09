<?php
// Kickstart the framework

//$f3     = require('../vendor/fatfree-master/lib/base.php');
$f3     = require('../vendor/f3/lib/base.php');
$conf   = require('../app/config.php');

if ((float)PCRE_VERSION<7.9)
    trigger_error('PCRE version is out of date');

$f3->config('../app/config.ini');

$f3->set('TEMP', TEMP);
$f3->set('DEBUG', DEBUG);
$f3->set('DB', new DB\SQL ('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD));
$f3->set('ONERROR', 'ErrorController::OnError');

$f3->run();

?>