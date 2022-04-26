<?php
include_once('template.php');
echo $navigation;
if (isset($_POST['name'])) {

$name = $mysqli->real_escape_string($_POST['name']);
$type = $mysqli->real_escape_string($_POST['type']);
$room = $mysqli->real_escape_string($_POST['room']);
$query = <<<END
INSERT INTO project_Device(DeviceName,DeviceTypeID,RoomID)
VALUES('{$name}','{$type}','{$room}')
END;
$mysqli->query($query);
$query2 = <<<END
SELECT DeviceID 
FROM project_Device
WHERE DeviceName="{$name}" AND DeviceTypeID="{$type}" AND RoomID="{$room}"
LIMIT 1;
END;
$result = $mysqli->query($query2);
$deviceid = $result->fetch_object();
$userid = $_SESSION['userId'];
$query3 = <<<END
INSERT INTO project_PropertyOverTime VALUES (NULL, 1, {$deviceid->DeviceID}, "Off", CURRENT_TIMESTAMP, {$userid})
END;
$mysqli->query($query3);
echo 'Product added to the database!';
}

$sql = "SELECT * FROM project_Room";
$all_rooms = $mysqli->query($sql);
$sqltwo = "SELECT * FROM project_DeviceType";
$all_types = $mysqli->query($sqltwo);
?>
<body>
<h1>Add device</h1>
<form method="post" action="add_device.php">
<input type="text" name="name" placeholder="Device name"><br>
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
<input type="submit" value="Add device">
<input type="reset" value="reset">
</form>
    </body>