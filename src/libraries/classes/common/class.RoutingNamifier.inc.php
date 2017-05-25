<?php
namespace common;

class RoutingNamifier
{
    public function packageName(string $package_name): string
    {
        return $package_name;
    }

    public function controllerName(string $package_name, $controller): string
    {
        //$namespace = "samples";
        $namespace = $this->packageName($package_name);

        // notes => NotesController
        $controller = $this->sanitize($controller);
        $controller = strtolower($controller);
        $controller = ucfirst($controller);

        $controller = "{$namespace}\\{$controller}Controller";
        return $controller;
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