<?php
session_start();

$base = explode(",", $_POST['base_64']);
$round_1 = uniqid($base);
$round_2 = uniqid($round_1);
$check = base64_decode($base[1]);
$new_image = $round_2.".png";
file_put_contents($new_image, $check);
$over_im = $_POST['alpha'];
$img = imagecreatefrompng($new_image);
$alph = imagecreatefrompng($over_im);
$she = imagesy($alph);
$swi = imagesx($alph);
$dhe = 200;
$dwi = 200;
$dest = imagecreatetruecolor($swi, $she);
imagealphablending($dest, false);
imagecopyresampled($dest, $alph, 0, 0, 0, 0, $dwi, $dhe, $swi, $she);
imagecopy($img, $dest, 0, 0, 0, 0, 200, 200);
header("Content-type: image/png");
imagepng($img,"./pics_".$_SESSION['username']."/".$new_image);
imagedestroy($img);
imagepng($dest ,100);
imagedestroy($dest);
unlink($new_image);

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
                        WHERE pic_ = '$new_image'");
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
                        VALUES ($id, DATE(NOW()), 'public', '$new_image')");
  $new->execute();
  header("Location:   usr_profile.php");
}
?>