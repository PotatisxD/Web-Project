<?php
// Felix.C Code but most of is the same as add_device only swapped names and changed the form as well as some of the code. Credit goes to Ted
include_once('template.php');
echo $navigation;
// Checks if the form has been completed and inserts the new room to the databse
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
<!--Form to input the name for the new room-->
<body>
<h1>Add Room</h1>
<form method="post" action="add_room.php">
<input type="text" name="name" placeholder="Room name"><br>
<input type="submit" value="Add Room">
<input type="reset" value="reset">
</form>
</body>