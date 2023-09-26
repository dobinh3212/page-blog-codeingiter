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

        // Check insert
        // $sql = "INSERT INTO news (news_title, news_slug, news_description) VALUES ('Title', 'title', 'Lorem ipsum')";
        // if (mysqli_query($conn, $sql)) {
        //     $last_id = mysqli_insert_id($conn);
        //     var_dump("New record created successfully. Last inserted ID is: " . $last_id);
        // } else {
        //     var_dump(mysqli_error($conn));
        //     die();
        // }
    }
}
