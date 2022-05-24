<?php
// Felix.C Code but most of is the same as add_device only swapped names and changed the form as well as some of the code. Credit goes to Ted
include_once('template.php');
echo $navigation;
// Checks if the form has been completed and inserts the new devicetype to the databse
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$query = <<<END
INSERT INTO project_DeviceType
VALUES (NULL,'{$name}')
END;
$mysqli->query($query);
echo 'DeviceType added to the database!';
}
?>
<!--Form to input the name for the new devicetype-->
<h1>Add DeviceType</h1>
<form method="post" action="add_devicetype.php">
<input type="text" name="name" placeholder="DeviceType name" required><br>
<input type="submit" value="Add DeviceType">
<input type="reset" value="reset">
</form>