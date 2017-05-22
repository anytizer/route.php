<?php
namespace common;
use samples\NotesController;

class RoutingProcessor
{
    private function process(string $package_name, string $controller_name, string $method, $data)
    {
        $rn = new RoutingNamifier();

        $result = null;
        $controller_name = $rn->controllerName($package_name, $controller_name);
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
        return "Empty: Use default controller, default method";
        #print_r(func_get_args());
    }

    public function process1(string $package_name)
    {
        return "Empty: Use default package.";
    }

    /**
     * src/notes ==> notesController.indexAction()
     * http://localhost/angular/libraries/route.php/src/notes
     *
     * @param string $package_name
     * @param string $controller_name
     * @return null|string
     */
    public function process2(string $package_name, string $controller_name)
    {
        $method_name = "indexAction";
        $data = null;

        return $this->process($package_name, $controller_name, $method_name, $data);
    }

    /**
     * src/notes/add ==> notesController.addAction()
     * http://localhost/angular/libraries/route.php/src/notes/add
     *
     * @param string $process_name
     * @param string $controller_name
     * @param string $method_name
     * @return null|string
     */
    public function process3(string $process_name, string $controller_name, string $method_name)
    {
        $rn = new RoutingNamifier();
        $method_name = $rn->methodName($method_name);
        $data = null;

        return $this->process($process_name, $controller_name, $method_name, $data);

        #echo "Process Two: {$controller_name}->{$method}();";
        #return $result;
        #print_r(func_get_args());
    }

    /**
     * src/notes/delete/7 ==> notesController.deleteAction(7)
     * http://localhost/angular/libraries/route.php/src/notes/delete/7
     *
     * @param string $package_name
     * @param string $controller_name
     * @param string $method_name
     * @param $data
     * @return null|string
     */
    public function process4(string $package_name, string $controller_name, string $method_name, $data)
    {
        $rn = new RoutingNamifier();
        $method_name = $rn->methodName($method_name);

        return $this->process($package_name, $controller_name, $method_name, $data);
        #echo "Process Three: {$controller_name}->{$method}();";
        # return $result;
        #print_r(func_get_args());echo "Process ";
        #print_r(func_get_args());
    }

    public function process5(): string
    {
        return "No support for 5+ parameters";
    }
}