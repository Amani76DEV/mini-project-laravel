<?php

const APP_NAME = 'MY MVC';
define('BASE_URL', "http:://$_SERVER[HTTP_HOST]");
define('BASE_DIR', realpath(__DIR__."/../"));


// get and give rute with format {}/{}/...
$current_route = explode('?',$_SERVER['REQUEST_URI'])[0];
$current_route =substr($current_route, 1);
define('CURRETN_ROUTE', $current_route);

global $routes;
$routes = [
    'get' => [],
    'post' => [],
    'put' => [],
    'delete' => [],
];