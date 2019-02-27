<?php

include_once 'database.php';

try {
    $conn = new PDO($DB_SET_DSN, $DB_USER, $DB_PASSWORD);
    $conn->exec("CREATE DATABASE $DB_NAME;
                USE $DB_NAME;
                CREATE TABLE users  (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    user_usrname VARCHAR(255) NOT NULL,
                    user_first VARCHAR(255) NOT NULL,
                    user_last VARCHAR(255) NOT NULL,
                    user_email VARCHAR(255) NOT NULL,
                    user_pwd VARCHAR(255) NOT NULL,
                    e_verify VARCHAR(255) NOT NULL
    
                                    );
                CREATE TABLE temp_users  (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    user_usrname VARCHAR(255) NOT NULL,
                    user_first VARCHAR(255) NOT NULL,
                    user_last VARCHAR(255) NOT NULL,
                    user_email VARCHAR(255) NOT NULL,
                    user_pwd VARCHAR(255) NOT NULL,
                    e_verify VARCHAR(255) NOT NULL);
                    
                CREATE TABLE profile_info   (
                    user_id INT NOT NULL,
                    image_id INT AUTO_INCREMENT PRIMARY KEY,
                    create_date DATE NOT NULL,
                    pic_ VARCHAR(255) NOT NULL,
                    status VARCHAR(255) NOT NULL);
                    
                CREATE TABLE id_img_stat    (
                    table_id INT AUTO_INCREMENT PRIMARY KEY,
                    img_id INT NOT NULL,
                    comment VARCHAR(255) NOT NULL,
                    commenter  INT NOT NULL,
                    like_ TINYINT(1) NOT NULL);"
                );
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
?>