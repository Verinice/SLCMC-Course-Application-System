<?php

require '../../vendor/autoload.php'; // Include Composer's autoload

session_start();

if(!isset($_SESSION['adm'])){
    header("Location:./login");
    return;
}

use Jenssegers\Blade\Blade;
use SLCMC\Models\User;

// Set the paths for views and cache
$views = '../views';
$cache = '../cache';

// Initialize Blade
$blade = new Blade($views, $cache);

//  fetch user
$userModel = new User;
$user = array();

if(isset($_SESSION['adm'])){
    $user = $userModel->showUser($_SESSION['adm']);
}

// Render a view and pass data to it
echo $blade->render('cart', ['user' => $user]);
