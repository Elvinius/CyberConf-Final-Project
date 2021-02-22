<?php


require "model/SessionControlHandle.php";

$main = New SessionControlHandle;
$result = $main->SessionControl();

//returns 20 is success
//returns 5 is session does not exist
//returns 6 session is expired, should prompt "login again"
?>