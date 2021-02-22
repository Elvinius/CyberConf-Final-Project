<?php

// Require Model
require_once "model/RegisterHandle.php";

//strip_tags user inputs
$full_name = strip_tags($_POST['full_name']);
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);
$gender = strip_tags($_POST['gender']);
$birthdate = strip_tags($_POST['birthdate']);
$country = strip_tags($_POST['country']);
$occupation = strip_tags($_POST['occupation']);
$education = strip_tags($_POST['education']);

$main = (New RegisterHandle($full_name, $password, $email, $gender,
    $birthdate, $country, $occupation, $education));

$result = $main->Register();


if ($result == 20) {
    $cookie_name = "_rsmg";
    $cookie_value = "b5d9a59adb0bcd20e01f77d5b40419ee";
    setcookie($cookie_name, $cookie_value, time() + (10), "/");
    header("location: ../views/index.html");

} elseif ($result == 1) {
    $cookie_name = "_rsmg";
    $cookie_value = "819fa78f231b7b22d9f71d946351e1fe";
    setcookie($cookie_name, $cookie_value, time() + (10), "/");
    header("location: " . $_SERVER["HTTP_REFERER"]);
}