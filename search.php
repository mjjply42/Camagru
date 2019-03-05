<?php
session_start();
$user = $_GET['user_search'];
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
    <div class="img_con">
        <img class="fly_out" src='' id="">
    </div>
    <div>
        <div>
            <div class="like-con">
                <span class="like" onclick="sendLike();" style="font-size:500%;color: grey;">&hearts;</span>
            <p1 class="likes"><?php 
            $conn = null;
            try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }
            catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
                die();
            }

            $grab = $conn->prepare("SELECT like_, img_id, commenter FROM id_img_stat");
            $grab->execute();
            $count = 0;
            while($result = $grab->fetchAll())
            {
                foreach($result as $row)
                {
                    if($row['like_'] == 1)
                        $count++;
                }
            }
            echo($count);
            ?></p1>
            </div>
            <div class="comments">
            </div>
            <br>
            <form class="post_comment" method="POST" autocomplete="off">
                <input class="com_con" style="width: 90%;" type="text" name="comment" placeholder="Post A Comment..">
                <input type="submit" name="enter" onclick="post_com(event);" value="Enter">
            </form>
        </div>
    </div>
  </div>
</div>
<script>

function        sendLike()
{
    var im_id = document.querySelector(".fly_out").id;

    $.ajax(
    {
        type: "Post",
        url: "send_likes.php",
        data: {'image_id': im_id},
        success: function(data) 
        {
            var heart = document.querySelector(".like");
            var count = document.querySelector(".likes").textContent;
            if (data == 1)
            {
                heart.style.color = 'red';
                count = parseInt(count);
                count++;
                document.querySelector(".likes").textContent = count;
            }
            else
            {
                heart.style.color = 'grey';
                count = parseInt(count);
                count--;
                document.querySelector(".likes").textContent = count;

            }
        }
    });
}

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
    var im_id = document.querySelector(".fly_out").id;
    $.ajax(
    {
        type: "Post",
        url: "grab_comments.php",
        data: {'image_id': mod_im.id},
        dataType: "JSON",
        success: function(data) 
        {
            data.forEach(function(com)
            {
                var new_div = document.createElement("div");
                var new_comm = document.createElement("p");
                var com_sec = document.querySelector(".comments");
                new_div.classList.add("new_div_com");
                com_sec.appendChild(new_div);
                new_comm.innerText = com;
                new_div.appendChild(new_comm);
            });
        }
    });
    

}

span.onclick = function() {
    var input = document.querySelector(".com_con");
    input.value = '';
    modal.style.display = "none";
    var comments = document.querySelector(".comments");
        while(comments.childElementCount >= 1)
            comments.removeChild(document.querySelector(".new_div_com"));
}

window.onclick = function(event) {
    if (event.target == modal) {
        var comments = document.querySelector(".comments");
        while(comments.childElementCount >= 1)
            comments.removeChild(document.querySelector(".new_div_com"));
        modal.style.display = "none";
    }
    var input = document.querySelector(".com_con");
    input.value = '';
}

function post_com(event) 
{ 
    var comment = document.querySelector(".com_con");
    var text = comment.value
    var im_id = document.querySelector(".fly_out").id;
    var lengths = comment.value;

    
    $.ajax(
    {
        type: "Post",
        url: "comment.php",
        data:{'comment': text,
                'image_id': im_id },
        success: function(data) 
        {
            var comments = document.querySelector(".comments");
            while(comments.childElementCount >= 2)
                comments.removeChild(document.querySelector(".new_div_com"));
            $.ajax(
            {
                type: "Post",
                url: "grab_comments.php",
                data: {'image_id': im_id},
                dataType: "JSON",
                success: function(data) 
                {
                    data.forEach(function(com)
                    {
                        var new_div = document.createElement("div");
                    var new_comm = document.createElement("p");
                    var com_sec = document.querySelector(".comments");
                    new_div.classList.add("new_div_com");
                    com_sec.appendChild(new_div);
                    new_comm.innerText = com;
                    new_div.appendChild(new_comm);
                    });
                }
            });
        }
    });
    comment.value = '';
}
</script>
  </body>
</html>