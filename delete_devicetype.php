<?php
// Felix Code, deletes the given DeviceType
include_once('template.php');
if (isset($_GET['DeviceTypeID']) and isset($_SESSION['userId'])) {
$query = <<<END
DELETE FROM project_DeviceType
WHERE DeviceTypeID='{$_GET['DeviceTypeID']}'
END;
$mysqli->query($query);
header('Location:devicetypes.php');
}
echo $navigation;
?>