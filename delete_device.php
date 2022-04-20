<?php
include_once('template.php');
if (isset($_GET['DeviceID']) and isset($_SESSION['userId'])) {
$query = <<<END
DELETE FROM project_Device
WHERE DeviceID='{$_GET['DeviceID']}'
END;
$mysqli->query($query);
header('Location:devices.php');
}

echo $navigation;
?>