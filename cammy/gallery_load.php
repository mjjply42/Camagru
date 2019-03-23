<?php
session_start();
if(!isset($_POST['offset']))
{
    $offset = 0;
}
else
{
    $offset = $_POST['offset'];
}
$id = intval($_SESSION['id']);
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

$test = $conn->prepare("SELECT pic_, image_id, status FROM profile_info WHERE `user_id` = '$id' LIMIT $offset, 1");
$test->execute();

$images = array();
while($result = $test->fetchAll())
{
    foreach ($result as $row)
    {
        if ($row['status'] != "private")
        {
            $var = $row['pic_'];
            array_push($images, $var);
        }
    }
    echo(json_encode($images));
    exit();
}
echo(0);
?>