<?php
$title = "Rooms";
require_once('template.php');
$content = '<h1>Rooms</h1>';
// Selects all rooms
$query = <<<END
SELECT Room, RoomID
FROM project_Room
END;
$res = $mysqli->query($query);
// Loops through all rooms and echoes their name and adds the options to edit and remove them.
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->Room}<br>
END;
$content .= <<<END
    <a href="delete_room.php?RoomID={$row->RoomID}" onclick="return confirm('Are you sure you want to remove this room?This will delete all devices in this room as well.')">
    Remove room</a> |
    <a href="edit_room.php?RoomID={$row->RoomID}">Edit room</a><br>
    <br>
END;
}
// After loop add a single button to add a room
$content .= <<<END
<button onclick="location.href='add_room.php'" type="button">
Add Room</button>
END;
}
echo $navigation;
echo $content;
?>