<?php
namespace common;

class RoutingConfigurations
{
    /**
     * At what index part of the uri string are the values found?
     */
    // src/notes/delete/7 == 0: notes, 1: delete, 2: 7
    // /office/notes/delete/7
    private $packageIndex = 0;
    private $controllerIndex = 1;
    private $methodIndex = 2;
    private $dataIndex = 3;

    public function packageIndex(): int
    {
        // $route[0]
        return $this->packageIndex;
    }

    public function controllerIndex(): int
    {
        // $route[1]
        return $this->controllerIndex;
    }

    public function methodIndex(): int
    {
        // $route[2]
        return $this->methodIndex;
    }

    public function dataIndex(): int
    {
        // $route[3]
        return $this->dataIndex;
    }
}