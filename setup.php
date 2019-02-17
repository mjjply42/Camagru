<?php

include_once 'database.php';

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->exec("CREATE DATABASE $DB_NAME;
                USE $DB_NAME;
                CREATE TABLE users  (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    user_usrname VARCHAR(255) NOT NULL,
                    user_first VARCHAR(255) NOT NULL,
                    user_last VARCHAR(255) NOT NULL,
                    user_email VARCHAR(255) NOT NULL,
                    user_pwd VARCHAR(255) NOT NULL
    
                                    );"
                );

    
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
?>