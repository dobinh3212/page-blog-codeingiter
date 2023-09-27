<?php

namespace App\Controllers;

use mysqli;

class Home extends BaseController
{

    public function index()
    {
        $this->testDatabase();
    }

    private function testDatabase(?string $hostname = 'mysql', ?string $username = 'root', ?string $password = 'dbcode', ?string $database = 'dbcode')
    {
        $socket = "/var/run/mysqld/mysqld.sock";
        $conn = new mysqli($hostname, $username, $password, $database, null, $socket);

        // Check connection
        if ($conn->connect_error) {
            var_dump("Connection failed: " . $conn->connect_error);
            die();
        }
        var_dump("Connected successfully");
    }
}
