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

    public function testListNotes()
    {
        $listURL = "{$this->api}/office/notes/list";
        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
    }

    public function testAddNote()
    {
        $_POST = array(
            "name" => "something",
        );
        $listURL = "{$this->api}/office/notes/add";
        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data);
        # print_r($results);

        $this->assertTrue(key_exists("success", $results));
    }

    public function testEditNote()
    {
        $_POST = array(
            "name" => "something",
        );
        $listURL = "{$this->api}/office/notes/edit";
        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
    }

    public function testDeleteNote()
    {
        $delete_id = 7;
        $listURL = "{$this->api}/office/notes/delete/{$delete_id}";
        $relay = new relay();
        $data = $relay->fetch($listURL);
        $results = json_decode($data);
        #print_r($results);

        $this->assertTrue(key_exists("success", $results));
    }
}