<?php

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "camagru";
$DB_CHARSET = "utf8mb4";
$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST;charset=$DB_CHARSET";
try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    foreach ($conn->query('SELECT * from users') as $row) {
        print($row);
    }
    $conn = null;
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
    

?>