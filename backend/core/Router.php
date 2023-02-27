<?php

class Router
{
    public $routesList = [];

    public $currentRoute;

    public $currentController;
    public $currentMethod;


    /**
     * Carrega todas as rotas
     *
     * @return array
     */
    public function loadAllRoutes()
    {

        $directory_iterator =  new RecursiveDirectoryIterator(
            __DIR__ . "/../routes/",
            FilesystemIterator::SKIP_DOTS
        );


        $iterator =  new RecursiveIteratorIterator($directory_iterator);

        foreach ($iterator as $file) {
            require_once $file;
        }
    }


    /**
     * Carrega a rota atual
     *
     * @return void
     */

    public function loadCurrentRoute()
    {
        if (!$this->verifyCurrentRoute())
            $this->errorRoute("Houve um erro inesperado");

        $this->execute();
    }

    /**
     * Adiciona rotas ao $this->routesList
     *
     * @param  [array] $routes
     * @return void
     */

    public function addRoutes($routes)
    {
        $this->routesList = array_merge($this->routesList, $routes);
    }

    /**
     * Verifica se o currentRoute está na routeList
     *
     * @return boolean
     */
    public function verifyCurrentRoute()
    {

        if (!isset($this->routesList[$this->currentRoute]))
            $this->errorRoute("Rota não existente");




        $this->verifyController();

        $this->verifyMethod();

        return true;
    }


    /**
     * Verifica se o controller passado na rota é válido
     *
     * @return boolean
     */
    public function verifyController()
    {
        $this->currentController = $this->routesList[$this->currentRoute][0];

        $this->verifyFileController();

        if (!class_exists(ucfirst($this->currentController)))
            $this->errorRoute("Classe não existente!");

        return true;
    }

    /**
     * Verifica se o método passado na rota é válido
     *
     * @return boolean
     */
    public function verifyMethod()
    {

        $this->currentMethod = $this->routesList[$this->currentRoute][1];

        if (!method_exists($this->currentController, $this->currentMethod))
            $this->errorRoute("Método inexistente!");

        return true;
    }

    /**
     * Verifica se o arquivo de controller existe
     *
     * @return void
     */
    public function verifyFileController()
    {
        $dir_controller = __DIR__ . "/../Controllers/$this->currentController.php";

        if (!file_exists($dir_controller))
            $this->errorRoute("Arquivo do Controller $dir_controller inexistente");

        require_once $dir_controller;
    }

    /**
     * Executa o controller e o metodo passado na rota
     *
     * @return void
     */
    public function execute()
    {
        $controller = $this->currentController;

        $method = $this->currentMethod;

        return (new $controller)->$method();
    }


    /**
     * Retorna mensagem de erro e sai da aplicação
     *
     * @param  [string] $error
     * @return void
     */
    public function errorRoute($error)
    {
        echo $error;
        exit;
    }
}
