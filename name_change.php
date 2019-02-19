<?php

session_start();
echo($_SESSION['username']);
echo($_POST['old_u']);
if(!empty($_POST['old_u']) && !empty($_POST['new_u']) && ($_POST['old_u'] == $_SESSION['username']))
{
    $old_username = $_POST['old_u'];
    $new_username = $_POST['new_u'];
    echo($old_username);
    echo($new_username);
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
    $validity = $conn->prepare("SELECT user_usrname FROM users");
    $validity->execute();
    while ($result = $validity->fetchAll())
    {
      foreach($result as $row)
      { 
        if ($row['user_usrname'] == $old_username)
        {
            try {
                $new = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            }
        
            catch   (PDOException $event) {
                print "Error!: " . $event->getMessage(). "<br/>";
                die();
            }
            $set_name = $new->prepare("UPDATE `users` 
                                        SET `user_usrname` = '$new_username' 
                                        WHERE `user_usrname` = '$old_username'");
            $set_name->execute();
            $_SESSION['username'] = $new_username;
            header('Location:  usr_settings.php');
        }
        else
        {
            echo("Old Username is incorrect");
            //header('Location:  change_username.php');
        }
      }
    }
            

}
else
{
    echo("Old Username is incorrect");
    //header('Location:  change_username.php');
}

?>