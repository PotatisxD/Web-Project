<?php
$title = "Analytics";
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
<p>Most common browser</p>
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
        'rgb(255, 205, 86)',
        'rgb(143, 58, 132)',
        'rgb(37, 209, 45)',
        'rgb(209, 83, 37)',
        'rgb(224, 21, 21)',
        
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
echo '<table class="table table-dark table-hover w-auto"';
echo "<tr>";
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

echo "<tr>";
echo "<td style='width: 15%'> {$row->IPAdress} </td>";
echo "<td> {$count} </td>";
echo "</tr>";
}
}

$sql = "SELECT * FROM project_User";
$all_users = $mysqli->query($sql);
?>
<body>
<h1>Select User</h1>
<form method="post" action="analytics.php">
<label for="user" style="display: block; ">Choose User</label>
<select name="user" class="form-select" style="width: 7%; display: inline; ">
        <?php 
        while ($user = mysqli_fetch_array(
            $all_users,MYSQLI_ASSOC)):; 
        ?>
        <option value="<?php echo $user["UserID"];
        ?>">
        <?php echo $user["UserName"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
<input type="submit" value="Select User" class="btn btn-primary">
<input type="reset" value="reset" class="btn btn-primary">
</form>
<script>
function SetTable(user, counter = 1){

let response =  fetch("userhistory.php?" + new URLSearchParams({UserID: user, Page: counter}), {
    method: 'get',
}).then(function(response) {
        if (response.status >= 200 && response.status < 300) {
                return response.text()
        }
        throw new Error(response.statusText)
    })
    .then(function(response) {
      try {
        const child = document.getElementById("userhistory");
        child.remove();
        const child2 = document.getElementById("backbutton");
        child2.remove();
        const child3 = document.getElementById("forwardbutton");
        child3.remove();
      }
      catch
      {

      }
        end = false;
        let array = JSON.parse(response);
        let table = document.createElement('table');
        table.className = "";
        table.id = "userhistory";
        let tr = document.createElement('tr');
        tr.style.width= "15%";
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let text1 = document.createTextNode('User');
        let text2 = document.createTextNode('Page');
        let text3 = document.createTextNode('Date');
        td1.appendChild(text1);
        td2.appendChild(text2);
        td3.appendChild(text3);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
        for (let i = 0; i<10; i++) {
          if (i < array.length) {
            let tr = document.createElement('tr');
          let td1 = document.createElement('td');
          let td2 = document.createElement('td');
          let td3 = document.createElement('td');
          let text1 = document.createTextNode(array[i][0]);
          let text2 = document.createTextNode(array[i][1]);
          let text3 = document.createTextNode(array[i][2]);
          td1.appendChild(text1);
          td2.appendChild(text2);
          td3.appendChild(text3);
          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          table.appendChild(tr);
          }
          else
          {
            end = true;
          }
          
        
        }
        document.body.appendChild(table);
        let backbutton = document.createElement('button');
        backbutton.innerHTML  = "Back";
        backbutton.id= "backbutton";
        backbutton.onclick = function(){
          if(counter > 1)
          {
            newcounter = counter - 1;
            SetTable(user,newcounter);
          }
        
        };
        let forwardbutton = document.createElement('button');
        forwardbutton.innerHTML  = "Forward";
        forwardbutton.id= "forwardbutton";
        forwardbutton.onclick = function(){
          if(end != true)
          {
            newcounter = counter + 1;
            SetTable(user,newcounter);
          }
          
        
        };
        document.body.appendChild(backbutton);
        document.body.appendChild(forwardbutton);
        console.log(counter);
        console.log(response);
    })
    
}
</script>
</body>

<?php
if (isset($_POST['user'])) {
$user = $mysqli->real_escape_string($_POST['user']);
$content = <<<END
<script type="text/javascript">
SetTable({$user});
</script>
END;
echo $content;
}
?>