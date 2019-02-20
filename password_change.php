<?php

session_start();
if(!empty($_POST['old_pass']) && !empty($_POST['new_pass']))
{
    $old_pass = hash('sha3-512',$_POST['old_pass']);
    $new_pass = hash('sha3-512',$_POST['new_pass']);
    echo($old_pass);
    echo($new_pass);
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_NAME = "camagru";
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
    $validity = $conn->prepare("SELECT user_pwd FROM users");
    $validity->execute();
    while ($result = $validity->fetchAll())
    {
      foreach($result as $row)
      { 
        if ($row['user_pwd'] == $old_pass)
        {
            try {
                $new = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            }
        
            catch   (PDOException $event) {
                print "Error!: " . $event->getMessage(). "<br/>";
                die();
            }
            $set_pass = $new->prepare("UPDATE `users` 
                                        SET `user_pwd` = '$new_pass' 
                                        WHERE `user_pwd` = '$old_pass'");
            $set_pass->execute();
            header('Location:  usr_settings.php');
        }
        else
        {
            echo("Old Pasword is incorrect");
            header('Location:  change_password.php');
        }
      }
    }
}
else
{
    echo("Old Password is incorrect");
    header('Location:  change_password.php');
}



?>