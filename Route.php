<?php
class Route{

    protected $controller;
    protected $action;
    protected $params = [];

    public function __construct()
    {
        if(!isset($_SERVER['REDIRECT_URL'])){
            $this->controller = 'Task';
            $this->action = 'index';
        }else{
            $this->uriReader();
            if(!file_exists("app/controllers/$this->controller.php"))
                return $this->errorPage();

        }
    }

    private function uriReader()
    {
        $uri = explode('/',$_SERVER['REDIRECT_URL']);
        $this->controller = ucfirst($uri[1]);
        if(!empty($uri[2]))
            $this->action = $uri[2];
        else
            $this->action = 'index';
        if(!empty($uri[3]))
            for($i = 3; $i < count($uri); $i++)
                $this->params[] = $uri[$i];
    }

    public function Routing()
    {
        if(class_exists($this->getController())){
            $rc = new ReflectionClass($this->getController());
            if($rc->hasMethod($this->getAction())) {
                $controller = $rc->newInstance();
                $method = $rc->getMethod($this->getAction());

                $method->invoke($controller, $this->getParams());
            }else{
                $this->errorPage();
            }
        }
    }

    protected function getController()
    {
        return $this->controller;
    }

    protected function getAction()
    {
        return $this->action;
    }

    protected function getParams()
    {
        if(!empty($this->params))
            return json_encode($this->params);
    }


    protected function errorPage()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
