<?php
// Ted.R Code
include_once('template.php');
if (isset($_GET['DeviceID'])) {
if (isset($_POST['name'])) {
//Validates the strings will be safe to place in a query
$name = $mysqli->real_escape_string($_POST['name']);
$type = $mysqli->real_escape_string($_POST['type']);
$room = $mysqli->real_escape_string($_POST['room']);
//query to update the database entries
$query = <<<END
UPDATE project_Device
SET DeviceName = '{$name}',
DeviceTypeID = '{$type}',
RoomID = '{$room}'
WHERE DeviceID = '{$_GET['DeviceID']}'
END;
$mysqli->query($query);
header('Location:devices.php');
}
}
//queries against the database for room and devicetype info
$sql = "SELECT * FROM project_Room";
$all_rooms = $mysqli->query($sql);
$sqltwo = "SELECT * FROM project_DeviceType";
$all_types = $mysqli->query($sqltwo);
//query against the database for the specific device
$sqlthree = <<<END
SELECT * FROM project_Device 
WHERE DeviceID = '{$_GET["DeviceID"]}'
END;
$dname=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM project_Device WHERE DeviceID='{$_GET["DeviceID"]}'"));

echo $navigation;
?>
<h1>Edit device</h1>
<form method="post" action="edit_device.php?DeviceID=<?php echo $dname["DeviceID"]?>">
<input type="text" name="name" value="<?php echo $dname["DeviceName"];?>" required><br>
<label>Choose device type:</label>
<select name="type">
        <!--Fetches the result from the queries into an associative array-->
        <?php 
        while ($type = mysqli_fetch_array(
            $all_types,MYSQLI_ASSOC)):; 
        ?>
        <!--echos the content from DeviceType in the database into a drop-down list -->
        <option value="<?php echo $type["DeviceTypeID"];
        ?>">
        <?php echo $type["DeviceType"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
</select><br>
<label>Choose which room:</label>
<select name="room">
        <!--Fetches the result from query above into an associative array-->
        <?php 
        while ($room = mysqli_fetch_array(
            $all_rooms,MYSQLI_ASSOC)):; 
        ?>
        <!--echos the content from DeviceType in the database into a drop-down list -->
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