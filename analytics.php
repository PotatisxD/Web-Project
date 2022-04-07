<?php
require_once('template.php');
function createIpTable(){

}
$browsercount = array();
$browsernames = array();
$query1 = <<<END
SELECT *
FROM project_Browser
END;
$result1 = $mysqli->query($query1);
if ($result1->num_rows > 0) {
while ($row = $result1->fetch_object()) {

$query2 = <<<END
SELECT COUNT(*)
FROM project_Log
WHERE BrowserID="{$row->BrowserID}"
END;

$result2 = $mysqli->query($query2);
$temp = mysqli_fetch_array($result2);
array_push($browsercount, $temp['COUNT(*)']);
array_push($browsernames, $row->BrowserName);
}
}
$formatbrowsercount = implode(", ", $browsercount);
$formatbrowsernames = "'" . implode ( "', '", $browsernames) . "'";



$content = <<<END
<div class="chart-container" style="position:absolute; height:300px; width:400px; top:50px; right:350px;">
<canvas id="myChart"></canvas>
</div>
<div id="iptable">

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const data = {
    labels: [{$formatbrowsernames}],
    datasets: [{
      label: 'My First Dataset',
      data: [{$formatbrowsercount}],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {}
  };
</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
END;
echo $navigation;
echo $content;

echo '<table border=1px;>';
echo "<tr border=1px;>";
echo "<td>IP Adress </td>";
echo "<td>Number of occurrences </td>";
echo "</tr>";

$query1 = <<<END
SELECT DISTINCT project_Log.IPAdress
FROM project_Log
END;
$result1 = $mysqli->query($query1);
if ($result1->num_rows > 0) {
while ($row = $result1->fetch_object()) {
$query2 = <<<END
SELECT COUNT(*)
FROM project_Log
WHERE IPAdress="{$row->IPAdress}"
END;

$result2 = $mysqli->query($query2);
$temp = mysqli_fetch_array($result2);
$count = $temp['COUNT(*)'];

echo "<tr border=1px;>";
echo "<td> {$row->IPAdress} </td>";
echo "<td> {$count} </td>";
echo "</tr>";
}
}
echo "</table>";

echo '<table border=1px;>';
echo "<tr border=1px;>";
echo "<td>User</td>";
echo "<td>Page</td>";
echo "<td>Date</td>";
echo "</tr>";


$query1 = <<<END
SELECT UserID, LogID
FROM project_UserLog
ORDER BY UserID
END;

$result1 = $mysqli->query($query1);
if ($result1->num_rows > 0) {
while ($row = $result1->fetch_object()) {
$query2 = <<<END
SELECT PageID, TimeStamp
FROM project_Log
WHERE LogID="{$row->LogID}"
END;
$result2 = $mysqli->query($query2);
$temp = $result2->fetch_object();

$query3 = <<<END
SELECT project_Page.Page
FROM project_Page
WHERE PageID="{$temp->PageID}"
END;

$result3 = $mysqli->query($query3);
$temp2 = $result3->fetch_object();
$current_Page = $temp2->Page;

$query4 = <<<END
SELECT project_User.UserName
FROM project_User
WHERE UserID="{$row->UserID}"
END;
$result4 = $mysqli->query($query4);
$temp3 = $result4->fetch_object();

echo "<tr border=1px;>";
echo "<td> {$temp3->UserName} </td>";
echo "<td> {$current_Page} </td>";
echo "<td> {$temp->TimeStamp} </td>";
echo "</tr>";
}
}
echo "</table>";

?>