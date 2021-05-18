<?php
define('ROOT', dirname(__DIR__));
define('SITE', (($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['SERVER_NAME']);

$uri = $_GET['url'];
$action = (strlen($uri) === 0)? "create" : "read";

require_once ROOT . '/Controllers/AppController.php';

$controller = new AppController();

($action == "read") ? $controller->$action($uri): $controller->$action();
