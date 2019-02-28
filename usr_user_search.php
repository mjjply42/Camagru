<?php


$query = $_POST['search'];

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "camagru";
$DB_CHARSET = "utf8mb4";
$DB_PORT = 8889;
$DB_SET_DSN = "mysql:host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";

try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }
catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
  die();
}
$grab = $conn->prepare("SELECT `user_usrname`, `user_id`
                        FROM `users`");
$grab->execute();
while($result = $grab->fetchAll())
{
  foreach($result as $row)
  {
    $profile = $row['user_usrname'];
    $id = $row['user_id'];
    if ($profile == $query)
    {
      header("Location: search.php?user=".$profile."&id=".$id."");
    }
    else
    {
      echo("User not found!");
    }
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Search Users</title>
  </head>
  <body>
  
  </body>
</html>