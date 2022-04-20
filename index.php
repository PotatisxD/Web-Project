<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="media/style.css">
<link rel="stylesheet" href="sidebars.css">
<title><?php if(isset($title)){echo $title;} else {echo "Smart Home";} ?></title></head>
<?php
$content = <<<END
<h1>Welcome to this website</h1>
<p>
This is gonna be a Smart Home GUI
</p>
<li class="nav-item">
            <a href="login.php" class="nav-link text-white" aria-current="page"  id="login">
                <svg class="bi me-2" width="16" height="16" >
                    <use xlink:href="#Login" />
                </svg>
                Login
            </a>
</li>
END;
echo $content;
?>