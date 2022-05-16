<?php
// Kenny.L (Quang) Code, inspiration from lab 7 (delete_products.php).
include_once('template.php');
// Checks if the user is a logged in user/admin
if (isset($_GET['id']) and isset($_SESSION['userId'])) {
// Deletes using DELETE SQL statement.
$query = <<<END
DELETE FROM project_User
WHERE UserID = '{$_GET['id']}'
END;
$mysqli->query($query);
header('Location:users.php');
}
echo $navigation;
?>