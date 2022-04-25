<?php
$title = "Current Admins";
require_once('template.php');
$content = '<h1>Current Admins</h1>';
$query = <<<END
SELECT *
FROM project_Admin

END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->UserID}<br>
END;
if (isset($_SESSION['userId'])){
$content .= <<<END
| <a href="user_details.php?id={$row->UserID}">User Description of UserID: {$row->UserID} </a> |
<br>
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