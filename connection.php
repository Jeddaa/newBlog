<?php
  function connect_db(){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "newBlog";
    $port = 8889;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database,
    $port);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  };
  ?>
