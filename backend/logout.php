<?php

function logout()
{
    session_start();
    if (isset($_SESSION["HOST_SESSION"])) {

        session_destroy();
        header("location: ../views/index.html");
    }
    else{
        header("location: ../views/index.html");
    }
}

logout();

?>