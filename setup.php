<?php

include_once 'database.php';

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->exec("CREATE DATABASE `".$DB_NAME."`");

    
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
?>