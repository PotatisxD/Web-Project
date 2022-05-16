<?php
$title = "DeviceType";
require_once('template.php');
$content = '<h1>DeviceTypes</h1>';
// Selects all devicetypes
$query = <<<END
SELECT DeviceType, DeviceTypeID
FROM project_DeviceType
END;
$res = $mysqli->query($query);
// Loops through all devicetypes and echoes their name and adds the options to edit and remove them.
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->DeviceType}<br>
END;
$content .= <<<END
    <a href="delete_devicetype.php?DeviceTypeID={$row->DeviceTypeID}" onclick="return confirm('Are you sure you want to remove this devicetype? This will delete all devices of this type as well.')">
    Remove DeviceType</a> |
    <a href="edit_devicetype.php?DeviceTypeID={$row->DeviceTypeID}">Edit DeviceType</a><br>
    <br>
END;
}
// After loop adds a single button to add a devicetypes.
$content .= <<<END
<button onclick="location.href='add_devicetype.php'" type="button">
Add DeviceType</button>
END;
}
echo $navigation;
echo $content;
?>