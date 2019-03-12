<?php
session_start();
$fileSize = $_FILES['myfile']['size'];
$fileName = $_FILES['myfile']['name'];
$fileLocation = $_FILES['myfile']['tmp_name'];
$fileExt = strtolower(end(explode('.', $fileName)));

if (($fileExt != "png") && ($fileExt != "jpg")){
    ##################################AJAX
    echo("Only png files or jpeg files allowed for upload");
    exit();
}
if ($fileSize >= 32000000){
    ##################################AJAX
    echo("File size is too large for upload");
    exit();
}
if (!file_exists("pics_" .$_SESSION['username']."/$fileName"))
{
    move_uploaded_file($_FILES['myfile']['tmp_name'], "pics_" .$_SESSION['username']. "/$fileName");
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
        die(); }

    $set = $conn->prepare("SELECT pic_
                            FROM profile_info
                            WHERE pic_ = '$fileName'");
    $set->execute();
    if($result = $set->fetchAll())
    {
        #################AJAX
        echo("Sticker already exists Cannot re-upload");
    }
    else
    {
        $id = intval($_SESSION['id']);
        $conn = null;
        try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

        catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
            die(); }
        $new = $conn->prepare("INSERT INTO profile_info
                            (`user_id`, `create_date`, `status`, `pic_`)
                            VALUES ($id, DATE(NOW()), 'public', '$fileName')");
        $new->execute();
        header("Location:   usr_profile.php");
    }
}
?>