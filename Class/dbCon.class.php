<?php

Class Connection {
  protected function db_Con()
 {
     $servername = "localhost";
     $username = "root";
     $password = "";
     $db_name = "qlsv";
     $conn = new mysqli($servername, $username, $password, $db_name);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     return $conn;
 }
}
?>