<?php
// Felix.C Code
$title = "Home";
include('template.php');
$content = <<<END
<h1>Welcome to this website</h1>
<p>
This is gonna be a Smart Home GUI
</p>
END;
echo $navigation;
echo $content;
?>