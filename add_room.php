<?php
include_once('template.php');
echo $navigation;
if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$query = <<<END
INSERT INTO project_Room
VALUES (NULL,'{$name}')
END;
$mysqli->query($query);
echo 'Room added to the database!';
}
?>
<body>
<h1>Add Room</h1>
<form method="post" action="add_room.php">
<input type="text" name="name" placeholder="Room name"><br>
<input type="submit" value="Add Room">
<input type="reset" value="reset">
</form>
</body>