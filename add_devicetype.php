<?php
include_once('template.php');
echo $navigation;
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
<body>
<h1>Add DeviceType</h1>
<form method="post" action="add_devicetype.php">
<input type="text" name="name" placeholder="DeviceType name"><br>
<input type="submit" value="Add DeviceType">
<input type="reset" value="reset">
</form>
</body>