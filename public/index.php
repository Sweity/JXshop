<?php
define('ROOT',__DIR__ . '/../');
// 类的自动加载
function load($class){
    $path = str_replace('\\','/',$class);
    require(ROOT . $path . '.php');
}
spl_autoload_register('load');

// 解析路由
$controller = '\controllers\IndexController';
$action = 'index';
if(isset($_SERVER['PATH_TNFO'])){
    $router = explode('/', $_SERVER['PATH_TNFO']);
    $controller = '\controllers\\'.ucfirst($router[1]) . 'Controller';

}
$c = new $controller;
$c->$action();
