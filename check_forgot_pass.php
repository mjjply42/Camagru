<?php
session_start();
if(!empty($_POST['login']) && (!empty($_POST['email'])))
{
    $username = $_POST['login'];
    $email = $_POST['email'];
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_NAME = "camagru";
    $DB_CHARSET = "utf8mb4";
    $DB_PORT = 8889;
    $DB_SET_DSN = "mysql:host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
    $DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";

    try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    }
    catch   (PDOException $event) {
        print "Error!: " . $event->getMessage(). "<br/>";
        die();
    }

    $check = $conn->prepare("SELECT user_usrname, user_email, user_pwd
                                FROM users");
    $check->execute();
    while ($result = $check->fetchAll())
    {
        foreach ($result as $row)
        {
            if (($row['user_usrname'] == $username) && ($row['user_email'] == $email))
            {
                $n = 10;  
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                $randomString = ''; 
  
                for ($i = 0; $i < $n; $i++) 
                { 
                    $index = rand(0, strlen($characters) - 1); 
                    $randomString .= $characters[$index];
                }
                $password = hash("sha3-512", $randomString);

                try {
                    $set_p = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                }
                catch   (PDOException $event) {
                    print "Error!: " . $event->getMessage(). "<br/>";
                    die();
                }
                $new = $set_p->prepare("UPDATE `users` 
                                        SET `user_pwd` = '$password' 
                                        WHERE `user_usrname` = '$username'");
                $new->execute();
                echo($randomString);
                exit();
            }
            else
            {
                echo(2);
                exit();
            }
        }
    }
}
echo($_POST['email']);

?>