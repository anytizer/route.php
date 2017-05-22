<?php
namespace common;
use common\envelope;
use office\NotesController;

class RoutingProcessor
{
    private function process(string $package_name, string $controller_name, string $method, $data): envelope
    {
        $envelope = new envelope();

        $rn = new RoutingNamifier();

        $result = null;
        $controller_name = $rn->controllerName($package_name, $controller_name);
        if(class_exists($controller_name))
        {
            // look for default method
            $controller = new $controller_name();
            if(method_exists($controller, $method)) {
                $result = $controller->$method();
                $envelope->found($result);
            }
            else
            {
                $result = "Action method not found. [{$method}]";
                $envelope->found($result);
            }
        }
        else
        {
            $result = "Controller Class not found. [{$controller_name}]";
            $envelope->not_found($result);
        }

        return $envelope;
    }

    // [$_GET]
    public function process0(): envelope
    {
        $error = "Empty: Use default controller, default method";
        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }

    public function process1(string $package_name): envelope
    {
        $error = "Empty: Use default package.";
        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }

    /**
     * src/notes ==> notesController.indexAction()
     * http://localhost/angular/libraries/route.php/src/notes
     *
     * @param string $package_name
     * @param string $controller_name
     * @return \common\envelope
     */
    public function process2(string $package_name, string $controller_name): envelope
    {
        $method_name = "indexAction";
        $data = null;

        $envelope = $this->process($package_name, $controller_name, $method_name, $data);
        return $envelope;
    }

    /**
     * src/notes/add ==> notesController.addAction()
     * http://localhost/angular/libraries/route.php/src/notes/add
     *
     * @param string $process_name
     * @param string $controller_name
     * @param string $method_name
     * @return \common\envelope
     */
    public function process3(string $process_name, string $controller_name, string $method_name): envelope
    {
        $rn = new RoutingNamifier();
        $method_name = $rn->methodName($method_name);
        $data = null;

        $envelope = $this->process($process_name, $controller_name, $method_name, $data);
        return $envelope;
   }

    /**
     * src/notes/delete/7 ==> notesController.deleteAction(7)
     * http://localhost/angular/libraries/route.php/src/notes/delete/7
     *
     * @param string $package_name
     * @param string $controller_name
     * @param string $method_name
     * @param $data
     * @return \common\envelope
     */
    public function process4(string $package_name, string $controller_name, string $method_name, $data): envelope
    {
        $rn = new RoutingNamifier();
        $method_name = $rn->methodName($method_name);

        $envelope = $this->process($package_name, $controller_name, $method_name, $data);
        return $envelope;
    }

    /**
     * @return \common\envelope
     */
    public function process5(): envelope
    {
        $error = "No support for 5+ parameters";

        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }
}