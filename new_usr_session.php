<?php

session_start();
$_SESSION['logged'] = true;
if($_GET['verify'] == $_SESSION['verify'])
     header("Location: usr_profile.php");
else
    header("Location: login.php");
?>