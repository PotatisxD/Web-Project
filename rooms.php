<?php
$title = "Rooms";
require_once('template.php');
$content = '<h1>Rooms</h1>';
$query = <<<END
SELECT Room, RoomID
FROM project_Room
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->Room}<br>
END;

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
$content .= <<<END
    <a href="delete_room.php?RoomID={$row->RoomID}" onclick="return confirm('Are you sure you want to remove this room?This will delete all devices in this room as well.')">
    Remove room</a> |
    <a href="edit_room.php?RoomID={$row->RoomID}">Edit room</a><br>
    <br>
END;
}
}
$content .= <<<END
<button onclick="location.href='add_room.php'" type="button">
Add Room</button>
END;
}
echo $navigation;
echo $content;
?>