<?php
require_once('template.php');
$content = '<h1>Devices</h1>';
$query = <<<END
SELECT project_Device.DeviceName, project_Room.Room, project_DeviceType.DeviceType
FROM project_Device
INNER JOIN project_DeviceType USING (DeviceTypeID)
LEFT JOIN project_Room USING (RoomID)
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->DeviceName} |
{$row->DeviceType} |
{$row->Room}<br>
END;
}
}
echo $navigation;
echo $content;
?>