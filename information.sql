CREATE DATABASE camagru;
USE camagru;
CREATE TABLE users  (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_usrname VARCHAR(255) NOT NULL,
    user_first VARCHAR(255) NOT NULL,
    user_last VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_pwd VARCHAR(255) NOT NULL

);