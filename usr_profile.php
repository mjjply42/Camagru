<?php
include_once 'database.php';
session_start();
echo($_FILES['myfile']['name']);

try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
    die(); }
$validity = $conn->prepare("SELECT `user_email`, `user_usrname`, `user_id` FROM users");
$validity->execute();
while ($result = $validity->fetchAll())
{
  foreach($result as $row)
  { 
    if ($row['user_usrname'] == $_SESSION['username'])
    {
      $_SESSION['email'] = $row['user_email'];
      $id = $_SESSION['id'] = $row['user_id'];
    }
  }
} 
if (isset($_POST['logout']))
{
  $_SESSION['logged'] = false;
}
if ($_SESSION['logged'] == false)
  header('Location:  login.php');
$conn = null;
try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>"; 
  die(); }

$gal_check = $conn->prepare("SELECT table_id
                            FROM  id_img_stat");
$gal_check->execute();
if (!$result = $gal_check->fetchAll())
{
  $conn = null;
  try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

  catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>"; 
    die(); }
  $insert = $conn->prepare("INSERT INTO profile_info
                                      (`user_id`, `image_id`, `pic_`, `create_date`, `status`)
                            VALUES ($id, 00,'no_images.png',DATE(NOW()),'private' );
                            INSERT INTO id_img_stat 
                                      (img_id, comment, commenter, like_)
                            VALUES (00, 'null', 00, 'false')");
  $insert->execute();
}
if (!file_exists("pics_" .$_SESSION['username'].""))
{
  mkdir("pics_".$_SESSION['username']."");
}
?>
<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Camagru - Profile</title>
  </head>
  <body>
      <h1>User Profile</h1>
      <div class="form">
      <form method="POST" action="usr_profile.php">
      <input class="logout" type="submit" value="Logout" name="logout"></input>
      </form>
      <button class="settings">Settings</button>
      <button class="test">test</button>
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="usr_profile.php">
      <input id="fileupload" name="myfile" type="file" />
      <input type="submit" value="submit" id="submit" />
      </form>
      </div>
      <br><div class="home">Home</div>
      <div class="gallery">
      </div>
      <script>

      var settings = document.querySelector(".settings");
      var home = document.querySelector(".home");
      home.addEventListener('click', Home);
      settings.addEventListener('click', toSettings);
      function toSettings()
      {
        window.location.href = '/usr_settings.php';
      }
      function    Home()    { document.location.href = "index.php"};
      $(document).ready(function() 
      {
          $.ajax(
          {
            type: "Get",
            url: "test.php",
            data: " ",
            success: function(data) 
            {
              while (data)
              {
                foreach (data as value)
                {
                  var add = document.createElement("img");
                  var gallery = document.querySelector(".gallery");
                  gallery.appendChild(add);
                  add.src = value;
                }
              }
              
            }
          });
      });
  
  
      </script>
  </body>
</html>