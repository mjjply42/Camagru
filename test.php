<?php
###THIS STATEMENT RIPS AND COPIES THE IMAGE_ID
#INSERT INTO id_img_stat (`img_id`)
##SELECT `image_id`
##FROM profile_info
##WHERE pic_ = '$fileName'");
session_start();


$base = explode(",", $_POST['base_64']);
$round_1 = uniqid($base);
$round_2 = uniqid($round_1);
$check = base64_decode($base[1]);
$new_image = $round_2.".png";
file_put_contents($new_image, $check);

$img = imagecreatefrompng($new_image);
$alph = imagecreatefrompng("cat1.png");
$she = imagesy($alph);
$swi = imagesx($alph);
$dhe = 200;
$dwi = 200;
$dest = imagecreatetruecolor($swi, $she);
imagealphablending($dest, false);
imagecopyresampled($dest, $alph, 0, 0, 0, 0, $dhe, $dwi, $she, $swi);
// use imagecopymerge instead and set the copied image opacity to 50
imagecopy($img, $dest, 0, 0, 0, 0, 200, 200);
header("Content-type: image/png");
imagepng($img,"./pics_".$_SESSION['username']."/".$new_image);
imagedestroy($img);
imagepng($dest ,100);
imagedestroy($dest);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - TestZone</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        dsfgnhj
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
©