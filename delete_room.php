<?php
include_once('template.php');
if (isset($_GET['RoomID']) and isset($_SESSION['userId'])) {
$query = <<<END
DELETE FROM project_Room
WHERE RoomID='{$_GET['RoomID']}'
END;
$mysqli->query($query);
header('Location:rooms.php');
}

echo $navigation;
?>