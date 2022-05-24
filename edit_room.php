<?php
// Felix.C Code but most of is the same as edit_device only swapped names and changed the form. Credit goes to Ted
include_once('template.php');
// Checks if form has been completed and updates the room and then moves user to room.php
if (isset($_GET['RoomID'])) {
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$query = <<<END
UPDATE project_Room
SET Room = '{$name}'
WHERE RoomID = '{$_GET['RoomID']}'
END;
$mysqli->query($query);
header('Location:rooms.php');
}
}
// Gets the devicetype to be edited
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_Room WHERE RoomID='{$_GET["RoomID"]}'"));

echo $navigation;
?>
<!--Creates a form to change name of devicetype-->
<h1>Edit Room</h1>
<form method="post" action="edit_room.php?RoomID=<?php echo $dname["RoomID"]?>">
<input type="text" name="name" value="<?php echo $dname["Room"];?>" required><br>
<input type="submit" value="Save changes">
</form>