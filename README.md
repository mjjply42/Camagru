# Camagru
A social web Application template for taking, sharing, and liking photographs.

<img src="https://i.ibb.co/MR353Hr/Screen-Shot-2019-04-08-at-8-37-19-PM.png" width="800" />

# Tools Used
<p>JavaScript</p>
<p>PHP</p>
<p>HTML5/CSS</p>
<p>MAMP</p>

## Installation
Using MAMP for Server and MySQL database:
- Connect to MySQL:

  -The default port setup for the project is **8889**
  ```php
  $DB_PORT = 8889;
  ```
  -You can change the MySQL connection in the MAMP System Preferences, or you will manually have to go through certain files to chnage the connection manually. The files are listed below
  <details>
  <summary>
  <i>File Names</i>
  </summary>
  <p>avatar_load.php</p>
  <p>check_forgot_pass.php</p>
  <p>check_new_user.php</p>
  <p>comment.php</p>
  <p>database.php</p>
  <p>delete_pic.php</p>
  <p>file_gall_Upload.php</p>
  <p>file_prof_Upload.php</p>
  <p>file_stick_Upload.php</p>
  <p>gallery_load.php</p>
  <p>grab_comments.php</p>
  <p>new_usr_session.php</p>
  <p>savephoto.php</p>
  <p>search.php</p>
  <p>send_likes.php</p>
  <p>sticker_load.php</p>
  <p>table_create.php</p>
  <p>usr_user_search.php</p>
  </details
- Build Database in root of project folder

  ```
  php setup.php
  ```
You can manually add users and manage the database through the PHPMyAdmin account that is bundled with the MAMP package, or setup actual accounts by signing up.

## User Profile
The User Profile is in its very infancy of design.
<img src="https://i.ibb.co/ZJ2KSLC/Screen-Shot-2019-04-08-at-10-26-13-PM.png" width="800" />

From this screen you can make the following changes:

  -Update Username
  
  -Update Password
  
  -Update Email
  
  -Take and Delete Photos
  
  -Search for other Users and thei Galleries
  
  -Upload photos directly to gallery
  
  -Upload Stickers to be merged (while taking photos)
  
  -Upload User Profile Picture
  
  -Go Home
  
  <img src="https://media.giphy.com/media/St8lXv7lRoa6g8Q4By/giphy.gif" width="800"/>

# Creator
### Matthew Jones
###### <a href="github.com/mjjply42">Github</a>
###### <a href="twitter.com/canthavecowmilk">@canthavecowmilk</a>
