<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="media/style.css">
<link rel="stylesheet" href="sidebars.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title><?php if(isset($title)){echo $title;} else {echo "Smart Home";} ?></title></head>

<?php
session_name("s" . ip2long($_SERVER["REMOTE_ADDR"]));
session_start();
include("log.php");
require_once("configDB.php");
$current_Page = basename($_SERVER['PHP_SELF'], ".php");
$navigation = <<<END
<nav>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh; float: left;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="home.php" class="nav-link text-white" aria-current="page"  id="home">
                <svg class="bi me-2" width="16" height="16" >
                    <use xlink:href="#home" />
                </svg>
                Home
            </a>
        </li>
        <li>
            <a href="devices.php" class="nav-link text-white" id="devices">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#devices" />
                </svg>
                Devices
            </a>
        </li>
        <li>
        <a href="logout.php" class="nav-link text-white" id="logout">
            <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#login" />
            </svg>
            Logout
        </a>
    </li>
    <hr>
    <script>
    document.getElementById("{$current_Page}").className += " active";
    </script>
END;
if (isset($_SESSION['userId']))
{
$current_UserID = $_SESSION['userId'];
$current_User = $_SESSION['username'];
$query = <<<END
SELECT * 
FROM project_Admin
WHERE UserID="{$current_UserID}"
END;
$result = $mysqli->query($query);
if (mysqli_num_rows($result) != 0)
{
    $navigation = <<<END
    <nav>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh; float: left;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="home.php" class="nav-link text-white" aria-current="page"  id="home">
                    <svg class="bi me-2" width="16" height="16" >
                        <use xlink:href="#home" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="devices.php" class="nav-link text-white" id="devices">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#devices" />
                    </svg>
                    Devices
                </a>
            </li>
            <li>
                <a href="rooms.php" class="nav-link text-white" id="rooms">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#rooms" />
                    </svg>
                    Rooms
                </a>
            </li>
            <li>
                <a href="users.php" class="nav-link text-white" id="users">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#analytics" />
                    </svg>
                    Users
                </a>
            </li>
            <li>
                <a href="analytics.php" class="nav-link text-white" id="analytics">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#analytics" />
                    </svg>
                    Analytics
                </a>
            </li>
            <li>
                <a href="devicetypes.php" class="nav-link text-white" id="devicetypes">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#devicetypes" />
                    </svg>
                    DeviceTypes
                </a>
            </li>
            <li>
            <a href="logout.php" class="nav-link text-white" id="logout">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#login" />
                </svg>
                Logout
            </a>
        </li>
        <hr>
        <script>
        document.getElementById("{$current_Page}").className += " active";
        </script>
END;
$navigation .= <<<END
<a href="add_device.php">Add deivce</a>
<a href="register.php">Reigster new user</a>
Logged in as {$current_User}
</div>
</ul>
END;
}
else
{
$navigation .= <<<END
Logged in as {$current_User}
END;
}
}
LogUserInfo();
 $navigation .= '</nav>';

?>
