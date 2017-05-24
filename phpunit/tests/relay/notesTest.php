<?php
use PHPUnit\Framework\TestCase;
use common\relay;

/**
 * Generate and Use tokens before actual API is being accessed
 */
class notesTest extends TestCase
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
    public function testHomePageAccessShouldErr()
    {
        $listURL = "{$this->api}";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertFalse($results["success"]);
    }

    /**
     * Package page is not allowed
     */
    public function testPackageAccessShouldErr()
    {
        $listURL = "{$this->api}/office";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertFalse($results["success"]);
    }

    /**
     * Invalid method call is not allowed
     */
    public function testInvalidMethodCallShouldErr()
    {
        $listURL = "{$this->api}/office/nothing";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertFalse($results["success"]);
    }

    /**
     * Get a list of active notes
     */
    public function testListNotes()
    {
        $listURL = "{$this->api}/office/notes/list";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertTrue($results["success"]);
        $this->assertTrue(count($results["data"])>=1); // must have data

        // @todo Data check
        // should be array
        // should be of valid class data
    }

    public function testAddNote()
    {
        $_POST = array(
            "date" => "2017-05-22",
            "name" => "something",
        );
        $listURL = "{$this->api}/office/notes/add";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertTrue($results["success"]);
    }

    public function testEditNote()
    {
        $_POST = array(
            "name" => "something",
        );
        $listURL = "{$this->api}/office/notes/edit";

        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertTrue($results["success"]);
    }

    public function testDeleteNote()
    {
        $delete_id = 7;

        $listURL = "{$this->api}/office/notes/delete/{$delete_id}";
        $relay = new relay();
        $data = $relay->fetch($listURL);

        $results = json_decode($data, true);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
        $this->assertTrue($results["success"]);
    }
}