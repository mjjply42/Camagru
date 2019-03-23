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
  unset($_SESSION['email']);
  unset($_SESSION['id']);
  unset($_SESSION['prevent']);
  unset($_SESSION['verify']);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="user_profile.css">  
  <link rel="stylesheet" href="search_usr.css">  
  <meta charset="UTF-8">
    <title>Camagru - Profile</title>
  </head>
  <body>
  <nav class="navbar navbar-light bg-light">
  <form class="form-inline log" method="POST" autocomplete="off">

    <form method="POST" action="usr_profile.php">
      <input class="logout btn btn-primary btn-sm" type="submit" value="Logout" name="logout"></input>
<<<<<<< HEAD
    </form>
  </form>
  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Update Login
  </button>
  <form class="dropdown-menu p-4" action="name_change.php" method='POST' autocomplete='off'>
  <div class="form-group">
    <label>Login</label>
    <input type="text" class="form-control" name="old_u">
  </div>
  <div class="form-group">
    <label>New Login</label>
    <input type="text" name="new_u" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary" name="Submit" value="submit">Update</button>
</form>
  </div>

  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Update Email
  </button>
  <form class="dropdown-menu p-4" action="email_change.php" method='POST' autocomplete='off'>
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="old_em">
  </div>
  <div class="form-group">
    <label>New Email</label>
    <input type="text" name="new_em" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary" name="Submit" value="submit">Update</button>
</form>
  </div>

  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Update Password
  </button>
  <form class="dropdown-menu p-4" action="password_change.php" method='POST' autocomplete='off'>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="old_pass">
  </div>
  <div class="form-group">
    <label>New Password</label>
    <input type="text" name="new_pass" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary" name="Submit" value="submit">Update</button>
</form>
  </div>

=======
      </form>
  </form>
  <div class="dropdown">
  <button class="settings btn btn-primary btn-md dropdown-toggle" id="dropdownMenuButtton" data-toggle="dropdown">Settings</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="/change_username.php">Change Username</a>
    <a class="dropdown-item" href="/change_password.php">Change Password</a>
    <a class="dropdown-item" href="/change_email.php">Change Email</a>
  </div>
  </div>
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
  <form action="usr_user_search.php" method="POST" autocomplete="off">
        <input type="text" placeholder="Search for User..." class="search_bar" name="search">
        <input type="submit" class="btn btn-primary" value="Search" class="search_but">
  </form>
  </nav>
  <div class="body_container">
    <div class="btn btn-primary btn-lg home" id="home">Home</div><br><br><br>
    <div class="gall_zone">
      <button class="toggle btn btn-primary btn-lg btn-block view_gall" onclick="myFunction();">View Gallery</button>
<<<<<<< HEAD
        <div class="gallery">
        </div>
=======
      <div class="gallery">
      </div>
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
      <div class="spinner-border" style="display: none;" role="status">
  <span class="sr-only">Loading...</span>
</div>
    </div>
      <div class="profile_area">
      <h1 class="user"><?php echo($_SESSION['username']);?>'s Profile</h1>
      <div class="avatar">
      </div>
      </div>
      <div class="Uploads">
      <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_prof_Upload.php">
      <br>New Profile Picture
      <input id="fileupload" name="myfile" type="file" value="Upload Avatar" />
      <input type="submit" value="submit" id="submit" />
      </form>
        <form id="uploadbanner" enctype="multipart/form-data" method="post" action="file_gall_Upload.php">
        <br>New Upload Gallery Photo
        <input id="fileupload" name="myfile" type="file" value="Upload Gallery" />
        <input type="submit" value="submit" id="submit" />
        </form>
      <form id="uploadstick" enctype="multipart/form-data" method="post" action="file_stick_Upload.php">
      <br>New Upload Sticker<br>
      <input id="fileupload" class="stick_up"name="myfile" type="file" />
      <input type="submit" value="submit" id="submit" />
      </form>
      </div>
      <div class="video-container">
        <button id="takephoto" data-toggle="modal" data-target="#snapModal">Take Photo</button>
        <div class="modal fade" id="snapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <video autoplay></video>
        <h1 class="modal-title" id="exampleModalLabel">Press 'Capture'!</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button id="clear_image" type="button" class="btn btn-primary" style="display: none;">Clear Image</button>
        <img type="image/jpeg"class="img_" src="">
        <div class="form-group">
<<<<<<< HEAD
=======
    <label for="filter">Filter Select</label>
    <select class="form-control" id="filter">
      <option>Sepia</option>
      <option>Grayscale</option>
      <option>Opacity</option>
      <option>Saturate</option>
      <option>Contrast</option>
    </select>
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
  </div>
        <div class="stickers_">
      </div>
        <canvas class="fit_" style="display:none;"></canvas>
      </div>
      <div class="modal-footer">
        <button id="capture" type="button" class="btn btn-primary">Capture</button>
        <button id="shoot" type="button" class="btn btn-success">Screenshot</button>
        <button id="stop" type="button" class="btn btn-danger">Stop</button>
        <button id="save" type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
      var clear_butt = document.querySelector("#clear_image");
      var title = document.querySelector(".modal-title");
      var loading = document.querySelector(".spinner-border");
<<<<<<< HEAD
      var stick_path = "";
      var stickers = document.querySelector(".stickers_");
      var gallery = document.querySelector(".gallery");
      var media;
      img.style.display = 'none';
      
=======
      var filt = document.querySelector("#filter");
      var media;
      img.style.display = 'none';

>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
      clear_butt.onclick = function()
      {
        if (img.style.display != 'none')
        {
          img.style.display = 'none';
          clear_butt.style.display = "none";
          title.textContent = "Take A Picture!";
        }
      }
      start_butt.onclick = function()
      {
        navigator.mediaDevices.getUserMedia(constraints).then(success).catch(handleError);
      }
      stop.onclick = function()
      {
        if (video.srcObject != null)
        {
          video.srcObject = null;
          media.getTracks().forEach(function (media) {
            media.stop();
          img.style.display = 'none';
          clear_butt.style.display = 'none';
          title.textContent = "Press 'Capture'!";
          });
        }
      }
      
      save.onclick = function ()
      {
        var img_src = document.querySelector(".img_").src;
        $.ajax(
        {
          type: "Post",
<<<<<<< HEAD
          url: "savephoto.php",
          data:{ 'base_64': img_src,
                  'alpha':  stick_path},
=======
          url: "test.php",
          data:{ 'base_64': img_src},
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
          beforeSend: function()
          {
            loading.style.display = "";
          },
          success: function(data) 
          {
            title.textContent = "Take a Picture!";
<<<<<<< HEAD
=======
            console.log("We good");
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
            loading.style.display = "none";
          }
        });
      }

      shoot.onclick = video.onclick = function() 
      {
        img.style.display = 'block';
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        img.src = canvas.toDataURL('image/png');
        clear_butt.style.display = 'block';
        title.textContent = "Save your new picture!";
<<<<<<< HEAD
=======
        var option = filt.options.selectedIndex;
        var set_filter = filt.item(filt.options.selectedIndex).value;
        img.style.filter = set_filter + "(100%)";
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
      };

      function    handleError()
      {
        exit("Error in stream");
      }

      function    success(stream)
      {
        shoot.disabled = false;
        media = video.srcObject = stream;
        title.textContent = "Pick your Sticker!";
      }
      var user = document.querySelector(".user").innerText;
      user = user.slice(0, -10);
      var x = document.querySelector(".gallery");
      x.style.display = "none";
      var settings = document.querySelector(".settings");
      var home = document.querySelector(".home");
      home.addEventListener('click', Home);
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
                  gallery.appendChild(add);
                  add.src = ("default/no_images.png");
                }
                else
                {
                  data.forEach(function(img_)
                  {
                    var add = document.createElement("img");
                    add.className = "gall_image";
                    gallery.appendChild(add);
                    add.src = ("pics_"+ user+ "/" + img_);
                  });
                  var load = document.createElement("button");
                  load.innerText = "Load More";
                  load.type = "button";
                  load.className = "btn btn-link load_more btn-block";
                  load.onclick = check;
                  gallery.appendChild(load);
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
                  var input = document.createElement("input");
                  var st_div = document.createElement("div");
                  input.type = "image";
                  st_div.id = 'stick_div';
                  input.className = "stickers_"
                  input.name = img_;
                  input.value = img_;
                  input.id = img_;

                  input.onclick = function updateSrc() 
                  { 
                    var tmp= input.src.split("/");
                    stick_path = "./" + tmp[3] + "/" + tmp[4] + "/" + tmp[5];
                  }

                  var sticker = document.querySelector(".stickers_");
                  sticker.appendChild(st_div);
                  st_div.appendChild(input);
                  st_div.appendChild(document.createElement("br"));
                  input.src = ("pics_"+ user+ "/" + "pics_alpha_" + user + "/" + img_);
                });
              }
            }
          });
      function check()
      {
        var img_count = document.querySelector(".gallery").childElementCount - 1;
        var so_far = img_count;
        var images = document.querySelector(".gallery");
        images.removeChild(document.querySelector(".load_more"));
        $.ajax(
          {
            type: "POST",
            url: "gallery_load.php",
            dataType: "JSON",
            data: {'count': img_count,
                    'offset': so_far},
            success: function(data)
            {
              data.forEach(function(img_)
              {
                var add = document.createElement("img");
                add.className = "gall_image";
                gallery.appendChild(add);
                add.src = ("pics_"+ user+ "/" + img_);
              });
                var load = document.createElement("button");
                load.innerText = "Load More";
                load.type = "button";
                load.className = "btn btn-link load_more btn-block";
                load.onclick = check;
                gallery.appendChild(load);
            }
          });
      }

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
<<<<<<< HEAD

=======
>>>>>>> e043165548e7e01d3586b26d0c10e7748732360e
      </script>
      </div>
  </body>
</html>