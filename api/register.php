<?php

use SLCMC\Controllers\Database;
use SLCMC\Controllers\User;

require "../vendor/autoload.php";

// get form data as array
$form_data = $_POST;

if(!count($form_data)){
    throw new Exception("Error Processing Request: invalid data", 1);
}

// instantiate user
$user = new User;

// generate admission number
$form_data['admission_number'] = $user->generateAdm();

// hash password
$form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);

// create new user
$created = $user->createUser($form_data);


print_r(json_encode(array('created' => $created)));