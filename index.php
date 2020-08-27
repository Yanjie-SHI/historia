<?php

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once ROOT . 'app/AbstractController.php';
require_once ROOT . 'app/MyPDO.php';
require_once ROOT . 'vendor/autoload.php';

MyPDO::getMyPDO();

session_start();

$i18n = (empty($_GET['lang'])) ? 'fr' : $_GET['lang'];

switch ($i18n) {
    case 'fr':
        require_once 'app/i18n/fr.php';
        break;
    case 'en':
        require_once 'app/i18n/en.php';
        break;
    default:
        require_once 'app/i18n/fr.php';
}

$params = explode('/', $_GET['p']);

if (!empty($params[0])) {
    if (!empty($params[1])) {
        $controller = ucfirst($params[0]) . 'Controller';
        require_once ROOT . 'controllers/' . $controller . '.php';
        $controller = new $controller();
        $action = $params[1];
        unset($params[0], $params[1]);
        call_user_func_array([$controller, $action], $params);
    } else {
        http_response_code(404);
    }
} else {
    require_once ROOT . 'controllers/IndexController.php';
    $controller = new IndexController();
    $controller->index();
}
