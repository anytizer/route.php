<?php
namespace tests;

use common\RoutingNamifier;
use common\RoutingProcessor;
use PHPUnit\Framework\TestCase;

class methodsTest extends TestCase
{
    public function setup()
    {
    }

	public function testMethodName()
    {
		$rn = new RoutingNamifier();
		
		$method = $rn->methodName("log");
        
		$this->assertEquals("logAction", $method);
    }
	
	public function testMethodNameDigitsRemoved()
    {
		$rn = new RoutingNamifier();
		
		$method = $rn->methodName("123log");
        
		$this->assertEquals("logAction", $method);
    }
	
	public function testMethodNameDigitsPreserved()
    {
		$rn = new RoutingNamifier();
		
		$method = $rn->methodName("123log678");
        
		$this->assertEquals("log678Action", $method);
    }
}
