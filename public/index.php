<?php
session_start();
ob_start();
define('ACCESS_ALLOWED', true);
require_once __DIR__ . '/../vendor/autoload.php';

use \App\common\Environment;

Environment::load(dirname(__DIR__));
$env = getenv();
define('ENV', getenv());

$url = new \App\Core\Core();
$url->loadPage();
