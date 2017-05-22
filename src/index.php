<?php
header("Content-Type: text/plain");
#echo print_r($_GET, true);
#echo print_r($_SERVER, true);

require_once("libraries/classes/common/class.RoutingConfigurations.inc.php");
require_once("libraries/classes/common/class.RoutingNamifier.inc.php");
require_once("libraries/classes/common/class.RoutingProcessor.inc.php");

# Active controller ready for autoload
require_once("libraries/classes/sample/class.Controller.inc.php");
require_once("libraries/classes/sample/class.NotesController.inc.php");

use common\RoutingConfigurations;
use common\RoutingNamifier;
use common\RoutingProcessor;

use samples\NotesController;

/**
 * @see http://localhost/angular/libraries/routing.php/src
 * @see http://localhost/angular/libraries/routing.php/src/
 * @see http://localhost/angular/libraries/routing.php/src/first
 * @see http://localhost/angular/libraries/routing.php/src/first/
 * @see http://localhost/angular/libraries/routing.php/src/first/name
 * @see http://localhost/angular/libraries/routing.php/src/first/name/
 * @see http://localhost/angular/libraries/routing.php/src/first/name/age
 * @see http://localhost/angular/libraries/routing.php/src/first/name/age/
 * @see http://localhost/angular/libraries/routing.php/src/first/name/age/?sdf8=&sdf&sdaf=df
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
$controllerIndex = $RoutingConfigurations->controllerIndex();
$methodIndex = $RoutingConfigurations->methodIndex();
$dataIndex = $RoutingConfigurations->dataIndex();

$result = null;

$RoutingProcessor = new RoutingProcessor();
switch(count($routePaths))
{
    case 0:
        // nothing was parsed
        //$RoutingProcessor->process0($route[$RoutingProcessor->noIndex()]);
        $result = die("Empty: Use default controller, default method");
        break;

    case 1:
        // controller name only
        $result = $RoutingProcessor->process1($routePaths[$controllerIndex]);
        break;

    case 2:
        $result = $RoutingProcessor->process2($routePaths[$controllerIndex], $routePaths[$methodIndex]);
        break;
    case 3:
        // nothing was parsed
        // get object
        // get index
        // get data
        $result = $RoutingProcessor->process3($routePaths[$controllerIndex], $routePaths[$methodIndex], $routePaths[$dataIndex]);
        break;

    case 4:
    default:
        $result = $RoutingProcessor->process4();
        #print_r($_GET);
        #print_r("Too many parameters - call not implemented.");
        break;
}

echo $result;

// routing database
// controller, method, data
#print_r($_GET);