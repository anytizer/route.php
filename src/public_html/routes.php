<?php
require_once("inc.config.php");

# Active controller to be loaded on demand
#require_once("libraries/classes/samples/class.OfficeController.inc.php");
#require_once("libraries/classes/samples/class.NotesController.inc.php");

use common\RoutingConfigurations;
use common\RoutingProcessor;
/**
 * @see http://routes.example.com:9090/
 * @see http://routes.example.com:9090/
 * @see http://routes.example.com:9090/office
 * @see http://routes.example.com:9090/office/
 * @see http://routes.example.com:9090/office/notes
 * @see http://routes.example.com:9090/office/notes/
 * @see http://routes.example.com:9090/office/notes/add
 * @see http://routes.example.com:9090/office/notes/add/
 * @see http://routes.example.com:9090/office/notes/add/?sdf8=&sdf&sdaf=df
 */
#print_r($_GET);

$parameters_index = "_prmtrs_";
$_GET[$parameters_index] = $_GET[$parameters_index]??""; // cli patch
$route = preg_replace("/[^\\/\\-\\_\\.a-zA-Z0-9]/is", "", $_GET[$parameters_index]);
unset($_GET[$parameters_index]);
#print_r($route);

#$routePaths = explode("/", $route);
$routePaths = array_filter(explode("/", $route));
#print_r($routePaths);

#print_r($_GET);

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
		// home page; nothing was supplied
        $result = $RoutingProcessor->process0();
        //$result = die("Empty: Use default controller, default method");
        break;

    case 1:
		// package name only
        // controller name only
		// do not allow
        $result = $RoutingProcessor->process1($routePaths[$packageIndex]);
        break;

    case 2:
		// controller name
        $result = $RoutingProcessor->process2($routePaths[$packageIndex], $routePaths[$controllerIndex]);
        break;

	case 3:
		// action specified
        $result = $RoutingProcessor->process3($routePaths[$packageIndex], $routePaths[$controllerIndex], $routePaths[$methodIndex]);
        break;

    case 4:
        $result = $RoutingProcessor->process4($routePaths[$packageIndex], $routePaths[$controllerIndex], $routePaths[$methodIndex], $routePaths[$dataIndex]);
        break;
    case 5:
    default:
        $result = $RoutingProcessor->process5();
        #print_r($_GET);
        #print_r("Too many parameters - call not implemented.");
        break;
}

echo $result;

// routing database
// controller, method, data
#print_r($_GET);