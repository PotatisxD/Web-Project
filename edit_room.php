<?php
include_once('template.php');
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
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_Room WHERE RoomID='{$_GET["RoomID"]}'"));

echo $navigation;
?>
<body>
<h1>Edit Room</h1>
<form method="post" action="edit_room.php?RoomID=<?php echo $dname["RoomID"]?>">
<input type="text" name="name" value="<?php echo $dname["Room"];?>" required><br>
<input type="submit" value="Save changes">
</form>
</body>