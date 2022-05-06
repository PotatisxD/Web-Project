<!--Felix.C Code-->
<?php
$host = "localhost";
$user = "felcar21"; 
$pwd = "AmsOzPBsKR";
$db = "felcar21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
if($mysqli ->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>