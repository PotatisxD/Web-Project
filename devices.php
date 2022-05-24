<?php
// Felix.C Code, inspiration from lab 7 (products.php)
$title = "Devices";
require_once('template.php');
if(isset($_SESSION['username']))
{
    $current_UserID = $_SESSION['userId'];
}
// Query to select all Devices and their type and room
$content = '<h1>Devices</h1>';
$query = <<<END
SELECT project_Device.DeviceName, project_Room.Room, project_DeviceType.DeviceType, project_Device.DeviceID
FROM project_Device
INNER JOIN project_DeviceType USING (DeviceTypeID)
LEFT JOIN project_Room USING (RoomID)
END;
$res = $mysqli->query($query);

// Loops trough all the devices prints them out. Also checks for status to display it correctly on the buttons.
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$query2 = <<<END
SELECT project_DevicePropertyOverTime.Value
FROM project_DevicePropertyOverTime
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
// the last line in content creates a button that changes the status of a device using the SetStatus function.

// Checks if the current user is an admin and adds the the adds the edit and remove link for each device.
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
    <a href="delete_device.php?DeviceID={$row->DeviceID}" onclick="return confirm('Are you sure you want to remove this device?')">
    Remove device</a> |
    <a href="edit_device.php?DeviceID={$row->DeviceID}">Edit device</a><br>
    <br>
END;
}
}
// Checks again if the user is admin outside of the loop to create a single add device button.
if (isset($_SESSION['userId']))
{
if (mysqli_num_rows($result) != 0)
{
$content .= <<<END
<button onclick='location.href="add_device.php"' type="button">Add Device</button>
END;
}
}
}
// Creates a javascipt that fetches the devicestatus from devicestatus.php using the UserID.
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
        // Changes the text and class of a button to the status of the response.
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