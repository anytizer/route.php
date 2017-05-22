<?php
namespace common;
use samples\NotesController;

class RoutingProcessor
{
    private function process(string $controller_name, string $method, $data)
    {
        $rn = new RoutingNamifier();

        $result = null;
        $controller_name = $rn->controllerName($controller_name);
        if(class_exists($controller_name))
        {
            // look for default method
            $controller = new $controller_name();
            if(method_exists($controller, $method)) {
                $result = $controller->$method();
            }
            else
            {
                $result = "Action method not found. [{$method}]";
            }
        }
        else
        {
            $result = "Controller Class not found. [{$controller_name}]";
        }
        #echo "Process One: {$controller_name}->{$method}();";
        return $result;
        #print_r(func_get_args());
    }

    // [$_GET]
    public function process0()
    {
        #print_r(func_get_args());
    }

    /**
     * src/notes ==> notesController.indexAction()
     * http://localhost/angular/libraries/route.php/src/notes
     *
     * @param string $controller_name
     * @return null
     */
    public function process1(string $controller_name)
    {
        $method = "indexAction";
        $data = null;

        return $this->process($controller_name, $method, $data);
    }

    /**
     * src/notes/add ==> notesController.addAction()
     * http://localhost/angular/libraries/route.php/src/notes/add
     *
     * @param string $controller_name
     * @param string $method
     * @return null
     */
    public function process2(string $controller_name, string $method)
    {
        $rn = new RoutingNamifier();
        $method = $rn->methodName($method);
        $data = null;

        return $this->process($controller_name, $method, $data);

        #echo "Process Two: {$controller_name}->{$method}();";
        #return $result;
        #print_r(func_get_args());
    }

    /**
     * src/notes/delete/7 ==> notesController.deleteAction(7)
     * http://localhost/angular/libraries/route.php/src/notes/delete/7
     *
     * @param string $controller_name
     * @param string $method
     * @param $data
     * @return null
     */
    public function process3(string $controller_name, string $method, $data)
    {
        $rn = new RoutingNamifier();
        $method = $rn->methodName($method);

        return $this->process($controller_name, $method, $data);
        #echo "Process Three: {$controller_name}->{$method}();";
        # return $result;
        #print_r(func_get_args());echo "Process ";
        #print_r(func_get_args());
    }

    public function process4(): string
    {
        return "No support for 4+ parameters";
    }
}