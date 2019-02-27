<?php
include_once 'database.php';
session_start();

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

if (!file_exists("pics_alpha_" .$_SESSION['username'].""))
{
  mkdir("pics_alpha_".$_SESSION['username']."");
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
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_stick_Upload.php">
      <input id="fileupload" name="myfile" type="file" />
      <input type="submit" value="submit" id="submit" />
      </form>
      </div>
      <br><div class="home">Home</div>
      <button class="toggle" onclick="myFunction()">View Gallery</button>
      <div class="gallery">
      </div>
      <script>
      var x = document.querySelector(".gallery");
      x.style.display = "none";
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
            url: "gallery_load.php",
            dataType: "JSON",
            success: function(data) 
            {
              data.forEach(function(img)
              {
                var add = document.createElement("img");
                var gallery = document.querySelector(".gallery");
                gallery.appendChild(add);
                add.src = (img);
              });
            }
          });
      });
      function myFunction() 
      {
        var x = document.querySelector(".gallery");
        var y = document.querySelector(".toggle")
        if (x.style.display === "none") 
        {
          y.innerText = "Hide Gallery";
          x.style.display = "block";
        }
        else 
        {
          y.innerText = "View Gallery";
          x.style.display = "none";
        }
      }
  
      </script>
  </body>
</html>