<?php
namespace tests;

class PingController
{
    /**
     * Test if the API service is live
     * <code>
     * {
     *     "success": true,
     *     "data": {
     *       "message": "ping",
     *       "timestamp": "2017-05-24 06:46:20"
     *     }
     * }
     * </code>
     * @see http://routes.example.com:9090/tests/ping/pong
     */
    public function pongAction()
    {
        $response = array(
            "message" => "ping",
            "timestamp" => date("Y-m-d H:i:s"),
        );

        return $response;
    }

    public function timestampAction()
    {
        /**
         * @todo Connect to the database and read the timestamp
         */
        $response = array(
            "message" => "ping",
            "timestamp" => date("Y-m-d H:i:s"),
        );

        return $response;
    }

    public function versionAction()
    {
        /**
         * @todo Connect to the database and read the database version
         */
        $response = array(
            "message" => "ping",
            "version" => "10.1.13-MariaDB",
        );

        return $response;
    }
}
