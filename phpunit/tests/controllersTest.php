<?php
namespace tests;

use common\RoutingNamifier;
use common\RoutingProcessor;
use PHPUnit\Framework\TestCase;

class controllersTest extends TestCase
{
    public function setup()
    {
    }

    public function testControllerName()
    {
        $package_name = "office";
        $controller_name = "notes";
		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName($package_name, $controller_name);
        
		$this->assertEquals("office\\NotesController", $controller);
    }
	
	public function testControllerNameDigitsRemoved()
    {
        $package_name = "office";
        $controller_name = "123notes";

		$rn = new RoutingNamifier();
		$controller = $rn->controllerName($package_name, $controller_name);
        
		$this->assertEquals("office\\NotesController", $controller);
    }
	
	public function testControllerNameDigitsPreserved()
    {
        $package_name = "office";
        $controller_name = "notes678";

		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName($package_name, $controller_name);
        
		$this->assertEquals("office\\Notes678Controller", $controller);
    }

	public function testControllerNameDigitsRemovedAndPreserved()
    {
        $package_name = "office";
        $controller_name = "123notes678";

		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName($package_name, $controller_name);
        
		$this->assertEquals("office\\Notes678Controller", $controller);
    }
	
	public function testControllerSpecialCharactersRemoved()
    {
        $package_name = "office";
        $controller_name = "my-notes";

        $rn = new RoutingNamifier();
		
		// src/my-notes/add/
		$controller = $rn->controllerName($package_name, $controller_name);
        
		$this->assertEquals("office\\MynotesController", $controller);
    }
}
