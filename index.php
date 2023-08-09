<?php
use Application\route\Route;
use Application\config\boot;
use Application\classes\helper;

error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/autoload.php';

$route = $_GET;
$route['lang'] = (empty( $route['lang']) ) ? 'ua'    : $route['lang'];
$route['cont'] = (empty( $route['cont']) ) ? 'index' : $route['cont'];
$route['act']  = (empty( $route['act']) )  ? 'index' : $route['act'];
$route['id']   = (empty( $route['id']) )   ? 0       : $route['id'];

//var_dump($route); exit;

$controllerName = ucfirst($route['cont']) . 'Controller';
$controllerName = 'Application\\controller\\' . "$controllerName";

try {
    if ( !class_exists($controllerName, true) ) {
        throw new Exception('ошибка');
    }
    $controller = new $controllerName($route);
    $method = 'action' . $route['act'];
    if ( !method_exists($controller, $method )  ) {
        throw new Exception('ошибка');
    }
    $controller->$method();
} catch (Exception $e) {
    helper::redirect(boot::PATH . 'lost');
    exit;
}
