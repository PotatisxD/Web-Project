<?php
require_once('template.php');
$content = '<h1>Rooms</h1>';
$query = <<<END
SELECT Room
FROM project_Room
END;
$res = $mysqli->query($query);
if ($res->num_rows > 0) {
while ($row = $res->fetch_object()) {
$content .= <<<END
{$row->Room}<br>
END;
}
}
echo $navigation;
echo $content;
?>