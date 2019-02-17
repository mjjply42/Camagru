<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "totally";
$DB_CHARSET = "utf8mb4";
$DB_PORT = 8889;
$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
if ((!empty($_POST['login'])) && (!empty($_POST['pwd'])))
{
    $username = $_POST['login'];
    $password = $_POST['pwd'];
    
    $test = $conn->prepare("SELECT user_usrname, user_pwd FROM users");
    $test->execute();
    while ($result = $test->fetchAll())
    {
      foreach($result as $row)
      {
        if ($row['user_usrname'] == $username && $row['user_pwd'] == $password)
          header("Location: usr_profile.php");
      }
    }
    ##Switch these two lines out with an AJAX Call 
    ##that shows beside form. That will be a flashy step.
    echo("User Doesnt Exist. Redirecting");
    header("Refresh: 1; login.php");

}
else
    header("Location:  login.php");
?>