<?php
include_once('template.php');
if (isset($_GET['DeviceTypeID'])) {
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$query = <<<END
UPDATE project_DeviceType
SET DeviceType = '{$name}'
WHERE RoomID = '{$_GET['DeviceTypeID']}'
END;
$mysqli->query($query);
header('Location:devicetype.php');
}
}
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_DeviceType WHERE DeviceTypeID='{$_GET["DeviceTypeID"]}'"));

echo $navigation;
?>
<body>
<h1>Edit Room</h1>
<form method="post" action="edit_devicetype.php?DeviceTypeID=<?php echo $dname["DeviceTypeID"]?>">
<input type="text" name="name" value="<?php echo $dname["DeviceType"];?>" required><br>
<input type="submit" value="Save changes">
</form>
</body>