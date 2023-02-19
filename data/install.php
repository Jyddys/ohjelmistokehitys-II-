<!-- Taulujen testidata -->
<?php

// WARNING: This installer script will overwrite the database!

// Liitetään config.php, jossa tunnus, salasana jne
require "../model/config.php";

// Otetaan yhteys tietokantaan
try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);

    $sql_structure = file_get_contents("structure.sql");
    $sql_content = file_get_contents("content.sql");

// Ajetaan tietokantaan SQL-komennot stucture.sql ja content.sql tiedostoista
    $connection->exec($sql_structure);
    $connection->exec($sql_content);

    echo "<p>Database created and populated succesfully. <br><a href='../'>Home</a></p>";
} catch (PDOException $error) {
    echo "<br>SQL ERROR:" . $error->getMessage();
}

?>