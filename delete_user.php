<?php
include_once('template.php');
if (isset($_GET['id']) and isset($_SESSION['userId'])) {
$query = <<<END
DELETE FROM project_User
WHERE UserID = '{$_GET['id']}'
END;
$mysqli->query($query);
header('Location:users.php');
}
echo $navigation;
?>