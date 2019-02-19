<?php

session_start();
if(!empty($_POST['old_em']) && !empty($_POST['new_em']) && ($_POST['old_em'] == $_SESSION['email']))
{
    $old_email = $_POST['old_em'];
    $new_email = $_POST['new_em'];
    echo($old_email);
    echo($new_email);
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
    $validity = $conn->prepare("SELECT user_email FROM users");
    $validity->execute();
    while ($result = $validity->fetchAll())
    {
      foreach($result as $row)
      { 
        if ($row['user_email'] == $old_email)
        {
            try {
                $new = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            }
        
            catch   (PDOException $event) {
                print "Error!: " . $event->getMessage(). "<br/>";
                die();
            }
            $set_email = $new->prepare("UPDATE `users` 
                                        SET `user_email` = '$new_email' 
                                        WHERE `user_email` = '$old_email'");
            $set_email->execute();
            $_SESSION['email'] = $new_em;
            header('Location:  usr_settings.php');
        }
        else
        {
            echo("Old Email is incorrect");
            header('Location:  change_email.php');
        }
      }
    }
}
else
{
    echo("Old Email is incorrect");
    header('Location:  change_email.php');
}


?>