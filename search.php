<?php
session_start();
$user = $_GET['user'];
$id = intval($_SESSION['id']);

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
  die();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - User <?php echo($user);?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="search_usr.css">
  </head>
  <body>
  <h1><?php echo($user); ?> 's Gallery</h1>
  <div clas="search_gall">
  </div>
  <?php
    $grab = $conn->prepare("SELECT `pic_`, `status`, `user_id`, `image_id`
                            FROM   `profile_info`
                            WHERE   `user_id` = '$id'");
    $grab->execute();
    while($result = $grab->fetchAll())
    {
        foreach($result as $row)
        {
            if($row['status'] != 'private')
            {
                $image_id = $row['image_id'];
                $image_name = $row['pic_'];
                echo("<div id='".$image_id."' class=".$image_name."><img id='".$image_id."' onclick='modalFunc(event);' src='./pics_".$user."/".$image_name."' style='height:250px; width:250px;'></div>");
            }
        }
    }
  $conn = null;
  ?>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <img class="fly_out" src='' id="">
    <div>
        <input class="like" type="submit" value="Like" class="like_but">
        <div>
            <h1>Comments</h1>
            <div class="comments">
            <p>Here is a comment</p>
            </div>
            <br>
            <form class="post_comment" method="POST" autocomplete="off">
                <input class="com_con" type="text" name="comment" placeholder="Post A Comment..">
                <input type="submit" name="enter" onclick="post_com(event);" value="Enter">
            </form>
        </div>
    </div>
  </div>
</div>
<script>
$(".post_comment").submit(function(e) {
    e.preventDefault();
});
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var mod_im = document.querySelector(".fly_out");
 
function modalFunc(event) {
    modal.style.display = "block";
    mod_im.src = event.target.src;
    mod_im.id = (event.target.id);
    

}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function post_com(event) 
{ 
    var comment = document.querySelector(".com_con");
    var text = comment.value
    var im_id = document.querySelector(".fly_out").id;
    
    $.ajax(
    {
        type: "Post",
        url: "comment.php",
        data:{'comment': text,
                'image_id': im_id },
        success: function(data) 
        {
          alert(data);
        }
    });
}
</script>
  </body>
</html>