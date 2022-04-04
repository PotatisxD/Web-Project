<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="media/css/style.css">
<link rel="stylesheet" href="sidebars.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Smart Home GUI</title></head>

<?php
session_name('Website');
session_start();
$host = "localhost";
$user = "felcar21"; 
$pwd = "AmsOzPBsKR";
$db = "felcar21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
include("log.php");
$navigation = <<<END
<nav>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh; float: left;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16" >
                    <use xlink:href="#home" />
                </svg>
                Home
            </a>
        </li>
        <li>
            <a href="devices.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#devices" />
                </svg>
                Devices
            </a>
        </li>
        <li>
            <a href="rooms.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#rooms" />
                </svg>
                Rooms
            </a>
        </li>
        <li>
            <a href="analytics.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#analytics" />
                </svg>
                Analytics
            </a>
        </li>
        <li>
        <a href="login.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#login" />
            </svg>
            Login
        </a>
    </li>
    <hr>
END;

if (isset($_SESSION['userId']))
{
    
}
LogUserInfo();
 $navigation .= '</nav>';

?>
