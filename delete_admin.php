<?php
include_once('template.php');
if (isset($_GET['id']) and isset($_SESSION['userId'])) {
 $query = <<<END
DELETE FROM project_Admin
WHERE UserID = '{$_GET['id']}'
END;
 $mysqli->query($query);
 header('Location:admins.php');
}
echo $navigation;
?>