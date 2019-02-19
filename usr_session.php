<?php
session_start();
$_SESSION['logged'] = true;
session_write_close();
header("Location: usr_profile.php");
?>