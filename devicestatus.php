<?php
// Felix.C Code
require_once("configDB.php");
// Gets the value for DeviceID and UserID from the GET and queries that to get the latest on/off status from the PropertyOverTime table.
$deviceid = $_GET['DeviceID'];
$userid = $_GET["UserID"];
$query = <<<END
SELECT project_PropertyOverTime.Value
FROM project_PropertyOverTime
WHERE Value="On" AND DeviceID="{$deviceid}" OR Value="Off" AND DeviceID="{$deviceid}"
ORDER BY TimeStamp DESC
LIMIT 1;
END;
$res = $mysqli->query($query);
$row = $res->fetch_object();


// Checks the value and queries a insert to turn the device off if it is on or off if it is on then echoes the status that it is swapped to.
if($row->Value == "On")
{
$query = <<<END
INSERT INTO project_DevicePropertyOverTime VALUES (NULL, 1, {$deviceid}, "Off", CURRENT_TIMESTAMP)
END;
$mysqli->query($query);
echo "Off";
}
else 
{
$query = <<<END
INSERT INTO project_DevicePropertyOverTime VALUES (NULL, 1, {$deviceid}, "On", CURRENT_TIMESTAMP)
END;
echo "On";
$mysqli->query($query);
}
?>