<?php
session_start();
$fileSize = $_FILES['myfile']['size'];
$fileName = $_FILES['myfile']['name'];
$fileLocation = $_FILES['myfile']['tmp_name'];
$first = explode('.', $fileName);
$second = end($first);
$fileExt = strtolower($second);
$list = getimagesize($fileName);

if ($list[0] > 700 || $list[1] > 700)
    {
        echo("File is too large. Width is: ".$list[0]. " and Height is: ".$list[1].". Both need to be less than 650");
        exit();
    }

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
if (!file_exists("pics_" .$_SESSION['username']. "/pics_alpha_" .$_SESSION['username']."/$fileName"))
{
    echo("HERE");
    move_uploaded_file($_FILES['myfile']['tmp_name'], "pics_" .$_SESSION['username']. "/pics_alpha_" .$_SESSION['username']."/$fileName");
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
    $set = $conn->prepare("SELECT pic_, `status`
                            FROM profile_info
                            WHERE pic_ = '$fileName'");
    $set->execute();
    while($result = $set->fetchAll())
    {
        #################AJAX
        foreach($result as $row)
        {
            if ($row['status'] == "private" )
                echo("Sticker already exists Cannot re-upload");
        }
    }
    
    $id = intval($_SESSION['id']);
    $conn = null;
    try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }
    catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
        die(); }
    $new = $conn->prepare("INSERT INTO profile_info
                        (`user_id`, `create_date`, `status`, `pic_`)
                        VALUES ($id, DATE(NOW()), 'private', '$fileName')");
    $new->execute();
    header("Location:   usr_profile.php");
    
}
echo("File currently exists");
?>