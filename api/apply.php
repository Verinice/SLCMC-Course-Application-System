<?php

use SLCMC\Controllers\Database;
use SLCMC\Controllers\User;

require "../vendor/autoload.php";

session_start();

// get form data as array
$form_data = $_POST;

if(!count($form_data)){
    throw new Exception("Error Processing Request: invalid data", 1);
}

// instantiate db and user controllers
new Database;
$user = new User;

$adm = $_SESSION['adm'];

$apply = $user->applyCourse($form_data, $adm);

// loginUser
print_r(json_encode(array("applied"=> $apply)));