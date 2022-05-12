<?php
// Ted.R Code
include_once('template.php');
// if the GET variable and session is set, the query will run
if (isset($_GET['DeviceID']) and isset($_SESSION['userId'])) {
// The query deletes the device entry in the database with DeviceID in GET
$query = <<<END
DELETE FROM project_Device
WHERE DeviceID='{$_GET['DeviceID']}'
END;
$mysqli->query($query);
header('Location:devices.php');
}

echo $navigation;
?>