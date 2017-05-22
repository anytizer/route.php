<?php
namespace common;

class RoutingConfigurations
{
    /**
     * At what index part of the uri string are the values found?
     */
    // src/notes/delete/7 == 0: notes, 1: delete, 2: 7
    private $controllerIndex = 0;
    private $methodIndex = 1;
    private $dataIndex = 2;

    public function controllerIndex(): int
    {
        // $route[0]
        return $this->controllerIndex;
    }

    public function methodIndex(): int
    {
        // $route[1]
        return $this->methodIndex;
    }

    public function dataIndex(): int
    {
        // $route[2]
        return $this->dataIndex;
    }
}