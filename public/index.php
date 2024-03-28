<?php
session_start();
ob_start();
define('ACCESS_ALLOWED', true);
require "../vendor/autoload.php";

use \App\Common\Environment;

Environment::load(dirname(__DIR__));
$env = getenv();
define('ENV', getenv());

$url = new \App\core\Core();
$url->loadPage();
