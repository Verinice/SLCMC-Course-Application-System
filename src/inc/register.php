<?php

require '../../vendor/autoload.php'; // Include Composer's autoload

use Jenssegers\Blade\Blade;

// Set the paths for views and cache
$views = '../views';
$cache = '../cache';

// Initialize Blade
$blade = new Blade($views, $cache);

// Render a view and pass data to it
echo $blade->render('register', ['name' => 'Difatha']);
