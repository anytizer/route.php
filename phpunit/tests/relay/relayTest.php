<?php
use PHPUnit\Framework\TestCase;
use common\relay;

/**
 * Generate and Use tokens before actual API is being accessed
 */
class relayTest extends TestCase
{
    private $relay = null;

    public function setup()
    {
        $_GET = array();
        $_POST = array();
        $this->relay = new relay();
        //$this->relay->log(true);
    }

    public function testCreateToken()
    {
        $this->markTestIncomplete();
    }

    public function testValidateToken()
    {
        $this->markTestIncomplete();
    }
}