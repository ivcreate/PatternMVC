<?php
set_include_path(get_include_path()
					.PATH_SEPARATOR.'app/controllers'
					.PATH_SEPARATOR.'app/models'
					.PATH_SEPARATOR.'app/views');

function __autoload($class){
    require_once($class.'.php');
}

function addEnv(){
    $env_file = @fopen(".env", "r");
    while (($buffer = fgets($env_file, 4096)) !== false) {
        putenv(trim($buffer));
    }
}
addEnv();
$route = new Route();
$route->Routing();