<?php
namespace common;

class RoutingNamifier
{
    public function packageName(string $package_name): string
    {
        return $package_name;
    }

    /**
     * Prefers single word as controller name
     *
     * @param string $package_name
     * @param $controller_name
     * @return string
     */
    public function controllerName(string $package_name, string $controller_name): string
    {
        #die("Seeking: {$package_name} and {$controller_name}.");
        //$namespace = "samples";
        $namespace = $this->packageName($package_name);
        #die("Seeking namespace: {$namespace}.");

        // notes => NotesController
        $controller_name = $this->sanitize($controller_name);
        $controller_name = strtolower($controller_name);
        $controller_name = preg_replace("/controller$/is", "", $controller_name);
        $controller_name = ucfirst($controller_name);
        #die("Seeking controller name: {$controller_name}.");

        $controller_name = "{$namespace}\\{$controller_name}Controller";
        #die("Seeking namespaced controller name: {$controller_name}.");
        return $controller_name;
    }

    public function methodName($method): string
    {
        // src/notes/index => Notes->indexAction()
        $method = $this->sanitize($method);
        $method .= "Action";

        return $method;
    }

    private function sanitize(string $name)
    {
        // sanitize
        $name = preg_replace("/[^a-zA-Z0-9]/is", "", $name);

        // Remove digits appear in the first
        $name = preg_replace("/^[0-9]+/is", "", $name);
        return $name;
    }
}