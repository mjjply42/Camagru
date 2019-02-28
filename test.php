<?php
###THIS STATEMENT RIPS AND COPIES THE IMAGE_ID
#INSERT INTO id_img_stat (`img_id`)
##SELECT `image_id`
##FROM profile_info
##WHERE pic_ = '$fileName'");
///session_start();

//header("Content-type: image/png");
//$img = imagecreatefrompng("dog.png");
//$alph = imagecreatefrompng("cat2.png");
//$she = imagesy($alph);
//$swi = imagesx($alph);
//$dhe = 200;
//$dwi = 200;
////$dest = imagecreatetruecolor($swi, $she);
//imagecopyresampled($dest, $alph, 0, 0, 0, 0, $dhe, $dwi, $she, $swi);
// use imagecopymerge instead and set the copied image opacity to 50
//imagecopy($img, $dest, 0, 0, 0, 0, 200, 200); 
//imagepng($img);
//imagedestroy($img);
//imagepng($dest ,100);
//imagedestroy($dest);


?>

<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>Camagru - TestZone</title>
  </head>
  <body>
  <script>
  $(document).ready(function() 
      {
          $.ajax(
          {
            type: "Post",
            url: "tester_.php",
            data:{'comment': 'hjbdjhbjhbfjdhbfjdhfbdjhf'},
            success: function(data) 
            {
              console.log("dope");
            }
          });
  </script>
  </body>
</html>