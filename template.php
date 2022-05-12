<!--Created by both Kenny and Felix-->
<!DOCTYPE html>
<html lang="en">
<head>
<!--Adds some padding to the body since every page that uses the template will have the navbar-->
<style>
body{padding-left: 280px}
</style>
<meta charset="utf-8">
<link rel="stylesheet" href="media/style.css">
<link rel="stylesheet" href="sidebars.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--Changes the title depending on what page is currently used-->
<title><?php if(isset($title)){echo $title;} else {echo "Smart Home";} ?></title></head>
<?php
require_once("sessionsetup.php");
include("log.php");
require_once("configDB.php");
// Gets page name
$current_Page = basename($_SERVER['PHP_SELF'], ".php");
// Navbar created by Kenny from the bootstrap template https://getbootstrap.com/docs/5.1/examples/sidebars/ , Felix.C only added the last script as well as this part: position: fixed; margin-left:-280px;. Used by End users
$navigation = <<<END
<nav navbar-static-left>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="position: fixed; margin-left:-280px; width: 280px; height: 100vh; float: left;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto navbar-nav">
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
// Felix.C code, Checks if someone is logged in then checks if that user is admin.
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
    // Navbar created by Kenny from the bootstrap template https://getbootstrap.com/docs/5.1/examples/sidebars/, Felix.C only added the last script as well as this part: position: fixed; margin-left:-280px;. Used by Admin Users
    $navigation = <<<END
    <nav class="">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="position: fixed; margin-left:-280px; width: 280px; height: 100vh; float: left;">
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
                <a href="devicetypes.php" class="nav-link text-white" id="devicetypes">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#devicetypes" />
                    </svg>
                    DeviceTypes
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
// Kenny code, adds the option to register a new user and displays what person is logged in.
$navigation .= <<<END
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
// Felix.C code, Logs the user info
LogUserInfo();
$navigation .= '</nav>';
?>
