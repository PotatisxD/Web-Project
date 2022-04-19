<?php
$host = "localhost";
$user = "felcar21"; 
$pwd = "AmsOzPBsKR";
$db = "felcar21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
$deviceid = $_GET['DeviceID'];
$query = <<<END
SELECT project_PropertyOverTime.Value
FROM project_PropertyOverTime
WHERE Value="On" AND DeviceID="{$deviceid}" OR Value="Off" AND DeviceID="{$deviceid}"
ORDER BY TimeStamp DESC
LIMIT 1;
END;
$res = $mysqli->query($query);
$row = $res->fetch_object();



if($row->Value == "On")
{
$query = <<<END
INSERT INTO project_PropertyOverTime VALUES (NULL, 1 , {$deviceid}, "Off", CURRENT_TIMESTAMP, 1)
END;
$mysqli->query($query);
echo "Off";
}
else 
{
$query = <<<END
INSERT INTO project_PropertyOverTime VALUES (NULL, 1 , {$deviceid}, "On", CURRENT_TIMESTAMP, 1)
END;
echo "On";
$mysqli->query($query);
}


?>