<?php
// Kenny.L (Quang) Code, basically the same as delete_user.php in the same project, but with minor changes to query and code.
include_once('template.php');
$query = <<<END
SELECT * 
FROM project_Admin
END;
$res = $mysqli->query($query);
if (isset($_GET['id']) and isset($_SESSION['userId']) and $res->num_rows > 1) {
// Deletes the admin entry in the database using DELETE SQL statement with UserID in GET. Then returns to the page admins.php afterwards.
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