<?php
// Felix.C Code
$title = "Analytics";
require_once('template.php');
function createIpTable(){

}
$browsercount = array();
$browsernames = array();
// Gets all the browsers and then counts the number of times they appear in the logs table and adds them to 2 separate arrays
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
//Formts the arrays correctly to work with the javascript
$formatbrowsercount = implode(", ", $browsercount);
$formatbrowsernames = "'" . implode ( "', '", $browsernames) . "'";

// all the html code used to create a pie chart, I used the basic template at https://www.chartjs.org/docs/latest/getting-started/
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
// echoes the navbar and the piechart
echo $navigation;
echo $content;

// Creates the table and the first row of content of the IP table.
echo '<table class="table table-dark table-hover w-auto"';
echo "<tr>";
echo "<td>IP Adress </td>";
echo "<td>Number of occurrences </td>";
echo "</tr>";

// Selects all the distinct IP adresses in the logs the loops through each one and queires the number of times they appear in the logs.
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

// Echoes a new row with the IP adress and the number of times it appears in the logs.
echo "<tr>";
echo "<td> {$row->IPAdress} </td>";
echo "<td> {$count} </td>";
echo "</tr>";
}
}
// html code for selecting which user to display the history for.
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

<!-- Script for fetching 10 logs from the userhistory.php file-->
<script>
// Function that takes what user and what the current history page is as counter 
function SetTable(user, counter = 1){
//creates a fetch with the user and counter
let response =  fetch("userhistory.php?" + new URLSearchParams({UserID: user, Page: counter}), {
    method: 'get',
}).then(function(response) {
        if (response.status >= 200 && response.status < 300) {
                return response.text()
        }
        throw new Error(response.statusText)
    })
    .then(function(response) {
      // Parses the json to array
      let array = JSON.parse(response);
      // bool used to check if they are no more pages to browse through
      end = false;
      // tries to remove the old table and buttons if the array length is bigger than 0. This is because if the last page is exactly 10 long it will make a unnecessary call to fetch a empty set of logs. 
      if(array.length > 0)
      {
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
      }
      else{
        end = true;
      }
        // Creates the first row of the table
        let table = document.createElement('table');
        table.className = "table table-dark table-hover w-auto";
        table.id = "userhistory";
        let tbody = document.createElement('tbody')
        let tr = document.createElement('tr');
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
        tbody.appendChild(tr);
        // A for loop that creates a row for each log entry to a maxium of 10 and if the for loop tries to create more than what the array contains the end bool becomes true.
        for (let i = 0; i<10; i++) {
          if (i < array.length) {
            let tr = document.createElement('tr');
          let td1 = document.createElement('td');
          let td2 = document.createElement('td');
          let td3 = document.createElement('td');
          // Uses the i variable to get what entry in the 2 dim array and then gets the 3 different types of data and then appends it to the table.
          let text1 = document.createTextNode(array[i][0]);
          let text2 = document.createTextNode(array[i][1]);
          let text3 = document.createTextNode(array[i][2]);
          td1.appendChild(text1);
          td2.appendChild(text2);
          td3.appendChild(text3);
          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          tbody.appendChild(tr);
          table.appendChild(tbody);
          
          }
          else
          {
            end = true;
          }
          
        
        }
        //Appends the table to the body
        document.body.appendChild(table);
        // Creates the backbutton that goes backwards in the history logs 
        let backbutton = document.createElement('button');
        backbutton.innerHTML  = "Back";
        backbutton.id= "backbutton";
        // Only calls for a new fetch if we are not currently on the first page counter
        backbutton.onclick = function(){
          if(counter > 1)
          {
            newcounter = counter - 1;
            SetTable(user,newcounter);
          }
        
        };
        // Creates the forward that goes forwards in the history logs 
        let forwardbutton = document.createElement('button');
        forwardbutton.innerHTML  = "Forward";
        forwardbutton.id= "forwardbutton";
        // Only calls for a new fetch if the end bool is not true
        forwardbutton.onclick = function(){
          if(end != true)
          {
            newcounter = counter + 1;
            SetTable(user,newcounter);
          }
          
        
        };
        // Appends the two buttons
        document.body.appendChild(backbutton);
        document.body.appendChild(forwardbutton);
        console.log(counter);
        console.log(response);
    })
    
}
</script>
</body>

<?php
// Checks if the select form as been completed and calls the SetTable function for that user using javascript.
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