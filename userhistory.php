<?php
include("configDB.php");
$userhistory = array();
$newuserhistory = array();
$userid = $_GET["UserID"];
$page = $_GET["Page"];
$query1 = <<<END
SELECT UserID, LogID
FROM project_UserLog
WHERE UserID="{$userid}"
ORDER BY LogID DESC
END;

$resultUserLog = $mysqli->query($query1);
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

array_push($userhistory, array($tempUser->UserName, $current_Page, $tempLog->TimeStamp));
}
}
for($i = $page * 10 - 10; $i < $page * 10; $i++)
{
    array_push($newuserhistory, $userhistory[$i]);
}
echo json_encode($newuserhistory);
?>