<?php
// Kenny.L (Quang) Code, inspiration from lab 7 (logout.php)
include('template.php');
// Creates empty array, then destroys the session and redirects you to index.php, the homepage
$_SESSION = array();
session_destroy();
header("Location:index.php");
?>