<?php
// Kenny.L (Quang) Code, inspiration from lab 7 (products.php)
$title = "Users";
require_once('template.php');
$content = '<h1>Users</h1>';
// Retrieve data from database
$query = <<<END
SELECT *
FROM project_User

END;
$res = $mysqli->query($query);
// Loops through all users and displays their UserName, Password, and UserID. Also adds the options to edit and/or remove the users. Creates hyperlinks for desc, remove and edit (Changes depending on logged in/logged off user).
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->UserName} |
{$row->Password} |
{$row->UserID}<br>
<a href="user_details.php?id={$row->UserID}">User Description</a> 
END;
// Adds hyperlinks if logged in
if (isset($_SESSION['userId'])){
$content .= <<<END
|<a href="delete_user.php?id={$row->UserID}" onclick="return confirm('Are you sure?')">
Remove User</a> |
<a href="edit_user.php?id={$row->UserID}">Edit User</a><br>
<br>
END;
} 
}
}
// Adds buttons connected to admins.php and add_admin.php to be able to list all admins, and also add new admins.
$content .= <<<END
<br>
<a href="admins.php"><button>LIST ALL CURRENT ADMINS</button></a>
<br>
<a href="add_admin.php"><button>ADD NEW ADMIN</button></a>
END;
echo $navigation;
echo $content;
?>