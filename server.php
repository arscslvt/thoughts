<?php

    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "toughts";
    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn -> connect_error) {
        die("<p class='error'>Connection failed: " . $conn -> connect_error . "</p>");
    }

?>