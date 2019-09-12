<?php
class Controller {
    protected $Action;

    function __construct() {
        $this->Action = filter_input(INPUT_GET, "action");
        if (!$this->Action) {
            $this->Action = "Index";
        }
    
        // Let execute the method the user has set in the URL parameter
        $this->runActionMethod($this->Action);
    }

    private function runActionMethod($actionMethod) {
        if (method_exists($this, $actionMethod)) {
            $reflection = new \ReflectionMethod($this, $actionMethod);
            if ($reflection->isPublic()) {
                // Bypasses parameters from URL (GET) to the action method
                $paramaters = [];
                foreach($reflection->getParameters() as $arg) {
                    array_push($paramaters, filter_input(INPUT_GET, $arg->name));
                }
                $response = call_user_func_array([$this, $actionMethod], $paramaters);
                // Will print the response as JSON to client
                header("Content-Type: application/json");
                echo json_encode($response);
            }
            else {
                throw new \RuntimeException("This Action Method is not public.");
            }
        }        
        else {
            throw new \RuntimeException("This Action Method does not exist.");
        }    
    }
}