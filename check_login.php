<?php
include_once 'database.php';

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
    $password = hash('sha3-512',$_POST['pwd']);
    
    $test = $conn->prepare("SELECT user_usrname, user_pwd FROM users");
    $test->execute();
    while ($result = $test->fetchAll())
    {
      foreach($result as $row)
      {
        if ($row['user_usrname'] == $username && $row['user_pwd'] == $password)
        {
            session_start();
            $_SESSION['username'] = $username;
            session_write_close();
            header("Location: usr_session.php?username='$username'");
        }
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