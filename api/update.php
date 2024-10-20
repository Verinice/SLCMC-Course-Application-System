<?php

use SLCMC\Controllers\Database;
use SLCMC\Controllers\User;

require "../vendor/autoload.php";

// get form data as array
$form_data = $_POST;

if(!count($form_data)){
    throw new Exception("Error Processing Request: invalid data", 1);
}

// instantiate user and db
new Database;
$user = new User;

// loginUser
$result = $user->updateUser($form_data);

print_r(json_encode(array('updated' => $result)));