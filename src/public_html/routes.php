<?php
require_once("inc.config.php");

use common\RoutingConfigurations;
use common\RoutingProcessor;

/**
 * @see .htaccess
 */
$parameters_index = "_prmtrs_";
$_GET[$parameters_index] = $_GET[$parameters_index]??""; // cli patch
$route = preg_replace("/[^\\/\\-\\_\\.a-zA-Z0-9]/is", "", $_GET[$parameters_index]);
unset($_GET[$parameters_index]);

$routePaths = array_filter(explode("/", $route));

/**
 * Breakdown the URI string into controller, action and data
 */
$RoutingConfigurations = new RoutingConfigurations();
$packageIndex = $RoutingConfigurations->packageIndex();
$controllerIndex = $RoutingConfigurations->controllerIndex();
$methodIndex = $RoutingConfigurations->methodIndex();
$dataIndex = $RoutingConfigurations->dataIndex();

$result = null;

$RoutingProcessor = new RoutingProcessor();
switch(count($routePaths))
{
    case 0:
        // visiting root page; nothing was supplied
        $result = $RoutingProcessor->process0();
        break;

    case 1:
        // package home page
        $result = $RoutingProcessor->process1($routePaths[$packageIndex]);
        break;

    case 2:
        // controller home page
        $result = $RoutingProcessor->process2($routePaths[$packageIndex], $routePaths[$controllerIndex]);
        break;

    case 3:
        // action was specified
        $result = $RoutingProcessor->process3($routePaths[$packageIndex], $routePaths[$controllerIndex], $routePaths[$methodIndex]);
        break;

    case 4:
        $result = $RoutingProcessor->process4($routePaths[$packageIndex], $routePaths[$controllerIndex], $routePaths[$methodIndex], $routePaths[$dataIndex]);
        break;
    case 5:
    default:
        $result = $RoutingProcessor->process5();
        break;
}
