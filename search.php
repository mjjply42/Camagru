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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="search_usr.css">
  </head>
  <body>
  <nav class="navbar navbar-light bg-light">
  <form class="form-inline log" method="POST" autocomplete="off" action="usr_profile.php">
      <input class="logout btn btn-primary btn-sm" type="submit" value="Logout" name="logout"></input>

  </form>
  <form action="usr_user_search.php" method="POST" autocomplete="off">
        <input type="text" placeholder="Search for User..." class="search_bar" name="search">
        <input type="submit" class="btn btn-primary" value="Search" class="search_but">
      </form>
</nav>
<div class="contain">
<div class="btn btn-info btn-lg" id="home">Home</div><br><br><br>
  <h1 class="owner"><?php echo($user); ?> 's Gallery</h1><br>
    <div class="content">
        <div class="search_gall"></div>
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
                echo("<div id='".$image_id."' class='".$image_name." img_div card'><img id='".$image_id."' onclick='modalFunc(event);'data-toggle='modal' data-target='#exampleModalCenter' src='./pics_".$user."/".$image_name."'></div>");
            }
        }
    }
  $conn = null;
  ?>
  <div class="modal fade myModal" id="exampleModalCenter"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="img_con">
                <img class="fly_out" src='' id="">
            </div>
        </div>
        
        <div class="modal-body">
            <div class="like-con">
                <span class="like" onclick="sendLike();" style="font-size:500%;color: grey;">&hearts;</span>
                    <p1 class="likes">
                        <?php 
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
                        ?>
                    </p1>
            </div>
            <div class="comments"></div>
            <br>
                <form class="post_comment" method="POST" autocomplete="off">
                    <input class="com_con form-control" type="text" name="comment" placeholder="Post A Comment.."><br>
                    <input type="submit" class="btn btn-primary btn-lg" name="enter" onclick="post_com(event);" value="Enter">
                </form>
        </div>
    </div>
    </div>
    </div>

<script>
var home = document.querySelector("#home");
home.addEventListener('click', Home);
function    Home()    { window.location.href = "index.php"; }

function        sendLike()
{
    var im_id = document.querySelector(".fly_out").id;
    console.log(im_id);

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
                console.log(data);
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
var modal = document.querySelector('.myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var mod_im = document.querySelector(".fly_out");
 
function modalFunc(event) {
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
            while(comments.childElementCount >= 1)
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
<div class="footer"></div>
</div>
  </body>
</html>