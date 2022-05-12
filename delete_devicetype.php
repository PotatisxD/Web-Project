<?php
include_once('template.php');
// if the GET variable and session is set, a query will run
if (isset($_GET['DeviceTypeID']) and isset($_SESSION['userId'])) {
// The query deletes the devicetype entry in the database with DeviceTypeID in GET
$query = <<<END
DELETE FROM project_DeviceType
WHERE DeviceTypeID='{$_GET['DeviceTypeID']}'
END;
$mysqli->query($query);
header('Location:devicetypes.php');
}
echo $navigation;
?>