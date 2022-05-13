<?php
include_once('template.php');
$query = <<<END
SELECT * 
FROM project_Admin
END;
$res = $mysqli->query($query);
if (isset($_GET['id']) and isset($_SESSION['userId']) and $res->num_rows > 1) {
$query = <<<END
DELETE FROM project_Admin
WHERE UserID = '{$_GET['id']}'
END;
$mysqli->query($query);
header('Location:admins.php');
}
else
{
    header('Location:admins.php');
}
echo $navigation;
?>