<?php
include_once('template.php');
$content = 'Edit USER';
if (isset($_GET['id'])) {
 if (isset($_POST['name'])) {
 $query = <<<END
UPDATE project_User
 SET UserName = '{$_POST['name']}',
 WHERE id = '{$_GET['id']}'
END;
 $mysqli->query($query);
 }
 $query = <<<END
SELECT * FROM project_User
 WHERE id = '{$_GET['id']}'
END;
 $res = $mysqli->query($query);
 if ($res->num_rows > 0) {
 $row = $res->fetch_object();
 $content = <<<END
<form method="post" action="edit_user.php?id={$row->id}">
 <input type="text" name="name" value="{$row->name}"><br>

 <input type="submit" value="save">
 </form>
END;
 }
}
echo $navigation;
echo $content;
?>