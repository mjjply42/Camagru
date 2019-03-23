<?php
$im_id = $_POST['image_id'];
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

$test = $conn->prepare("SELECT img_id, comment FROM id_img_stat WHERE `img_id` = $im_id");
$test->execute();

$comments = array();
while($result = $test->fetchAll())
{
    foreach ($result as $row)
    {
        $com = $row['comment'];
        array_push($comments, $com);
    }
    echo(json_encode($comments));
    exit();
}
?>