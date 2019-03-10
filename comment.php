<?php
session_start();
$im_id = intval($_POST['image_id']);
$comment = $_POST['comment'];
$commenter = intval($_SESSION['id']);

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

$check = $conn->prepare("SELECT `img_id`, `comment`, `commenter`
                        FROM    `id_img_stat`");
$check->execute();
while($result = $check->fetchAll())
{
    foreach($result as $row)
    {
        if ($row['img_id'] == $im_id && $row['comment'] == $comment && $row['commenter'] == $commenter)
        {
            echo("Cannot post similar comments!");
            exit();
        }
    }
}
$conn = null;
try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }
catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
  die();
}

$set = $conn->prepare("INSERT INTO `id_img_stat`(`img_id`, `comment`, `commenter`) 
                        VALUES ($im_id, '$comment', $commenter)");
$set->execute();
?>