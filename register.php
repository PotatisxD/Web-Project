<?php
include('template.php');
if (isset($_POST['username']) and isset($_POST['password'])) {
$name = $mysqli->real_escape_string($_POST['username']);
$pwd = $mysqli->real_escape_string($_POST['password']);
$query = <<<END
INSERT INTO project_User(UserName,Password)
 VALUES('{$name}','{$pwd}')
END;
 if ($mysqli->query($query) !== TRUE) {
 die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
 header('Location:index.php');
 }
}
$content = <<<END
<form method="post" action="register.php">
<input type = "text" name="username" placeholder="username" ><br>
<input type="password" name="password" placeholder="password"><br>
<input type="submit" value="Register">
<input type="Reset" value="reset">
</form>
END;
echo $navigation;
echo $content;
?>