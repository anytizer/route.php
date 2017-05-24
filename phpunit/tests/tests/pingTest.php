<?php
use PHPUnit\Framework\TestCase;
use common\relay;

/**
 * Generate and Use tokens before actual API is being accessed
 */
class pingTest extends TestCase
{
    private $api = "http://routes.example.com:9090";

    public function setup()
    {
        $_GET = array();
        $_POST = array();
    }

    /**
     * Home page access is not allowed
     */
    public function testPingPongHasTimestamp()
    {
        $listURL = "{$this->api}/tests/ping/pong";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertTrue($results["success"]);
        $this->assertTrue(key_exists("timestamp", $results["data"]));
        $this->assertEquals("ping", $results["data"]["message"]);
    }
}