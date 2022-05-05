<?php
$title = "Login";
require_once("configDB.php");
require_once("sessionsetup.php");
if (isset($_POST['username']) and isset($_POST['password'])) {
$name = $mysqli->real_escape_string($_POST['username']);
$pwd = $mysqli->real_escape_string($_POST['password']);
$query = <<<END
SELECT UserName, Password, UserID FROM project_User
WHERE UserName = '{$name}'
AND Password = '{$pwd}'
END;
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
$row = $result->fetch_object();
$_SESSION["username"] = $row->UserName;
$_SESSION["userId"] = $row->UserID;
header("Location:home.php");
} else {
  echo '<script>alert("Wrong username or password")</script>';
}
}
$content = <<<END
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="media/style.css">
    <link href="sidebars.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
    <main>
    <div class="form-signin align-items-center">
      <form class="login-form" method="POST" action="login.php">
        <h1 class="h3 mb-3 fw-normal text-light">Please sign in</h1>
        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" required>
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" required>
          <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </div>
    </main>
  </body>
</html>
END;
echo $content;
?>