<?php
// Felix.C Code but most of is the same as edit_device only swapped names and changed the form. Credit goes to Ted
include_once('template.php');
// Checks if form has been completed and updates the devicetype and then moves user to devicetype.php
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
// Gets the devicetype to be edited
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_DeviceType WHERE DeviceTypeID='{$_GET["DeviceTypeID"]}'"));

echo $navigation;
?>
<!--Creates a form to change name of devicetype-->
<body>
<h1>Edit Room</h1>
<form method="post" action="edit_devicetype.php?DeviceTypeID=<?php echo $dname["DeviceTypeID"]?>">
<input type="text" name="name" value="<?php echo $dname["DeviceType"];?>" required><br>
<input type="submit" value="Save changes">
</form>
</body>