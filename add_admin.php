<?php
$title = "Add Admin";
include_once('template.php');
if (isset($_POST['id'])) {
$id = $mysqli->real_escape_string($_POST['id']);

$query = <<<END
INSERT INTO project_Admin(UserID)
VALUES('{$id}')
END;
$mysqli->query($query);
echo 'Admin added to the database!';
}

$sql = "SELECT * FROM project_User";
$all_ids = $mysqli->query($sql);


echo $navigation;
?>
<body>
<h1>Add Admin</h1>
<form method="post" action="add_admin.php">

<label for="id">Choose UserID to become Admin:</label>
<select name="id">
        <?php 
        while ($id = mysqli_fetch_array(
            $all_ids,MYSQLI_ASSOC)):; 
        ?>
        <option value="<?php echo $id["UserID"];
        ?>">
        <?php echo $id["UserID"];
        ?>
        </option>
        <?php 
        endwhile; 
        ?>
</select><br>
<input type="submit" value="Add Admin">
<input type="reset" value="reset">
</form>
</body>

    