<?php
namespace common;

class RoutingProcessor
{
    /**
     * Private processor
     *
     * @param string $package_name
     * @param string $controller_name
     * @param string $method
     * @param $data
     * @return envelope
     */
    private function process(string $package_name, string $controller_name, string $method, $data): envelope
    {
        $envelope = new envelope();

        $rn = new RoutingNamifier();

        $result = null;
        //$controller_name = $rn->controllerName($package_name, $controller_name); // already processed by the caller
        #die("Controller class: {$controller_name}");
        if(class_exists($controller_name))
        {
            // look for default method
            $controller = new $controller_name();
            if(method_exists($controller, $method))
            {
                $result = $controller->$method($data);
                $envelope->found($result);
                /**
                 * @todo When logically failed, send data with error flag
                 */
            }
            else
            {
                $result = "Action method not found. [{$method}]";
                $envelope->not_found($result);
            }
        }
        else
        {
            $result = "Controller class not found: [{$controller_name}]";
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
        //$rn = new RoutingNamifier();
        //$package_name = $rn->packageName($package_name);

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
        $rn = new RoutingNamifier();

        $package_name = $rn->packageName($package_name);
        // $controller_name
        // $method_name
        // $data = null;

        /**
         * @todo Use a default controller
         */
        $error = "Package: Use default package. [{$package_name}]";
        $envelope = new envelope();

        $envelope->not_found($error);

        return $envelope;
    }

    /**
     * @see http://routes.example.com:9090/office/notes
     * @see http://routes.example.com:9090/office/notes/list
     *
     * @param string $package_name
     * @param string $controller_name
     * @return \common\envelope
     */
    public function process2(string $package_name, string $controller_name): envelope
    {
        $rn = new RoutingNamifier();

        $package_name = $rn->packageName($package_name);
        $controller_name = $rn->controllerName($package_name, $controller_name);
        $method_name = "indexAction";
        $data = null;

        $envelope = $this->process($package_name, $controller_name, $method_name, $data);
        return $envelope;
    }

    /**
     * @see http://routes.example.com:9090/office/notes/add
     *
     * @param string $package_name
     * @param string $controller_name
     * @param string $method_name
     * @return \common\envelope
     */
    public function process3(string $package_name, string $controller_name, string $method_name): envelope
    {
        $rn = new RoutingNamifier();

        $package_name = $rn->packageName($package_name);
        $controller_name = $rn->controllerName($package_name, $controller_name);
        $method_name = $rn->methodName($method_name);
        $data = null;

        $envelope = $this->process($package_name, $controller_name, $method_name, $data);
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

        $package_name = $rn->packageName($package_name);
        $controller_name = $rn->controllerName($package_name, $controller_name);
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