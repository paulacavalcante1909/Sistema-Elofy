<?php

require_once "core/Router.php";

class Loader
{
    private $currentRoute;

    public function __construct($route = null)
    {
        $this->currentRoute = $route ?? '';
    }

    public function run()
    {
        $router = new Router();

        $router->currentRoute = $this->currentRoute;

        $router->loadAllRoutes();

        $router->loadCurrentRoute();
    }
}
