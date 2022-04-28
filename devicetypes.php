<?php
$title = "DeviceType";
require_once('template.php');
$content = '<h1>DeviceTypes</h1>';
$query = <<<END
SELECT DeviceType, DeviceTypeID
FROM project_DeviceType
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->DeviceType}<br>
END;

if (isset($_SESSION['userId']))
{
$current_UserID = $_SESSION['userId'];
$current_User = $_SESSION['username'];
$query = <<<END
SELECT * 
FROM project_Admin
WHERE UserID="{$current_UserID}"
END;
$result = $mysqli->query($query);
if (mysqli_num_rows($result) != 0)
$content .= <<<END
    <a href="delete_devicetype.php?DeviceTypeID={$row->DeviceTypeID}" onclick="return confirm('Are you sure you want to remove this devicetype? This will delete all devices of this type as well.')">
    Remove DeviceType</a> |
    <a href="edit_devicetype.php?DeviceTypeID={$row->DeviceTypeID}">Edit DeviceType</a><br>
    <br>
END;
}
}
}
echo $navigation;
echo $content;
?>