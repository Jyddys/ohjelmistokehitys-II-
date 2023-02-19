<?php 

// model/connection.php
function db_connect()
{
    try {
        require "config.php";

        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
    } catch (PDOExpection $err) {
        echo "Database connection error. <br>" . $err->getMessage();
        exit;
    }
    return $connection;
}

?>