<?php
abstract class CoreController{
    public $params_on_view = [];

    abstract public function index();

    public function getView($view)
    {
        include_once("./app/views/header.view.php");
        include_once("./app/views/$view.view.php");
        include_once("./app/views/footer.view.php");
    }
    
    public function redirectOn($uri = '')
    {
        header("Location: http://".$_SERVER['SERVER_NAME'].$uri,false);
    }

    protected function error()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}