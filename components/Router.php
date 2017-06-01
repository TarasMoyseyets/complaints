<?php
class Router {
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        
    }

    public function run() {
        $uri = $this->getURI();
                
        foreach ($this->routes as $uriPattern =>$path){
            if(preg_match("~$uriPattern~", $uri)){
                
                $intrnalRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                $segment = explode('/',$intrnalRoute);
                //clear localhost dir
                //$localdir = array_shift($segment); 
                //print_r($segment);
                $ControllerName = array_shift($segment).'Controller';
                $ControllerName = ucfirst($ControllerName);
                //echo $ControllerName;
                $actionName = 'action'.ucfirst(array_shift($segment));
                //echo $actionName;
                
                $parameters = $segment;
                
                $controlleFile = ROOT . '\\controllers\\' . $ControllerName . '.php';
                if(file_exists($controlleFile)){
                    include_once($controlleFile);
                }
                $controllerObject = new $ControllerName;
                //$result = $controllerObject->$actionName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if($result != null){
                    break;
                }
                
            }
        }
    }
}
