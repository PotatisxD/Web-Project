<?php
$title = "Devices";
require_once('template.php');
if(isset($_SESSION['username']))
{
    $current_UserID = $_SESSION['userId'];
}
$content = '<h1>Devices</h1>';
$query = <<<END
SELECT project_Device.DeviceName, project_Room.Room, project_DeviceType.DeviceType, project_Device.DeviceID
FROM project_Device
INNER JOIN project_DeviceType USING (DeviceTypeID)
LEFT JOIN project_Room USING (RoomID)
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$query2 = <<<END
SELECT project_PropertyOverTime.Value
FROM project_PropertyOverTime
WHERE Value="On" AND DeviceID="{$row->DeviceID}" OR Value="Off" AND DeviceID="{$row->DeviceID}"
ORDER BY TimeStamp DESC
LIMIT 1;
END;
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_object();

$content .= <<<END
{$row->DeviceName} |
{$row->DeviceType} |
{$row->Room}
<button class = "{$row2->Value}" id="button{$row->DeviceID}" onclick="SetStatus({$row->DeviceID})">{$row2->Value}</button><br>

END;
}
}
$content .= <<<END
<script>
function SetStatus(counter){
currentButton = document.getElementById("button" + counter);
let response = fetch("DeviceStatus.php?" + new URLSearchParams({DeviceID: counter, UserID: {$current_UserID}}), {
    method: 'get',
}).then(function(response) {
        if (response.status >= 200 && response.status < 300) {
                return response.text()
        }
        throw new Error(response.statusText)
    })
    .then(function(response) {
        currentButton.innerHTML = response;
        currentButton.className = response;

        console.log(currentButton);
        console.log(response);
    })
    
}
</script>
END;
echo $navigation;
echo $content;
?>