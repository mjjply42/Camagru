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

//TESTING
INSERT INTO `users`(`user_usrname`, `user_first`, `user_last`, `user_email`, `user_pwd`) 
VALUES ('mjjply12', 'Matthew','Jones','mjjply2@gmail.com','chuckles12345')

INSERT INTO `users`(`user_usrname`, `user_first`, `user_last`, `user_email`, `user_pwd`) 
VALUES ('Dio','Jabba','Hutt','ufhkfuh@gmail.com','happy1234')