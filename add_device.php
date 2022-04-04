<?php
include_once('template.php');
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$type = $mysqli->real_escape_string($_POST['type']);
$room = $mysqli->real_escape_string($_POST['room']);
$query = <<<END
INSERT INTO project_Device(DeviceName,DeviceTypeID,RoomID)
VALUES('{$name}','{$type}','{$room}')
END;
$mysqli->query($query);
echo 'Product added to the database!';
}

$sql = "SELECT * FROM project_Room";
$all_rooms = $mysqli->query($sql);


echo $navigation;
?>
<body>
<h1>Add device</h1>
<form method="post" action="add_device.php">
<input type="text" name="name" placeholder="Device name"><br>
<input type="text" name="type" placeholder="type"><br>
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
</select>
<input type="submit" value="Add product">
<input type="reset" value="reset">
</form>
    </body>