<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/app/Views');

$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/articles', ['App\Controllers\ArticleController', 'index']);
    $r->addRoute('GET', '/article/{id}', ['App\Controllers\ArticleController', 'show']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$pos = strpos($uri, '?');
if (false !== $pos) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $template = $twig->load('not-found.twig');
        echo $template->render();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $vars = $routeInfo[2];

        [$controller, $method] = $routeInfo[1];

        $response = (new $controller)->{$method}($vars);

        $viewName = $response->getViewName();
        $data = $response->getData();

        if (isset($data['status']) && $data['status'] === 404) {
            $template = $twig->load('not-found.twig');
        } else {
            $template = $twig->load($viewName . '.twig');
        }

        echo $template->render($data);
        break;
}
