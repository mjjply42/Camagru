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
            echo(1);
            exit();
        }
      }
    }
    echo(2);
    exit();

}
else
    echo($_POST['login']);
?>