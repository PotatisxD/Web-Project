<?php
// Felix Code, deletes the given room
include_once('template.php');
// if the GET variable and session is set, a query will run
if (isset($_GET['RoomID']) and isset($_SESSION['userId'])) {
// The query deletes the room entry in the database with RoomID in GET
$query = <<<END
DELETE FROM project_Room
WHERE RoomID='{$_GET['RoomID']}'
END;
$mysqli->query($query);
header('Location:rooms.php');
}
echo $navigation;
?>