<?php
// Felix.C Code, inspiration from the php lecture.
session_name("s" . ip2long($_SERVER["REMOTE_ADDR"]));
session_start();
?>