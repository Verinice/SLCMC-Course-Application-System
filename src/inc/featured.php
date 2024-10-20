<?php

require '../../vendor/autoload.php'; // Include Composer's autoload

use Jenssegers\Blade\Blade;
use SLCMC\Models\Course;
use SLCMC\Models\User;

session_start();

// Set the paths for views and cache
$views = '../views';
$cache = '../cache';

// Initialize Blade
$blade = new Blade($views, $cache);

//  fetch user
$userModel = new User;
$user = array();

// fetch courses available
$course = new Course;
$result = $course->fetchCourses(array());

if(isset($_SESSION['adm'])){
    $user = $userModel->showUser($_SESSION['adm']);
}

// Render a view and pass data to it
echo $blade->render('featured', ['user' => $user, 'data' => $result]);
