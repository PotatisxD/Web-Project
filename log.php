<!--Felix.C Code-->
<?php
function LogUserInfo() {
$host = "localhost";
$user = "felcar21"; 
$pwd = "AmsOzPBsKR";
$db = "felcar21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
$current_Page = basename($_SERVER['PHP_SELF']);
$current_IP = $_SERVER['REMOTE_ADDR'];

//Creates a new Page in database if the current one does not exist
$query = <<<END
SELECT * 
FROM project_Page
WHERE Page="{$current_Page}"
END;
$result = $mysqli->query($query);
if (mysqli_num_rows($result) == 0)
{
$query = <<<END
INSERT INTO project_Page VALUES (NULL, '{$current_Page}');
END;
$mysqli->query($query);
}

//Gets PageID
$query = <<<END
SELECT project_Page.PageID
FROM project_Page
WHERE Page="{$current_Page}"
END;
$result = $mysqli->query($query);
$temp = $result->fetch_object();
$current_PageID = $temp->PageID;

//Gets current Browser

function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')  || strpos($user_agent, 'Edg' )) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
   
    return 'Other';
}
$current_Browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
//Creates a new Browser in database if the current one does not exist

$query = <<<END
SELECT * 
FROM project_Browser
WHERE BrowserName="{$current_Browser}"
END;
$result = $mysqli->query($query);
if (mysqli_num_rows($result) == 0)
{
$query = <<<END
INSERT INTO project_Browser VALUES (NULL, '{$current_Browser}');
END;
$mysqli->query($query);
}


//Gets BrowserID
$query = <<<END
SELECT *
FROM project_Browser
WHERE BrowserName="{$current_Browser}"
END;
$result = $mysqli->query($query);
$temp = $result->fetch_object();
$current_BrowserID = $temp->BrowserID;


//Inserts a new Log

$query = <<<END
INSERT INTO project_Log
VALUES (NULL, '{$current_IP}', NULL, {$current_PageID}, {$current_BrowserID})
END;
$mysqli->query($query);


if (isset($_SESSION['userId']))
{
// Gets the latest Log
$query = <<<END
SELECT project_Log.LogID FROM project_Log
ORDER BY project_Log.LogID DESC
END;
$result = $mysqli->query($query);
$temp = $result->fetch_object();
$current_LogID = $temp ->LogID;

$userID = $_SESSION['userId'];

$query = <<<END
INSERT INTO project_UserLog VALUES ('{$userID}', '{$current_LogID}')
END;
$mysqli->query($query);
}


}
?>
