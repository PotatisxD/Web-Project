<?php
// Felix.C Code
include("configDB.php");
$userhistory = array();
$newuserhistory = array();
$userid = $_GET["UserID"];
$page = $_GET["Page"];
// Sets the page offset correctly depending on if its the first page or not
if($page == 1)
{
    $page = 0;
}
else
{
    $page = $page * 10;
}
// Quieres a maxium of 10 logs from the database according to the page offset
$query1 = <<<END
SELECT UserID, LogID
FROM project_UserLog
WHERE UserID="{$userid}"
ORDER BY LogID DESC
LIMIT 10
OFFSET {$page} 
END;
$resultUserLog = $mysqli->query($query1);

// Loops through the logs from previous query and gets the name of the page and the times stamp as well as the username for the user
if ($resultUserLog->num_rows > 0) {
while ($rowUserLog = $resultUserLog->fetch_object()) {
$query2 = <<<END
SELECT PageID, TimeStamp
FROM project_Log
WHERE LogID="{$rowUserLog->LogID}"
END;
$resultLog = $mysqli->query($query2);
$tempLog = $resultLog->fetch_object();

$query3 = <<<END
SELECT project_Page.Page
FROM project_Page
WHERE PageID="{$tempLog->PageID}"
END;

$resultPage = $mysqli->query($query3);
$tempPage = $resultPage->fetch_object();
$current_Page = $tempPage->Page;

$query4 = <<<END
SELECT project_User.UserName
FROM project_User
WHERE UserID="{$rowUserLog->UserID}"
END;
$resultUser = $mysqli->query($query4);
$tempUser = $resultUser->fetch_object();

// pushes the log info into a 2-dim array and then json endcodes the array when loop is finished
array_push($userhistory, array($tempUser->UserName, $current_Page, $tempLog->TimeStamp));
}
}
echo json_encode($userhistory);

?>