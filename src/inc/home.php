<?php

require '../../vendor/autoload.php'; // Include Composer's autoload

use Jenssegers\Blade\Blade;
use SLCMC\Models\User;

session_start();

// Set the paths for views and cache
$views = '../views';
$cache = '../cache';

// Initialize Blade
$blade = new Blade($views, $cache);

$userModel = new User;
$user = array();

if(isset($_SESSION['adm'])){
    $user = $userModel->showUser($_SESSION['adm']);
}


// Render a view and pass data to it
echo $blade->render('home', ['user' => $user ]);
