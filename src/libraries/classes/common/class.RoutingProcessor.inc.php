<?php
namespace common;

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

    /**
     * @see http://routes.example.com:9090/
     *
     * @return \common\envelope
     */
    public function process0(): envelope
    {
        $error = "Home (Empty): Use default package, controller, and method.";
        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }

    /**
     * @see http://routes.example.com:9090/office
     *
     * @param string $package_name
     * @return \common\envelope
     */
    public function process1(string $package_name): envelope
    {
        $error = "Package: Use default package.";
        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }

    /**
     * @see http://routes.example.com:9090/office/notes
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
     * @see http://routes.example.com:9090/office/notes/add
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
     * http://routes.example.com:9090/office/notes/delete/7
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
     * @see http://routes.example.com:9090/office/notes/assign/78/91
     * @return \common\envelope
     */
    public function process5(): envelope
    {
        $error = "No support for 5+ parameters. Too long parameters may ruin your API Design.";

        $envelope = new envelope();
        $envelope->not_found($error);

        return $envelope;
    }
}