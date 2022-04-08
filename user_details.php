<?php
include_once('template.php');
$content = '<h1>User Details</h1>';
if (isset($_GET['id'])) {
$query = <<<END
SELECT *
FROM project_User
WHERE UserID = '{$_GET['id']}'
END;
$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
if ($res->num_rows > 0) {
$row = $res->fetch_object();
$content = <<<END
<h2>User Details</h2>
User id: {$row->UserID}<br>
UserName: {$row->UserName}<br>
Password: {$row->Password}<br>
END;
}
}
echo $navigation;
echo $content;
?>




