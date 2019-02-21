<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "camagru";
$DB_CHARSET = "utf8mb4";
$DB_PORT = 8889;
$DB_SET_DSN = "mysql:host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
session_start();
$_SESSION['logged'] = true;
$_COOKIE['username'] = $username;
$get_verify = $_GET['verify'];
if($get_verify == $_SESSION['verify'])
{
    try 
        {
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        }
    catch   (PDOException $e) 
        {
            print "11Error!: " . $e->getMessage(). "<br/>";
            die();
        }
        $new_usr = $conn->prepare("INSERT INTO users (user_usrname, user_first, 
                                            user_last, user_email, user_pwd, e_verify)
                                    SELECT user_usrname, user_first, 
                                        user_last, user_email, user_pwd, e_verify
                                    FROM temp_users
                                    WHERE e_verify = '$get_verify'");
        $new_usr->execute();
        $conn = NULL;
    try 
        {
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        }
    catch   (PDOException $e) 
        {
            print "22Error!: " . $e->getMessage(). "<br/>";
            die();
        }
        $del_table = $conn->prepare("DELETE FROM temp_users
                                        WHERE e_verify = '$get_verify'");
        $del_table->execute();

     header("Location: ../usr_profile.php");
}
else
    header("Location: ../login.php");
?>