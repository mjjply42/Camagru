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

if (!file_exists("pics_".$_SESSION['username'].""))
{
  mkdir("pics_".$_SESSION['username']."");
}
if (!file_exists("pics_".$_SESSION['username']."/pics_alpha_" .$_SESSION['username'].""))
{
  mkdir("pics_".$_SESSION['username']."/pics_alpha_".$_SESSION['username']."");
}
if (!file_exists("pics_".$_SESSION['username']."/profile_img"))
{
  mkdir("pics_".$_SESSION['username']."/profile_img");
}

?>
<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="user_profile.css">  
  <meta charset="UTF-8">
    <title>Camagru - Profile</title>
  </head>
  <body>
      <h1 class="user"><?php echo($_SESSION['username']);?>'s Profile</h1>
      <div class="avatar">
      </div>
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_prof_Upload.php">
      <br>Profile Picture
      <input id="fileupload" name="myfile" type="file" value="Upload Avatar" />
      <input type="submit" value="submit" id="submit" />
      </form>
      <div class="form">
      <form method="POST" action="usr_profile.php">
      <input class="logout" type="submit" value="Logout" name="logout"></input>
      </form>
      <button class="settings">Settings</button>
      <button class="test">test</button>
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_stick_Upload.php">
      <br>Upload Sticker
      <input id="fileupload" name="myfile" type="file" />
      <input type="submit" value="submit" id="submit" />
      </form>
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_gall_Upload.php">
      <br>Upload Gallery Photo
      <input id="fileupload" name="myfile" type="file" value="Upload Gallery" />
      <input type="submit" value="submit" id="submit" />
      </form>
      <form action="usr_user_search.php" method="POST" autocomplete="off">
        <input type="text" placeholder="Search for User..." class="search_bar" name="search">
        <input type="submit" value="Search" class="search_but">
      </form>
      
      </div>
      <br><div class="home">Home</div>
      <button class="toggle" onclick="myFunction();">View Gallery</button>
      <div class="gallery">
      </div>
      <div class="stickers_">
      <!-- <button type="button" onclick="alert('Hello World!')"><img src="cat2.png"></button>-->
      </div>
      <script>
      var user = document.querySelector(".user").innerText;
      user = user.slice(0, -10);
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
                add.src = ("pics_"+ user+ "/" + img);
              });
            }
          });

          $.ajax(
          {
            type: "Get",
            url: "avatar_load.php",
            dataType: 'text',
            success: function(data) 
            {
                var new_ = document.createElement("img");
                var avatar = document.querySelector(".avatar");
                avatar.appendChild(new_);
                new_.src = ("pics_"+ user+ "/" + "profile_img" + "/" + data);;
            }
          });
      });

      $.ajax(
          {
            type: "Get",
            url: "sticker_load.php",
            dataType: "JSON",
            success: function(data) 
            {
              data.forEach(function(img)
              {
                var add = document.createElement("img");
                var input = document.createElement("input");
                input.type = "radio";
                input.name = img;
                input.value = img;
                var sticker = document.querySelector(".stickers_");
                sticker.appendChild(input);
                sticker.appendChild(add);
                sticker.appendChild(document.createElement("br"));
                add.src = ("pics_"+ user+ "/" + "pics_alpha_" + user + "/" + img);

              });
            }
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