<?php
// Kenny. L (Quang) Code, got inspiration from add_device.php in the same project (Ted)
$title = "Add Admin";
include_once('template.php');
echo $navigation;

if (isset($_POST['id'])) {

// Validates that the string will be safe to place in the query
$id = $mysqli->real_escape_string($_POST['id']);

// Insert into database
$query = <<<END
INSERT INTO project_Admin(UserID)
VALUES('{$id}')
END;
$mysqli->query($query);
echo 'Admin added to the database!';
}
// Queries against the database for User information
$sql = "SELECT * FROM project_User";
$all_ids = $mysqli->query($sql);
?>
<body>
<h1>Add Admin</h1>
<form method="post" action="add_admin.php">
<label for="id">Choose UserID to become Admin:</label>
<select name="id">
        <!--Fetches the result from query above into associative array-->
        <?php 
        while ($id = mysqli_fetch_array(
            $all_ids,MYSQLI_ASSOC)):; 
        ?>
        <!--Echos the content from project_Admin in the database into drop-down list -->
        <option value="<?php echo $id["UserID"];
        ?>">
        <?php echo $id["UserID"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
</select><br>
<!--Buttons to either add or reset value -->
<input type="submit" value="Add Admin">
<input type="reset" value="reset">
</form>
</body>

    