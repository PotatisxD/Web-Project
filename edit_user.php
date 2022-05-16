<?php
// Kenny.L (Quang) Code, inspiration from lab 7 (edit_product.php).
include_once('template.php');
$content = 'Edit USER';
 if (isset($_GET['id'])) {
 if (isset($_POST['name'])) {
$name = $mysqli->real_escape_string($_POST['name']);
$pwd = $mysqli->real_escape_string($_POST['password']);
 // Updates using UPDATE SQL statement.
$query = <<<END
UPDATE project_User
SET UserName = '{$_POST['name']}', Password= '{$_POST['password']}'
WHERE UserID = '{$_GET['id']}'
END;
$mysqli->query($query);
header('Location:users.php');
}
// Retrieves data from project_User where UserID = '{$_GET['id']}'
 $query = <<<END
SELECT *
FROM project_User
WHERE UserID = '{$_GET['id']}'
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
$row = $res->fetch_object();
// Form to update User information (with validation)
$content = <<<END
<h1>Edit User</h1>
<form method="post" action="edit_user.php?id={$row->UserID}">
<input type="text" name="name" value="{$row->UserName}" required><br>
<input type="text" name="password" value="{$row->Password}" required><br>

<input type="submit" value="save">
</form>
END;
}
}
echo $navigation;
echo $content;
?>