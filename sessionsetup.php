<?php
// Felix.C Code
session_name("s" . ip2long($_SERVER["REMOTE_ADDR"]));
session_start();
?>