<?php

// Require Model
require_once "model/SigninHandle.php";


function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}


//Trim user inputs
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


//__construct($email='',$password='')
$main = (New SigninHandle($email, $password));
$result = $main->Signin();

if ($result == 20) { //success
    header("location: " . $_SERVER["HTTP_REFERER"]);
} elseif ($result == 4) {
    $cookie_name = "_sgmg";
    $cookie_value = "a7f426b612fae7717f926ac6b9d0bf94";
    setcookie($cookie_name, $cookie_value, time() + (10), "/");
    header("location: ../views/index.html");
} else {
    header("location: " . $_SERVER["HTTP_REFERER"] . "?general_failure");

}