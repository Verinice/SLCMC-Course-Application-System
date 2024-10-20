<?php

use SLCMC\Controllers\Database;
use SLCMC\Models\User;

require '../../vendor/autoload.php'; // Include Composer's autoload

session_start();

if(!isset($_SESSION['adm'])){
    header("Location:./login");
    return;
}

use Jenssegers\Blade\Blade;

// Set the paths for views and cache
$views = '../views';
$cache = '../cache';

// Initialize Blade
$blade = new Blade($views, $cache);

new Database;
$user = new User;

$adm = $_SESSION['adm'];

$user = $user->showUser($adm);

// var_dump($user);

// Render a view and pass data to it
echo $blade->render('dashboard', ['user' => $user]);
