<?php
// Kenny.L (Quang) Code, re-used code from user.php (in the same project) with minor changes to queries and code.
$title = "Current Admins";
require_once('template.php');
$content = '<h1>Current Admins</h1>';
// Retrieve data from database
$query = <<<END
SELECT *
FROM project_Admin

END;
$res = $mysqli->query($query);
// Loops through all admins and displays their UserID. Also adds hyperlinks for user description and the removal of admin-rights.
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->UserID}<br>
END;
if (isset($_SESSION['userId'])){
$content .= <<<END
| <a href="user_details.php?id={$row->UserID}">User Description of UserID: {$row->UserID} </a> |
| <a href="delete_admin.php?id={$row->UserID}" onclick="return confirm('Are you sure?')">
Remove Administrative rights</a> |
<br>
END;
} 
}
}
echo $navigation;
echo $content;
?>