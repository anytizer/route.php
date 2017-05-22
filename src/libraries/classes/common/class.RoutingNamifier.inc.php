<?php
namespace common;

class RoutingNamifier
{
    public function controllerName($controller): string
    {
        $namespace = "samples";

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