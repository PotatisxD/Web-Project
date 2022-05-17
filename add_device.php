<?php
// Ted.R Code
include_once('template.php');
echo $navigation;
if (isset($_POST['name'])) {

//Validates the strings will be safe to place in a query
$name = $mysqli->real_escape_string($_POST['name']);
$type = $mysqli->real_escape_string($_POST['type']);
$room = $mysqli->real_escape_string($_POST['room']);
//query to insert into database
$query = <<<END
INSERT INTO project_Device(DeviceName,DeviceTypeID,RoomID)
VALUES('{$name}','{$type}','{$room}')
END;
$mysqli->query($query);
// Gets the most recently added device and creates a On/Off property with the default being Off.
$query2 = <<<END
SELECT DeviceID 
FROM project_Device
ORDER BY DeviceID DESC
LIMIT 1;
END;
$result = $mysqli->query($query2);
$deviceid = $result->fetch_object();
$userid = $_SESSION['userId'];
$query3 = <<<END
INSERT INTO project_DevicePropertyOverTime VALUES (NULL, 1, {$deviceid->DeviceID}, "Off", CURRENT_TIMESTAMP)
END;
$mysqli->query($query3);
echo 'Product added to the database!';
}

//queries against the database for room and devicetype info
$sql = "SELECT * FROM project_Room";
$all_rooms = $mysqli->query($sql);
$sqltwo = "SELECT * FROM project_DeviceType";
$all_types = $mysqli->query($sqltwo);
?>
<body>
<h1>Add device</h1>
<form method="post" action="add_device.php">
<input type="text" name="name" placeholder="Device name" required><br>
<label for="type">Choose device type:</label>
<select name="type">
        <!--Fetches the result from query above into an associative array-->
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
<label for="room">Choose which room:</label>
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
<input type="submit" value="Add device">
<input type="reset" value="reset">
</form>
    </body>