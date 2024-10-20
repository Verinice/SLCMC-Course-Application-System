<?php

use SLCMC\Controllers\Database;
use SLCMC\Models\User;

require "../vendor/autoload.php";

session_start();

// get form data as array
$form_data = $_POST;

if(!count($form_data)){
    throw new Exception("Error Processing Request: invalid data", 1);
}

// instantiate user and db
new Database;
$user = new User;

// loginUser
$result = $user->loginUser($form_data);

if(!empty($result['adm'])){
    // set session
    $_SESSION['adm'] = $result['adm'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['username'] = $result['username'];
}


print_r(json_encode($result));