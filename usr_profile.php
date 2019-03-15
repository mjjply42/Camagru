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
  unset($_SESSION['logged']);
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
      <form id="uploadstick" enctype="multipart/form-data" method="post" action="file_stick_Upload.php">
      <br>Upload Sticker
      <input id="fileupload" class="stick_up"name="myfile" type="file" />
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
      </div>
      <div class="video-container">
        <video autoplay></video>
        <button id="capture">Capture</button>
        <button id="shoot">Screenshot</button>
        <button id="stop">Stop</button>
        <button id="save">Save</button>
        <img type="image/jpeg"class="img_" src="">
        <canvas class="fit_" style="display:none;"></canvas>
      </div>
      <script>
      const constraints = {
        video: true
      };

      const video = document.querySelector('video');
      var start_butt = document.querySelector("#capture");
      var shoot = document.querySelector("#shoot");
      var img = document.querySelector(".img_");
      var canvas = document.querySelector(".fit_");
      var stop = document.querySelector("#stop");
      var media;
      img.style.display = 'none';

      start_butt.onclick = function()
      {
        navigator.mediaDevices.getUserMedia(constraints).then(success).catch(handleError);
      }
      stop.onclick = function()
      {
        video.srcObject = null;
        media.getTracks().forEach(function (media) {
          media.stop();
        });
      }
      
      save.onclick = function ()
      {
        var img_src = document.querySelector(".img_").src;
        $.ajax(
        {
          type: "Post",
          url: "test.php",
          data:{ 'base_64': img_src },
          success: function(data) 
          {
            console.log("We good");
          }
        });
      }

      shoot.onclick = video.onclick = function() {
        img.style.display = 'block';
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        img.src = canvas.toDataURL('image/png');
      };

      function    handleError()
      {
        exit("Error in stream");
      }
      function    success(stream)
      {
        shoot.disabled = false;
        media = video.srcObject = stream;
      }
      

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
              if (data == 0)
                {
                  var add = document.createElement("img");
                  var gallery = document.querySelector(".gallery");
                  gallery.appendChild(add);
                  add.src = ("default/no_images.png");
                }
                else
                {
                  data.forEach(function(img_)
                  {
                    var add = document.createElement("img");
                    var gallery = document.querySelector(".gallery");
                    gallery.appendChild(add);
                    add.src = ("pics_"+ user+ "/" + img_);
                  });
                }
            }
          });

          $.ajax(
          {
            type: "Get",
            url: "avatar_load.php",
            dataType: 'text',
            success: function(data) 
            {
              if (data == 0)
              {
                var new_ = document.createElement("img");
                var avatar = document.querySelector(".avatar");
                avatar.appendChild(new_);
                new_.src = ("default/blank_profile.png");
              }
              else
              {
                var new_ = document.createElement("img");
                var avatar = document.querySelector(".avatar");
                avatar.appendChild(new_);
                new_.src = ("pics_"+ user+ "/" + "profile_img" + "/" + data);
              }
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
              if (data == 0)
              {
                var add = document.createElement("img");
                var input = document.createElement("input");
                input.type = "radio";
                var sticker = document.querySelector(".stickers_");
                sticker.appendChild(input);
                sticker.appendChild(add);
                sticker.appendChild(document.createElement("br"));
                add.src = ("default/no_images.png");
              }
              else
              {
                data.forEach(function(img_)
                {
                  var add = document.createElement("img");
                  var input = document.createElement("input");
                  input.type = "radio";
                  input.name = img_;
                  input.value = img_;
                  var sticker = document.querySelector(".stickers_");
                  sticker.appendChild(input);
                  sticker.appendChild(add);
                  sticker.appendChild(document.createElement("br"));
                  add.src = ("pics_"+ user+ "/" + "pics_alpha_" + user + "/" + img_);
                });
              }
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