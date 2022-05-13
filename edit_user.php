<?php
include_once('template.php');
$content = 'Edit USER';
 if (isset($_GET['id'])) {
 if (isset($_POST['name'])) {
$query = <<<END
UPDATE project_User
SET UserName = '{$_POST['name']}', Password= '{$_POST['password']}'
WHERE UserID = '{$_GET['id']}'
END;
$mysqli->query($query);
}
 $query = <<<END
SELECT *
FROM project_User
WHERE UserID = '{$_GET['id']}'
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
$row = $res->fetch_object();
$content = <<<END
<h1>Edit User</h1>
<form method="post" action="edit_user.php?id={$row->UserID}">
<input type="text" name="name" value="{$row->UserName}"><br>
<input type="text" name="password" value="{$row->Password}"><br>

<input type="submit" value="save">
</form>
END;
}
}
echo $navigation;
echo $content;
?>