<?php
include_once('template.php');
if (isset($_GET['DeviceID'])) {
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$type = $mysqli->real_escape_string($_POST['type']);
$room = $mysqli->real_escape_string($_POST['room']);
$query = <<<END
UPDATE project_Device
SET DeviceName = '{$name}',
DeviceTypeID = '{$type}',
RoomID = '{$room}'
WHERE DeviceID = '{$_GET['DeviceID']}'
END;
$mysqli->query($query);
}
}
$sql = "SELECT * FROM project_Room";
$all_rooms = $mysqli->query($sql);
$sqltwo = "SELECT * FROM project_DeviceType";
$all_types = $mysqli->query($sqltwo);

$sqlthree = <<<END
SELECT * FROM project_Device 
WHERE DeviceID = '{$_GET["DeviceID"]}'
END;
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_Device WHERE DeviceID='{$_GET["DeviceID"]}'"));

echo $navigation;
?>
<body>
<h1>Edit device</h1>
<form method="post" action="edit_device.php?DeviceID=<?php echo $dname["DeviceID"]?>">
<input type="text" name="name" value="<?php echo $dname["DeviceName"];?>" required><br>
<label for="type">Choose device type:</label>
<select name="type">
        <?php 
        while ($type = mysqli_fetch_array(
            $all_types,MYSQLI_ASSOC)):; 
        ?>
        <option value="<?php echo $type["DeviceTypeID"];
        ?>">
        <?php echo $type["DeviceType"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
</select><br>
<label for="room">Choose which room:</label>
<select name="room">
        <?php 
        while ($room = mysqli_fetch_array(
            $all_rooms,MYSQLI_ASSOC)):; 
        ?>
        <option value="<?php echo $room["RoomID"];
        ?>">
        <?php echo $room["Room"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
</select><br>
<input type="submit" value="Save changes">
</form>
</body>