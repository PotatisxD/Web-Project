<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Home Gui</title>
<meta charset="utf-8">
<link rel="stylesheet" property="stylesheet" type="text/css" href="css/stylesheet.css">
</head>

<?php
session_name('Website');
session_start();
$host = "localhost";
$user = "felcar21"; 
$pwd = "AmsOzPBsKR";
$db = "felcar21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
$navigation = <<<END
<nav>
 <a href="index.php">Home</a>
 <a href="about.php">About</a>
 <a href="devices.php">Devices</a>
 <a href="login.php">LOGIN</a>
END;

if (isset($_SESSION['userId']))
{
 $navigation .= <<<END
 <a href="add_product.php">Add product</a>
 <a href="register.php">Reigster new user</a>
 <a href="logout.php">Logout</a>
 Logged in as {$_SESSION['username']}
END;
}
 $navigation .= '</nav>';

?>
