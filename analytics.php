<?php
require_once('template.php');

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
echo $formatbrowsernames;

$content = <<<END
<div class="chart-container" style="position: relative; height:40vh; width:80vw">
  <canvas id="myChart"></canvas>
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
?>