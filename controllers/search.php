<?php
require "../model/connection.php";

$connection = db_connect();

$search = $_REQUEST['search'];
$sql = "SELECT * FROM projects WHERE title LIKE :search";
$stmt = $connection->prepare($sql);
$stmt->execute(array(':search' => "%$search%"));
$result = $stmt->fetchAll();

if (count($result) > 0) {
    foreach ($result as $row) {
        echo $row['title'] . "<br>";
    }
} else {
    echo "No results found.";
}

$connection = null;