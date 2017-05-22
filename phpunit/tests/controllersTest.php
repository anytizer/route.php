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
		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName("notes");
        
		$this->assertEquals("NotesController", $controller);
    }
	
	public function testControllerNameDigitsRemoved()
    {
		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName("123notes");
        
		$this->assertEquals("NotesController", $controller);
    }
	
	public function testControllerNameDigitsPreserved()
    {
		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName("notes678");
        
		$this->assertEquals("Notes678Controller", $controller);
    }

	public function testControllerNameDigitsRemovedAndPreserved()
    {
		$rn = new RoutingNamifier();
		
		$controller = $rn->controllerName("123notes678");
        
		$this->assertEquals("Notes678Controller", $controller);
    }
	
	public function testControllerSpecialCharactersRemoved()
    {
		$rn = new RoutingNamifier();
		
		// src/my-notes/add/
		$controller = $rn->controllerName("my-notes");
        
		$this->assertEquals("MynotesController", $controller);
    }
}
