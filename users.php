<?php
$title = "Users";
require_once('template.php');
$content = '<h1>Users</h1>';
$query = <<<END
SELECT *
FROM project_User

END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->UserName} |
{$row->Password} |
{$row->UserID}<br>
<a href="user_details.php?id={$row->UserID}">User Description</a>
<br>
END;
if (isset($_SESSION['userId'])){
$content .= <<<END
|<a href="delete_user.php?id={$row->UserID}" onclick="return confirm('Are you sure?')">
Remove User</a>|
<a href="edit_user.php?id={$row->UserID}">Edit User</a><br>
<br>
END;
} 
}
}
$content .= <<<END
<br>
<a href="admins.php"><button>LIST ALL CURRENT ADMINS</button></a>
<br>
<a href="add_admin.php"><button>ADD NEW ADMIN</button></a>
END;
echo $navigation;
echo $content;
?>